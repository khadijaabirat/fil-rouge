<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Models\Project;

Schedule::call(function () {
    // المشاريع المنتهية: CLOSED إلا ماوصلوش للهدف، COMPLETED إلا وصلو
    $expiredProjects = Project::where('status', 'OPEN')
        ->where('endDate', '<', now())
        ->get();
    
    foreach ($expiredProjects as $project) {
        $project->checkDeadline();
    }
    
    // المشاريع لي وصلو للهدف قبل الوقت
    Project::where('status', 'OPEN')
        ->whereColumn('currentAmount', '>=', 'goalAmount')
        ->update(['status' => 'COMPLETED']);
})->hourly();
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
