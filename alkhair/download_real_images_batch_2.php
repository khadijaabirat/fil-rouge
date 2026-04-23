<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$mapping = [
    2  => 'https://images.unsplash.com/photo-1541339907198-e08759df9a73?auto=format&fit=crop&q=80&w=1200',
    3  => 'https://images.unsplash.com/photo-1520624843189-3f5f60e1c6ee?auto=format&fit=crop&q=80&w=1200',
    6  => 'https://images.unsplash.com/photo-1533342330752-df218077a1c1?auto=format&fit=crop&q=80&w=1200',
    7  => 'https://images.unsplash.com/photo-1579684385127-1ef15d508118?auto=format&fit=crop&q=80&w=1200',
    8  => 'https://images.unsplash.com/photo-1535492423191-44778d0516e1?auto=format&fit=crop&q=80&w=1200',
    9  => 'https://images.unsplash.com/photo-1531816405770-521990c686b8?auto=format&fit=crop&q=80&w=1200',
    11 => 'https://images.unsplash.com/photo-1530262142232-a50e93a6b251?auto=format&fit=crop&q=80&w=1200',
    16 => 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?auto=format&fit=crop&q=80&w=1200',
    17 => 'https://images.unsplash.com/photo-1511210217036-74d320f7813a?auto=format&fit=crop&q=80&w=1200',
    18 => 'https://images.unsplash.com/photo-1547039017-0097f48e3a89?auto=format&fit=crop&q=80&w=1200',
    22 => 'https://images.unsplash.com/photo-1539667547529-84c607280d20?auto=format&fit=crop&q=80&w=1200',
    23 => 'https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&q=80&w=1200',
];

$targetDir = storage_path('app/public/projects/');

if (!file_exists($targetDir)) {
    mkdir($targetDir, 0755, true);
}

foreach ($mapping as $id => $url) {
    $filename = "project_real_{$id}.jpg";
    $targetPath = 'projects/' . $filename;
    $fullTargetPath = storage_path('app/public/' . $targetPath);
    
    echo "Downloading real image for project $id from Unsplash...\n";
    
    $content = @file_get_contents($url);
    if ($content !== false) {
        if (file_put_contents($fullTargetPath, $content)) {
            $project = App\Models\Project::find($id);
            if ($project) {
                $project->image = $targetPath;
                $project->save();
                echo "Successfully updated project $id with image $targetPath\n";
            } else {
                echo "Project $id not found\n";
            }
        } else {
            echo "Failed to save image to $fullTargetPath\n";
        }
    } else {
        echo "Failed to download image from $url\n";
    }
}
