<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Project;
use App\Models\Payment;
class Donation extends Model
{
    protected $fillable = [
        'amount', 'message', 'donationDate', 'isAnonymous',
        'status', 'donator_id', 'project_id'
    ];
    
    /** @use HasFactory<\Database\Factories\DonationFactory> */
    use HasFactory;
    
    protected function casts(): array
    {
        return [
            'donationDate' => 'datetime',
            'isAnonymous' => 'boolean',
        ];
    }
    
    public function donator(){
        return $this->belongsTo(User::class,'donator_id');
    }
    
    public function association()
    {
        return $this->hasOneThrough(
            User::class,
            Project::class,
            'id',
            'id',
            'project_id',
            'association_id'
        );
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
