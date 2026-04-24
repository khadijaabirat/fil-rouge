<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$sourceDir = 'C:/Users/safiy/.gemini/antigravity/brain/7e5e3f1e-46f1-4a7d-9e2e-7fb838752a68/';
$targetDir = storage_path('app/public/projects/');

$mapping = [
    2  => 'proj2_scholarships_1776944469840.png',
    3  => 'proj3_school_bags_1776944484131.png',
    6  => 'proj6_hemodialysis_1776944498989.png',
    8  => 'proj8_diabetes_screening_1776944517401.png',
    9  => 'proj9_orphan_children_1776944539972.png',
    11 => 'proj11_summer_camp_1776944557316.png',
    17 => 'proj17_winter_blankets_1776944573049.png',
    18 => 'proj18_water_well_1776944591815.png',
];

foreach ($mapping as $id => $filename) {
    $source = $sourceDir . $filename;
    $targetFilename = "project_ai_{$id}.png";
    $targetPath = 'projects/' . $targetFilename;
    $fullTargetPath = storage_path('app/public/' . $targetPath);

    if (file_exists($source)) {
        if (copy($source, $fullTargetPath)) {
            $project = App\Models\Project::find($id);
            if ($project) {
                $project->image = $targetPath;
                $project->save();
                echo "✅ Updated project $id ({$project->title}) with image\n";
            } else {
                echo "❌ Project $id not found in database\n";
            }
        } else {
            echo "❌ Failed to copy image for project $id\n";
        }
    } else {
        echo "❌ Source file not found: $source\n";
    }
}

echo "\nDone!\n";
