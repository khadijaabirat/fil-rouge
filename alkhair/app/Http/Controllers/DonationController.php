<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Donation;
use Illuminate\Support\Facades\Auth;
use App\Services\PaymentProcessingService;

use App\Http\Requests\StoreDonationRequest;
 
class DonationController extends Controller
{
    protected $paymentProcessingService;

    public function __construct(PaymentProcessingService $paymentProcessingService)
    {
        $this->paymentProcessingService = $paymentProcessingService;
    }
 
    public function create($id)
    {
        $project = Project::findOrFail($id);
        
        if ($project->status !== 'OPEN') {
            return redirect()->route('projects.show', $id)
                ->with('error', 'Ce projet n\'accepte plus de dons.');
        }
        
        return view('donator.donate', compact('project'));
    }

 
    public function store(StoreDonationRequest $request, $id)
    {
        $project = Project::findOrFail($id);

        if ($project->status !== 'OPEN') {
            abort(403, 'Ce projet n\'accepte plus de dons.');
        }

        $validated = $request->validated();

        try {
          
            if ($request->paymentMethod === 'MANUAL') {
                $donation = $this->paymentProcessingService->createManualDonation(
                    $validated,
                    $request->file('paymentReceipt'),
                    Auth::id(),
                    $project->id
                );

                return redirect()->route('donations.confirmation', $donation->id)
                    ->with('success', 'Votre promesse de don a été enregistrée. Elle sera traitée prochainement par l\'administration.');
            }
 
            if ($request->paymentMethod === 'ONLINE') {
                $checkoutUrl = $this->paymentProcessingService->createOnlineDonation(
                    $validated,
                    Auth::id(),
                    $project
                );

                return redirect($checkoutUrl);
            }

            return back()->with('error', 'Une erreur est survenue lors du traitement de votre don.');
            
        } catch (\Exception $e) {
            return back()->with('error', 'Le service de paiement est temporairement indisponible. Veuillez réessayer plus tard.');
        }
    }

  
    public function success(Request $request, $id)
    {
        $donation = Donation::findOrFail($id);
        
        if ($donation->donator_id !== Auth::id()) {
            abort(403, 'Accès non autorisé.');
        }
        
        if ($donation->status === 'VALIDATED') {
            return redirect()->route('donator.dashboard')
                ->with('info', 'Ce paiement a déjà été validé.');
        }
        
        $sessionId = $request->query('session_id');
        
        if (!$sessionId) {
            abort(403, 'Session de paiement introuvable ou invalide.');
        }

        try {
            $this->paymentProcessingService->validateStripePayment($donation, $sessionId);
            
            return redirect()->route('donations.confirmation', $donation->id)
                ->with('success', 'Merci, Votre don en ligne a été validé.');
                
        } catch (\Exception $e) {
            abort(500, 'Erreur de vérification avec Stripe.');
        }
    }
 
    public function cancel($id)
    {
        try {
            $donation = Donation::findOrFail($id);
            $this->paymentProcessingService->cancelDonation($donation);
            
            return redirect()->route('donator.dashboard')
                ->with('error', 'Vous avez annulé le paiement en ligne.');
                
        } catch (\Exception $e) {
            return redirect()->route('donator.dashboard')
                ->with('error', 'Une erreur est survenue lors de l\'annulation.');
        }
    }
 
    public function confirmation($id)
    {
        $donation = Donation::with('project')->findOrFail($id);
        
        if ($donation->donator_id !== Auth::id()) {
            abort(403, 'Accès non autorisé.');
        }
        
        return view('donator.confirmation', compact('donation'));
    }
}
