<?php

namespace App\Services;

use App\Models\Donation;
use App\Models\Payment;
use App\Models\Project;
use App\Models\ManualPayment;
use App\Models\OnlinePayment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Notifications\DonationStatusChanged;

class PaymentProcessingService
{
    public function createManualDonation(array $data, $receiptFile, int $donatorId, int $projectId): Donation
    {
        return DB::transaction(function () use ($data, $receiptFile, $donatorId, $projectId) {
            $donation = Donation::create([
                'amount' => $data['amount'],
                'message' => $data['message'] ?? null,
                'donationDate' => now(),
                'isAnonymous' => $data['isAnonymous'] ?? false,
                'status' => 'PENDING',
                'donator_id' => $donatorId,
                'project_id' => $projectId,
            ]);

            $receiptPath = $receiptFile->store('payment_receipts', 'public');

            ManualPayment::create([
                'amount' => $data['amount'],
                'donation_id' => $donation->id,
                'paymentReceipt' => $receiptPath,
                'paymentDate' => now(),
            ]);

            return $donation;
        });
    }

    public function createOnlineDonation(array $data, int $donatorId, Project $project): string
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        return DB::transaction(function () use ($data, $donatorId, $project) {
            $donation = Donation::create([
                'amount' => $data['amount'],
                'message' => $data['message'] ?? null,
                'donationDate' => now(),
                'isAnonymous' => $data['isAnonymous'] ?? false,
                'status' => 'PENDING',
                'donator_id' => $donatorId,
                'project_id' => $project->id,
            ]);

            $payment = OnlinePayment::create([
                'transactionId' => 'pending',
                'amount' => $data['amount'],
                'donation_id' => $donation->id,
                'paymentDate' => now(),
            ]);

            $checkout_session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'mad',
                        'unit_amount' => $data['amount'] * 100,
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

            return $checkout_session->url;
        });
    }

    public function validateStripePayment(Donation $donation, string $sessionId): bool
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $session = Session::retrieve($sessionId);

        if ($session->payment_status !== 'paid') {
            throw new \Exception('Le paiement n\'a pas été complété chez Stripe.');
        }

        return DB::transaction(function () use ($donation) {
            $payment = Payment::where('donation_id', $donation->id)->firstOrFail();

            $donation->update(['status' => 'VALIDATED']);
            $payment->update(['status' => 'SUCCESS']);

            $project = Project::findOrFail($donation->project_id);
            $project->increment('currentAmount', $donation->amount);
            $project->refresh();
            $project->calculateProgress();

            if ($donation->donator) {
                $donation->donator->notify(new DonationStatusChanged($donation, 'VALIDATED'));
            }

            return true;
        });
    }

    public function cancelDonation(Donation $donation): bool
    {
        if ($donation->status !== 'PENDING') {
            throw new \Exception('Ce don ne peut pas être annulé.');
        }

        $payment = Payment::where('donation_id', $donation->id)->first();

        if ($payment && $payment->paymentReceipt && Storage::disk('public')->exists($payment->paymentReceipt)) {
            Storage::disk('public')->delete($payment->paymentReceipt);
        }

        if ($payment) {
            $payment->delete();
        }
        
        return $donation->delete();
    }
}
