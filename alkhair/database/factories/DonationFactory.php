<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DonationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'amount'       => fake()->numberBetween(100, 5000),
            'message'      => fake()->optional()->sentence(),
            'isAnonymous'  => false,
            'status'       => 'VALIDATED',
            'donator_id'   => User::factory()->create(['role' => 'donator'])->id,
            'project_id'   => Project::factory(),
        ];
    }
}
