<?php

namespace App\Services;

use App\Repositories\Interfaces\DonationRepositoryInterface;
use App\Repositories\Interfaces\ProjectRepositoryInterface;
use App\Models\Payment;
use App\Notifications\DonationStatusChanged;
use Illuminate\Support\Facades\DB;

class DonationService
{
    protected $donationRepo;
    protected $projectRepo;

    public function __construct(
        DonationRepositoryInterface $donationRepo,
        ProjectRepositoryInterface $projectRepo
    ) {
        $this->donationRepo = $donationRepo;
        $this->projectRepo = $projectRepo;
    }

    public function createDonation(array $data)
    {
        return DB::transaction(function () use ($data) {
            return $this->donationRepo->create($data);
        });
    }

    public function validateDonation($donationId)
    {
        return DB::transaction(function () use ($donationId) {
            $donation = $this->donationRepo->find($donationId);
            
            $this->donationRepo->update($donationId, ['status' => 'VALIDATED']);
            
            $payment = Payment::where('donation_id', $donationId)->first();
            if ($payment) {
                $payment->update(['status' => 'SUCCESS']);
            }
            
            $this->projectRepo->incrementAmount($donation->project_id, $donation->amount);
            $donation->project->calculateProgress();
            
            if ($donation->donator) {
                $donation->donator->notify(new DonationStatusChanged($donation, 'VALIDATED'));
            }
            
            return $donation;
        });
    }

    public function rejectDonation($donationId)
    {
        $donation = $this->donationRepo->find($donationId);
        
        $this->donationRepo->update($donationId, ['status' => 'FAILED']);
        
        $payment = Payment::where('donation_id', $donationId)->first();
        if ($payment) {
            $payment->update(['status' => 'FAILED']);
        }
        
        if ($donation->donator) {
            $donation->donator->notify(new DonationStatusChanged($donation, 'FAILED'));
        }
        
        return $donation;
    }
}
