<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Project;
use App\Models\ImpactReport;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

echo "Fixing broken images...\n";

// 1. Get all available valid images from projects
$availableProjectImages = array_filter(Storage::disk('public')->files('projects'), function($file) {
    return in_array(pathinfo($file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'webp', 'avif']);
});
$availableProjectImages = array_values($availableProjectImages);
$projectImageCount = count($availableProjectImages);

if ($projectImageCount === 0) {
    echo "No images found in storage/app/public/projects!\n";
    exit(1);
}

// 2. Fix Projects
$projects = Project::all();
$fixedProjects = 0;
foreach ($projects as $index => $project) {
    if (!$project->image || !Storage::disk('public')->exists($project->image)) {
        // Pick an image reliably based on index so it's consistent
        $validImage = $availableProjectImages[$index % $projectImageCount];
        $project->image = $validImage;
        $project->save();
        $fixedProjects++;
        echo "Fixed project {$project->id} with {$validImage}\n";
    }
}

// 3. Fix Impacts
$availableImpactImages = array_filter(Storage::disk('public')->files('impacts'), function($file) {
    return in_array(pathinfo($file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'webp', 'avif']);
});
$availableImpactImages = array_values($availableImpactImages);
$impactImageCount = count($availableImpactImages);

$impacts = ImpactReport::all();
$fixedImpacts = 0;
if ($impactImageCount > 0) {
    foreach ($impacts as $index => $impact) {
        if (!$impact->image || !Storage::disk('public')->exists($impact->image)) {
            $validImage = $availableImpactImages[$index % $impactImageCount];
            $impact->image = $validImage;
            $impact->save();
            $fixedImpacts++;
            echo "Fixed impact {$impact->id} with {$validImage}\n";
        }
    }
}

// 4. Fix Association Logos
$availableLogos = array_filter(Storage::disk('public')->files('logos'), function($file) {
    return in_array(pathinfo($file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'webp', 'avif']);
});
$availableLogos = array_values($availableLogos);
$logoCount = count($availableLogos);

$associations = User::where('role', 'association')->get();
$fixedLogos = 0;
if ($logoCount > 0) {
    foreach ($associations as $index => $assoc) {
        if (!$assoc->profilePhoto || !Storage::disk('public')->exists($assoc->profilePhoto)) {
            $validLogo = $availableLogos[$index % $logoCount];
            $assoc->profilePhoto = $validLogo;
            $assoc->save();
            $fixedLogos++;
            echo "Fixed association {$assoc->id} logo with {$validLogo}\n";
        }
    }
}

echo "\nDone! Fixed $fixedProjects projects, $fixedImpacts impacts, and $fixedLogos logos.\n";
