<?php

namespace App\Models;

use App\Models\Payment;
use Illuminate\Support\Facades\Storage;

 
class ManualPayment extends Payment
{
   
    protected $table = 'payments';
 
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->type = self::class;
            $model->paymentMethod = 'MANUAL';
            $model->status = 'PENDING'; // En attente de validation admin
        });
    }

 
    public function validate()
    {
        if (!$this->paymentReceipt) {
            throw new \Exception('Le justificatif de paiement est requis pour valider un paiement manuel.');
        }

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
 
    public function reject($reason = null)
    {
        $this->status = 'FAILED';
        $this->save();

         if ($this->donation) {
            $this->donation->status = 'FAILED';
            $this->donation->save();
        }

        return true;
    }
 
    public function uploadReceipt($file)
    {
        if ($file) {
             if ($this->paymentReceipt) {
                Storage::disk('public')->delete($this->paymentReceipt);
            }

             $path = $file->store('payment_receipts', 'public');
            $this->paymentReceipt = $path;
            $this->save();

            return $path;
        }

        return null;
    }
 
    public function getReceiptUrl()
    {
        if ($this->paymentReceipt) {
            return Storage::disk('public')->url($this->paymentReceipt);
        }

        return null;
    }
 
    public function hasReceipt(): bool
    {
        return !empty($this->paymentReceipt) && Storage::disk('public')->exists($this->paymentReceipt);
    }
 
    public function getManualDetails()
    {
        return [
            'transaction_id' => $this->transactionId ?? 'N/A',
            'amount' => $this->amount,
            'status' => $this->status,
            'payment_date' => $this->paymentDate,
            'receipt' => $this->getReceiptUrl(),
            'method' => 'Paiement manuel (Justificatif)',
        ];
    }

 
    public function isPending(): bool
    {
        return $this->status === 'PENDING';
    }
}
