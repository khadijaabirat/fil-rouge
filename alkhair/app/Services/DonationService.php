<?php

namespace App\Services;

use App\Models\Donation;
use App\Models\Payment;
use App\Models\ManualPayment;
use App\Notifications\DonationStatusChanged;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DonationService
{
    public function validate(Donation $donation): bool
    {
        if ($donation->status !== 'PENDING') {
            throw new \Exception('Ce don a déjà été traité.');
        }

        return DB::transaction(function () use ($donation) {
            $payment = ManualPayment::where('donation_id', $donation->id)->first();

            if (!$payment) {
                throw new \Exception('Paiement introuvable.');
            }

            $payment->validate();

            if ($donation->donator) {
                $donation->donator->notify(new DonationStatusChanged($donation, 'VALIDATED'));
            }

            return true;
        });
    }

    public function reject(Donation $donation): bool
    {
        if ($donation->status !== 'PENDING') {
            throw new \Exception('Impossible de refuser ce don car il a déjà été traité.');
        }

        $payment = ManualPayment::where('donation_id', $donation->id)->first();

        if ($payment) {
            $payment->reject();

            if ($payment->paymentReceipt && Storage::disk('public')->exists($payment->paymentReceipt)) {
                Storage::disk('public')->delete($payment->paymentReceipt);
            }
        }

        if ($donation->donator) {
            $donation->donator->notify(new DonationStatusChanged($donation, 'FAILED'));
        }

        return true;
    }

    public function getPendingDonations()
    {
        return Donation::with(['donator', 'project.association', 'payment'])
            ->whereHas('payment', function ($query) {
                $query->where('status', 'PENDING')
                    ->whereNotNull('paymentReceipt');
            })
            ->where('status', 'PENDING')
            ->get();
    }

    public function countPendingDonations(): int
    {
        return Donation::whereHas('payment', function ($query) {
                $query->where('status', 'PENDING')
                    ->whereNotNull('paymentReceipt');
            })
            ->where('status', 'PENDING')
            ->count();
    }

    public function getRecentManualDonations(int $limit = 5)
    {
        return Donation::with(['donator', 'project.association', 'payment'])
            ->whereHas('payment', function ($query) {
                $query->whereNotNull('paymentReceipt');
            })
            ->latest()
            ->take($limit)
            ->get();
    }

    public function getRecentActivities(int $limit = 3)
    {
        return Donation::with(['donator', 'project.association'])
            ->latest()
            ->take($limit)
            ->get();
    }
}
