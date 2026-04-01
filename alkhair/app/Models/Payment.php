<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Donation;
class Payment extends Model
{
    /** @use HasFactory<\Database\Factories\PaymentFactory> */
    use HasFactory;
protected $fillable = [
        'transactionId', 'paymentMethod', 'paymentReceipt',
        'amount', 'paymentDate', 'status', 'donation_id'
    ];
public function donation(){
    return $this->belongsTo(Donation::class);
}
}
