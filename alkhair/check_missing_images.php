<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$projects = App\Models\Project::all();
$missing = [];
foreach($projects as $p) {
    if (!file_exists(storage_path('app/public/' . $p->image))) {
        $missing[] = ['id' => $p->id, 'title' => $p->title, 'image' => $p->image];
    }
}
echo "Missing " . count($missing) . " images:\n";
foreach($missing as $m) {
    echo "{$m['id']} - {$m['title']} - {$m['image']}\n";
}
