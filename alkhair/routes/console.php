<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Models\Project;

Schedule::call(function () {
    Project::where('status', 'OPEN')->where('endDate', '<', now())->update(['status' => 'CLOSED']);
    Project::where('status', 'OPEN')->whereColumn('currentAmount', '>=', 'goalAmount')->update(['status' => 'COMPLETED']);
})->hourly();
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
