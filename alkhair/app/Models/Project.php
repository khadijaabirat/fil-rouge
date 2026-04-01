<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Category;
use App\Models\ImpactReport;
use App\Models\Donation;
class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'goalAmount',
        'currentAmount',
        'videoUrl',
        'startDate',
        'endDate',
        'status',
        'association_id',
        'category_id',

    ];
    public function association(){
        return $this->belongsTo(User::class,'association_id');
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function impactReport(){
        return $this->belongsTo(ImpactReport::class);
    }
    public function donations(){
        return $this->hasMany(Donation::class);
    }
}
