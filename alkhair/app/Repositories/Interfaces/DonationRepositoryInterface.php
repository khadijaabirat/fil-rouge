<?php

namespace App\Repositories\Interfaces;

interface DonationRepositoryInterface
{
    public function create(array $data);
    public function find($id);
    public function update($id, array $data);
    public function getDonationsByDonator($donatorId);
    public function getDonationsByProject($projectId);
    public function getPendingManualDonations();
}
