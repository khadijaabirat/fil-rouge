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

         $request->validate([
            'amount' => 'required|numeric|min:100',
            'message' => 'nullable|string|max:500',
            'isAnonymous' => 'nullable|boolean',
            'paymentMethod' => 'required|in:ONLINE,MANUAL',
            'paymentReceipt' => 'required_if:paymentMethod,MANUAL|file|mimes:pdf,jpg,png|max:5120',
        ]);

         $donation = Donation::create([
            'amount' => $request->amount,
            'message' => $request->message,
            'donationDate' => now(),
            'isAnonymous' => $request->has('isAnonymous'),
            'status' => 'PENDING',
            'donator_id' => Auth::id(),
            'project_id' => $project->id,
        ]);

         $receiptPath = null;
        if ($request->paymentMethod === 'MANUAL' && $request->hasFile('paymentReceipt')) {
            $receiptPath = $request->file('paymentReceipt')->store('receipts', 'public');
         Payment::create([
            'transactionId' => Str::uuid()->toString(),
            'paymentMethod' => $request->paymentMethod,
            'paymentReceipt' => $receiptPath,
            'amount' => $request->amount,
            'paymentDate' => now(),
            'status' => 'PENDING',
            'donation_id' => $donation->id,
        ]);

        return redirect()->route('donator.dashboard')->with('success', 'Votre promesse de don a été enregistrée  , Elle sera traitée prochainement.');

        }
if ($request->paymentMethod === 'ONLINE') {
Stripe::setApiKey(env('STRIPE_SECRET'));
$checkout_session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'mad',
                        'unit_amount' => $request->amount * 100,
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

            Payment::create([
                'transactionId' => $checkout_session->id,
                'paymentMethod' => 'ONLINE',
                'paymentReceipt' => null,
                'amount' => $request->amount,
                'paymentDate' => now(),
                'status' => 'PENDING',
                'donation_id' => $donation->id,
            ]);

             return redirect($checkout_session->url);
}


    }

public function success(Request $request, $id)
    {
        $donation = Donation::findOrFail($id);
        $payment = Payment::where('donation_id', $donation->id)->first();

         $donation->update(['status' => 'VALIDATED']);
        $payment->update(['status' => 'SUCCESS']);

         $project = Project::findOrFail($donation->project_id);
        $project->increment('currentAmount', $donation->amount);

        return redirect()->route('donator.dashboard')->with('success', 'Merci, Votre don en ligne a été validé.');
    }


 public function cancel($id)
    {
         return redirect()->route('donator.dashboard')->with('error', 'Vous avez annulé le paiement en ligne.');
    }
}
