<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$mapping = [
    53 => 'argan_trees_preservation_1776869349957.png',
    54 => 'emergency_medical_assistance_1776869365003.png',
    55 => 'water_well_drilling_1776869380931.png',
    57 => 'ramadan_food_baskets_1776869392851.png',
    58 => 'disaster_relief_families_1776869408311.png',
    59 => 'mobile_medical_clinic_1776869425279.png',
];

$sourceDir = 'C:/Users/safiy/.gemini/antigravity/brain/7e5e3f1e-46f1-4a7d-9e2e-7fb838752a68/';
$targetDir = storage_path('app/public/projects/');

if (!file_exists($targetDir)) {
    mkdir($targetDir, 0755, true);
}

foreach ($mapping as $id => $filename) {
    $source = $sourceDir . $filename;
    $targetPath = 'projects/' . $filename;
    $fullTargetPath = storage_path('app/public/' . $targetPath);
    
    if (file_exists($source)) {
        if (copy($source, $fullTargetPath)) {
            $project = App\Models\Project::find($id);
            if ($project) {
                $project->image = $targetPath;
                $project->save();
                echo "Updated project $id with image $targetPath\n";
            } else {
                echo "Project $id not found\n";
            }
        } else {
            echo "Failed to copy $source to $fullTargetPath\n";
        }
    } else {
        echo "Source file $source does not exist\n";
    }
}
