<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$mapping = [
    53 => 'https://images.unsplash.com/photo-1593253029656-9aaee080fb29?auto=format&fit=crop&q=80&w=1200',
    54 => 'https://images.unsplash.com/photo-1569420626546-55b02c8376b1?auto=format&fit=crop&q=80&w=1200',
    55 => 'https://images.unsplash.com/photo-1649495519389-432c2597f900?auto=format&fit=crop&q=80&w=1200',
    57 => 'https://images.unsplash.com/photo-1677128912094-36d988ce198b?auto=format&fit=crop&q=80&w=1200',
    58 => 'https://images.unsplash.com/photo-1727475806600-ff8dc5d2cbfd?auto=format&fit=crop&q=80&w=1200',
    59 => 'https://images.unsplash.com/photo-1584515604646-b7becb13021c?auto=format&fit=crop&q=80&w=1200',
];

$targetDir = storage_path('app/public/projects/');

if (!file_exists($targetDir)) {
    mkdir($targetDir, 0755, true);
}

foreach ($mapping as $id => $url) {
    $extension = 'jpg';
    $filename = "project_real_{$id}.{$extension}";
    $targetPath = 'projects/' . $filename;
    $fullTargetPath = storage_path('app/public/' . $targetPath);
    
    echo "Downloading image for project $id from $url...\n";
    
    $content = @file_get_contents($url);
    if ($content !== false) {
        if (file_put_contents($fullTargetPath, $content)) {
            $project = App\Models\Project::find($id);
            if ($project) {
                $project->image = $targetPath;
                $project->save();
                echo "Successfully updated project $id with real image $targetPath\n";
            } else {
                echo "Project $id not found in database\n";
            }
        } else {
            echo "Failed to save image to $fullTargetPath\n";
        }
    } else {
        echo "Failed to download image from $url\n";
    }
}
