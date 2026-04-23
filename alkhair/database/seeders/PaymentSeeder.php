<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Payment;
use App\Models\Donation;
use Illuminate\Support\Str; 
class PaymentSeeder extends Seeder
{
  public function run(): void
    {
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

         $pendingDonations = Donation::where('status', 'PENDING')->get();

        foreach ($pendingDonations as $index => $donation) {
             $isManual = $index % 2 === 0; 

            Payment::create([
                'transactionId' => $isManual ? Str::uuid()->toString() : 'TXN-PEND-' . str_pad($index + 1, 4, '0', STR_PAD_LEFT),
                'paymentMethod' => $isManual ? 'MANUAL' : 'ONLINE',
                'paymentReceipt' => $isManual ? 'receipts/dummy_receipt_pending.pdf' : null,
                'amount' => $donation->amount,
                'paymentDate' => null,  
                'status' => 'PENDING',
                'donation_id' => $donation->id,
            ]);
        }
    }
}
