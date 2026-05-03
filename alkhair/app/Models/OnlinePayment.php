<?php

namespace App\Models;

use App\Models\Payment;

 
class OnlinePayment extends Payment
{
 
    protected $table = 'payments';

 
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->type = self::class;
            $model->paymentMethod = 'ONLINE';
        });
    }
 
    public function validate()
    {
        $this->status = 'SUCCESS';
        $this->paymentDate = now();
        $this->save();

        if ($this->donation) {
            $this->donation->status = 'VALIDATED';
            $this->donation->save();

            $project = $this->donation->project;
            if ($project) {
                $project->increment('currentAmount', $this->amount);
                $project->refresh();
                $project->calculateProgress();
            }
        }

        return true;
    }
 
    public function cancel()
    {
        $this->status = 'FAILED';
        $this->save();

         if ($this->donation) {
            $this->donation->status = 'FAILED';
            $this->donation->save();
        }

        return true;
    }

 
    public function createStripeSession()
    {
         
    }
 
    public function verifyStripePayment($sessionId)
    {
        
    }
 
    public function getStripeDetails()
    {
        return [
            'transaction_id' => $this->transactionId,
            'amount' => $this->amount,
            'status' => $this->status,
            'payment_date' => $this->paymentDate,
            'method' => 'Stripe (Carte bancaire)',
        ];
    }
}
