<?php

namespace Database\Factories;

use App\Models\Donation;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'donation_id'   => Donation::factory(),
            'amount'        => fake()->numberBetween(100, 5000),
            'paymentMethod' => fake()->randomElement(['ONLINE', 'MANUAL']),
            'status'        => 'SUCCESS',
            'transactionId' => fake()->uuid(),
            'paymentDate'   => now(),
        ];
    }
}
