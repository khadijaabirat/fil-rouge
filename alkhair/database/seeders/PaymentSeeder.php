<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Payment;
use App\Models\Donation;
class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $donations = Donation::all();

        foreach ($donations as $donation) {
             $methods = ['ONLINE', 'MANUAL'];
            $method = $methods[array_rand($methods)];

            Payment::create([
                'paymentMethod' => $method,
                'status' => 'SUCCESS',
                 'paymentReceipt' => $method === 'MANUAL' ? 'receipts/dummy_receipt.pdf' : null,
                'donation_id' => $donation->id,
                'amount' =>  fake()->numberBetween(100, 5000),
            ]);
        }
    }
}
