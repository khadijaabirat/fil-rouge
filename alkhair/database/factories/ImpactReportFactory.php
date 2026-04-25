<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImpactReportFactory extends Factory
{
    public function definition(): array
    {
        return [
            'description'    => fake()->paragraphs(3, true),
            'completionDate' => now()->subDays(5),
            'videoLink'      => null,
            'image'          => null,
            'project_id'     => Project::factory(),
        ];
    }
}
