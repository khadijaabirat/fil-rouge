<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title'         => fake()->sentence(4),
            'description'   => fake()->paragraph(),
            'goalAmount'    => fake()->numberBetween(5000, 100000),
            'currentAmount' => 0,
            'startDate'     => now()->subDays(10),
            'endDate'       => now()->addMonths(2),
            'status'        => 'OPEN',
            'association_id'=> User::factory()->create(['role' => 'association', 'status' => 'ACTIVE', 'category_id' => Category::factory()])->id,
            'category_id'   => Category::factory(),
            'videoUrl'      => null,
            'image'         => null,
        ];
    }
}
