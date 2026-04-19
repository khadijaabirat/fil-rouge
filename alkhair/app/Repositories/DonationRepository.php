<?php

namespace App\Repositories;

use App\Models\Donation;
use App\Repositories\Interfaces\DonationRepositoryInterface;

class DonationRepository implements DonationRepositoryInterface
{
    protected $model;

    public function __construct(Donation $model)
    {
        $this->model = $model;
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function find($id)
    {
        return $this->model->with(['donator', 'project', 'payment'])->findOrFail($id);
    }

    public function update($id, array $data)
    {
        $donation = $this->find($id);
        $donation->update($data);
        return $donation;
    }

    public function getDonationsByDonator($donatorId)
    {
        return $this->model->where('donator_id', $donatorId)
            ->with(['project', 'payment'])
            ->latest()
            ->get();
    }

    public function getDonationsByProject($projectId)
    {
        return $this->model->where('project_id', $projectId)
            ->whereIn('status', ['VALIDATED', 'PROCESSING', 'RECEIVED', 'IMPACT'])
            ->with('donator')
            ->latest()
            ->get();
    }

    public function getPendingManualDonations()
    {
        return $this->model->with(['donator', 'project', 'payment'])
            ->whereHas('payment', function ($query) {
                $query->where('status', 'PENDING')
                    ->whereNotNull('paymentReceipt');
            })
            ->where('status', 'PENDING')
            ->get();
    }
}
