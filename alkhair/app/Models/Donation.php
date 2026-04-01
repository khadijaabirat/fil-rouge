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
    public function donator(){
        return $this->belongsTo(User::class,'donator_id');
    }
    public function project(){
        return $this->belongsTo(project::class);
    }
    public function payment(){
    return $this->hasOne(Payment::class);
    }
}
