<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Donation;
use Illuminate\Database\Eloquent\SoftDeletes;

 
class Payment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'type',
        'transactionId',
        'paymentMethod',
        'paymentReceipt',
        'amount',
        'paymentDate',
        'status',
        'donation_id'
    ];

    protected $casts = [
        'paymentDate' => 'datetime',
        'amount' => 'decimal:2',
    ];
 
    public function donation()
    {
        return $this->belongsTo(Donation::class);
    }
 
    public function validate()
    {
       
        $this->status = 'SUCCESS';
        $this->paymentDate = now();
        $this->save();
    }
 
    public function cancel()
    {
        $this->status = 'FAILED';
        $this->save();
    }
 
    public function isOnline(): bool
    {
        return $this->paymentMethod === 'ONLINE';
    }

 
    public function isManual(): bool
    {
        return $this->paymentMethod === 'MANUAL';
    }
 
    public function newFromBuilder($attributes = [], $connection = null)
    {
        $model = parent::newFromBuilder($attributes, $connection);
        
        if (isset($model->type) && class_exists($model->type)) {
            $instance = (new $model->type)->newInstance([], true);
            $instance->setRawAttributes((array) $attributes, true);
            $instance->setConnection($connection ?: $this->getConnectionName());
            $instance->fireModelEvent('retrieved', false);
            return $instance;
        }
        
        return $model;
    }
}
