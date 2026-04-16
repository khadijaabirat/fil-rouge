<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Donation;
 use App\Models\User;
use App\Models\Project;
use Carbon\Carbon;

class DonationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
  {
    $projects = Project::where('currentAmount', '>', 0)->get();

         $donators = User::where('role', 'donator')->pluck('id')->toArray();

        foreach ($projects as $project) {
             $donationStatus = in_array($project->status, ['COMPLETED', 'CLOSED']) ? 'IMPACT' : 'VALIDATED';

             $amount1 = round($project->currentAmount * 0.6);
            $amount2 = $project->currentAmount - $amount1;

            if ($amount1 > 0) {
                Donation::create([
                    'amount' => $amount1,
                    'isAnonymous' => false,
                    'status' => $donationStatus,
                    'donator_id' => $donators[array_rand($donators)],
                    'project_id' => $project->id,
                    'created_at' => Carbon::now()->subDays(rand(5, 15)),
                ]);
            }

            if ($amount2 > 0) {
                Donation::create([
                    'amount' => $amount2,
                    'isAnonymous' => true,
                    'status' => $donationStatus,
                    'donator_id' => $donators[array_rand($donators)],
                    'project_id' => $project->id,
                    'created_at' => Carbon::now()->subDays(rand(1, 4)),
                ]);
            }
        }
  }
}
