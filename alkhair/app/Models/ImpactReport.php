<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Project;
class ImpactReport extends Model
{
    /** @use HasFactory<\Database\Factories\ImpactReportFactory> */
    use HasFactory;
    protected $fillable = [
        'description', 'completionDate', 'videoLink', 'project_id', 'image'
    ];
public function project() 
    {
       return $this->belongsTo(Project::class);
    }
    protected function casts(): array
    {
        return [
            'completionDate' => 'datetime',
        ];
    }
}
