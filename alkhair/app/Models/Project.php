<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Category;
use App\Models\ImpactReport;
use App\Models\Donation;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'title',
        'description',
        'goalAmount',
        'currentAmount',
        'videoUrl',
        'image',
        'startDate',
        'endDate',
        'status',
        'association_id',
        'category_id',
        'ville',
        'latitude',
        'longitude',
    ];

    protected static function booted()
    {
        static::updating(function ($project) {
            if ($project->isDirty('goalAmount') && $project->currentAmount > 0) {
                throw new \Exception('Impossible de modifier l\'objectif financier car le projet a déjà reçu des dons.');
            }
        });
    }

    public function association(){
        return $this->belongsTo(User::class,'association_id');
    }
    
    public function category(){
        return $this->belongsTo(Category::class);
    }
    
    public function impactReport(){
        return $this->hasOne(ImpactReport::class);
    }
    
    public function donations(){
        return $this->hasMany(Donation::class);
    }
    
    public function calculateProgress()
    {
        if ($this->currentAmount >= $this->goalAmount && $this->status === 'OPEN') {
            $this->update(['status' => 'COMPLETED']);
        }
    }
    public function checkDeadline()
    {
        if (now()->greaterThan($this->endDate) && $this->status === 'OPEN') {
            if ($this->currentAmount >= $this->goalAmount) {
                $this->update(['status' => 'COMPLETED']);
            } else {
                $this->update(['status' => 'CLOSED']);
            }
            return true;
        }
        return false;
    }
    
    protected function casts(): array
    {
        return [
            'startDate' => 'datetime',
            'endDate'   => 'datetime',
        ];
    }
}
