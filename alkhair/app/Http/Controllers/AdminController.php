<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Donation;
use App\Models\Project;
use App\Services\AssociationService;
use App\Services\DonationService;
use App\Services\ProjectService;
 
class AdminController extends Controller
{
    protected $associationService;
    protected $donationService;
    protected $projectService;
 
    public function __construct(
        AssociationService $associationService,
        DonationService $donationService,
        ProjectService $projectService
    ) {
        $this->associationService = $associationService;
        $this->donationService = $donationService;
        $this->projectService = $projectService;
    }
 
    public function dashboard()
    {
        $pendingAssociations = $this->associationService->getPendingAssociations(4);
        $pendingDonationsCount = $this->donationService->countPendingDonations();
        $recentManualDonations = $this->donationService->getRecentManualDonations(5);
        $recentActivities = $this->donationService->getRecentActivities(3);
        $withdrawalRequests = $this->projectService->getWithdrawalRequests();

        return view('admin.dashboard', compact(
            'pendingAssociations',
            'pendingDonationsCount',
            'recentManualDonations',
            'recentActivities',
            'withdrawalRequests'
        ));
    }

 
    public function showDonation($id)
    {
        $donation = Donation::with(['donator', 'project.association', 'payment'])->findOrFail($id);
        return view('admin.donation-details', compact('donation'));
    }
 
    public function validations()
    {
        $pendingAssociations = $this->associationService->getPendingAssociations();
        $pendingDonations = $this->donationService->getPendingDonations();
        $managedProjects = $this->projectService->getManagedProjects();

        return view('admin.validation', compact(
            'pendingAssociations',
            'pendingDonations',
            'managedProjects'
        ));
    }

 
    public function users(Request $request)
    {
        $query = User::query()->where('role', '!=', 'admin');
        
        if ($request->has('role') && $request->role !== 'all') {
            $query->where('role', $request->role);
        }
        
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $users = $query->latest()->paginate(10);
        return view('admin.gestionutilisateur', compact('users'));
    }



  
    public function validateAssociation($id)
    {
        try {
            $association = User::where('role', 'association')->findOrFail($id);
            $this->associationService->validate($association);
            
            return back()->with('success', 'Le compte de l\'association a été validé');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

 
    public function verifyKyc($id)
    {
        try {
            $association = User::where('role', 'association')->findOrFail($id);
            $this->associationService->verifyKyc($association);
            
            return back()->with('success', 'Le KYC de l\'association a été vérifié');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }


 
    public function validateDonation($id)
    {
        try {
            $donation = Donation::findOrFail($id);
            $this->donationService->validate($donation);
            
            return back()->with('success', 'Le don manuel a été validé et le montant a été ajouté au projet !');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }



 
    public function rejectDonation($id)
    {
        try {
            $donation = Donation::findOrFail($id);
            $this->donationService->reject($donation);
            
            return back()->with('error', 'Le don a été refusé car le reçu est invalide.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
 
    public function approveWithdrawal($id)
    {
        try {
            $project = Project::findOrFail($id);
            $this->projectService->approveWithdrawal($project);
            
            return back()->with('success', 'Les fonds ont été marqués comme transférés à l\'association.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
 
    public function banAssociation($id)
    {
        try {
            $association = User::where('role', 'association')->findOrFail($id);
            $this->associationService->ban($association);
            
            return back()->with('success', 'L\'association a été bannie et tous ses projets ont été suspendus.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

 
    public function suspendProject($id)
    {
        try {
            $project = Project::findOrFail($id);
            $this->projectService->suspend($project);
            
            return back()->with('success', 'Le projet a été suspendu avec succès. Les dons sont désormais bloqués.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
 
    public function unbanAssociation($id)
    {
        try {
            $association = User::where('role', 'association')->findOrFail($id);
            $this->associationService->unban($association);
            
            return back()->with('success', 'L\'association a été réactivée avec succès.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
 
    public function restoreProject($id)
    {
        try {
            $project = Project::findOrFail($id);
            $this->projectService->restore($project);
            
            return back()->with('success', 'Le projet a été restauré et est de nouveau en ligne.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
