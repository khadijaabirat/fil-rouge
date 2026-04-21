<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Payment;
use App\Models\Donation;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        // Get all VALIDATED donations and create SUCCESS payments for them
        $validatedDonations = Donation::where('status', 'VALIDATED')->get();

        foreach ($validatedDonations as $index => $donation) {
            Payment::create([
                'transactionId' => 'TXN-' . str_pad($index + 1, 6, '0', STR_PAD_LEFT),
                'paymentMethod' => $index % 3 === 0 ? 'MANUAL' : 'ONLINE',
                'paymentReceipt' => $index % 3 === 0 ? 'receipts/receipt_' . ($index + 1) . '.pdf' : null,
                'amount' => $donation->amount,
                'paymentDate' => $donation->donationDate,
                'status' => 'SUCCESS',
                'donation_id' => $donation->id,
            ]);
        }

        // Get PENDING donations and create PENDING payments for them
        $pendingDonations = Donation::where('status', 'PENDING')->get();

        foreach ($pendingDonations as $index => $donation) {
            Payment::create([
                'transactionId' => 'TXN-PEND-' . str_pad($index + 1, 4, '0', STR_PAD_LEFT),
                'paymentMethod' => 'ONLINE',
                'paymentReceipt' => null,
                'amount' => $donation->amount,
                'paymentDate' => null,
                'status' => 'PENDING',
                'donation_id' => $donation->id,
            ]);
        }
    }
}
