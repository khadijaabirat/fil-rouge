<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Donation;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\DB;
class DonationController extends Controller
{
    public function create($id)
    {
        $project = Project::findOrFail($id);
        return view('donator.donate', compact('project'));
    }


public function store(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        if ($project->status !== 'OPEN') {
            abort(403, 'Ce projet n\'accepte plus de dons.');
        }

        $request->validate([
            'amount' => 'required|numeric|min:100',
            'message' => 'nullable|string|max:500',
            'isAnonymous' => 'nullable',
            'paymentMethod' => 'required|in:ONLINE,MANUAL',
            'paymentReceipt' => 'required_if:paymentMethod,MANUAL|file|mimes:pdf,jpg,png|max:5120',
        ]);

         if ($request->paymentMethod === 'MANUAL') {
            if ($request->hasFile('paymentReceipt')) {
                $receiptPath = $request->file('paymentReceipt')->store('receipts', 'public');

                 DB::transaction(function () use ($request, $project, $receiptPath) {
                    $donation = Donation::create([
                        'amount' => $request->amount,
                        'message' => $request->message,
                        'donationDate' => now(),
                        'isAnonymous' => $request->has('isAnonymous'),
                        'status' => 'PENDING',
                        'donator_id' => Auth::id(),
                        'project_id' => $project->id,
                    ]);

                    Payment::create([
                        'transactionId' => Str::uuid()->toString(),
                        'paymentMethod' => 'MANUAL',
                        'paymentReceipt' => $receiptPath,
                        'amount' => $request->amount,
                        'paymentDate' => now(),
                        'status' => 'PENDING',
                        'donation_id' => $donation->id,
                    ]);
                });

                return redirect()->route('donator.dashboard')->with('success', 'Votre promesse de don a été enregistrée. Elle sera traitée prochainement par l\'administration.');
            }
        }

        if ($request->paymentMethod === 'ONLINE') {
            Stripe::setApiKey(env('STRIPE_SECRET'));

            try {
                 DB::beginTransaction();

                 $donation = Donation::create([
                    'amount' => $request->amount,
                    'message' => $request->message,
                    'donationDate' => now(),
                    'isAnonymous' => $request->has('isAnonymous'),
                    'status' => 'PENDING',
                    'donator_id' => Auth::id(),
                    'project_id' => $project->id,
                ]);

                 $payment = Payment::create([
                    'transactionId' => 'pending',
                    'paymentMethod' => 'ONLINE',
                    'paymentReceipt' => null,
                    'amount' => $request->amount,
                    'paymentDate' => now(),
                    'status' => 'PENDING',
                    'donation_id' => $donation->id,
                ]);

                 $checkout_session = Session::create([
                    'payment_method_types' => ['card'],
                    'line_items' => [[
                        'price_data' => [
                            'currency' => 'mad',
                            'unit_amount' => $request->amount * 100, // Stripe كيخدم بالسنتيم
                            'product_data' => [
                                'name' => 'Don pour : ' . $project->title,
                                'description' => 'Plateforme AL-KHAIR',
                            ],
                        ],
                        'quantity' => 1,
                    ]],
                    'mode' => 'payment',
                     'success_url' => route('donations.success', ['id' => $donation->id]) . '?session_id={CHECKOUT_SESSION_ID}',
                    'cancel_url' => route('donations.cancel', ['id' => $donation->id]),
                ]);

                 $payment->update(['transactionId' => $checkout_session->id]);

                 DB::commit();

                 return redirect($checkout_session->url);

            } catch (\Exception $e) {
                 DB::rollBack();
                return back()->with('error', 'Le service de paiement est temporairement indisponible. Veuillez réessayer plus tard.');
            }
        }

        return back()->with('error', 'Une erreur est survenue lors du traitement de votre don.');
    }



public function success(Request $request, $id)
    {
        $donation = Donation::findOrFail($id);
        if ($donation->donator_id !== Auth::id()) {
            abort(403, 'Accès non autorisé.');
        }
        if ($donation->status === 'VALIDATED') {
            return redirect()->route('donator.dashboard')->with('info', 'Ce paiement a déjà été validé.');
        }
        $sessionId = $request->query('session_id');
        if (!$sessionId) {
            abort(403, 'Session de paiement introuvable ou invalide.');
        }
         Stripe::setApiKey(env('STRIPE_SECRET'));
        try {
            $session =  Session::retrieve($sessionId);

            if ($session->payment_status !== 'paid') {
                abort(403, 'Le paiement n\'a pas été complété chez Stripe.');
            }
        } catch (\Exception $e) {
            abort(500, 'Erreur de vérification avec Stripe.');
        }

        DB::transaction(function () use ($donation) {
       $payment = Payment::where('donation_id', $donation->id)->firstOrFail();

         $donation->update(['status' => 'VALIDATED']);
        $payment->update(['status' => 'SUCCESS']);

         $project = Project::findOrFail($donation->project_id);
        $project->increment('currentAmount', $donation->amount);
        $project->calculateProgress();
        });
        return redirect()->route('donator.dashboard')->with('success', 'Merci, Votre don en ligne a été validé.');
    }




 public function cancel($id)
    {
        $donation = Donation::findOrFail($id);
        if ($donation->donator_id !== Auth::id()) {
            abort(403, 'Accès non autorisé. Vous ne pouvez pas annuler le don d\'une autre personne.');
        }
        if ($donation->status === 'PENDING') {
             Payment::where('donation_id', $donation->id)->delete();

            $donation->delete();
        }
         return redirect()->route('donator.dashboard')->with('error', 'Vous avez annulé le paiement en ligne.');
    }
}
