<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Project;
use App\Models\Payment;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Donation extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'amount', 'message', 'donationDate', 'isAnonymous',
        'status', 'donator_id', 'project_id'
    ];
    
    protected $appends = ['donator_name'];
    
    protected function casts(): array
    {
        return [
            'donationDate' => 'datetime',
            'isAnonymous' => 'boolean',
        ];
    }
    
    public function donator()
    {
        return $this->belongsTo(User::class,'donator_id');
    }
 
    protected function donatorName(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->isAnonymous ? 'Donateur anonyme' : ($this->donator?->name ?? 'Inconnu')
        );
    }
    
    public function toArray()
    {
        $array = parent::toArray();
        
        if ($this->isAnonymous) {
            unset($array['donator']);
            unset($array['donator_id']);
        }
        
        return $array;
    }
    
    public function association()
    {
         return $this->project ? $this->project->association() : null;
    }
    
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
