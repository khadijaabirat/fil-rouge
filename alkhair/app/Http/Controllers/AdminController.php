<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Donation;
use App\Models\Project;
use App\Models\Category;
use App\Models\Payment;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
 use App\Notifications\DonationStatusChanged;
use App\Notifications\AssociationStatusChanged;

class AdminController extends Controller
{
    public function dashboard(){
        $pendingAssociations = User::where('role', 'association')
            ->where('status','PENDING')
            ->latest()
            ->take(4)
            ->get();
            
        $pendingDonationsCount = Donation::whereHas('payment', function ($query) {
                $query->where('status', 'PENDING')
                ->whereNotNull('paymentReceipt');
            })
            ->where('status', 'PENDING')
            ->count();
            
        $recentManualDonations = Donation::with(['donator', 'project', 'payment'])
            ->whereHas('payment', function ($query) {
                $query->whereNotNull('paymentReceipt');
            })
            ->latest()
            ->take(5)
            ->get();
            
        $recentActivities = Donation::with(['donator', 'project'])
            ->latest()
            ->take(3)
            ->get();

        return view('admin.dashboard', compact('pendingAssociations', 'pendingDonationsCount', 'recentManualDonations', 'recentActivities'));
    }

    public function showDonation($id) {
        $donation = Donation::with(['donator', 'project.association', 'payment'])->findOrFail($id);
        return view('admin.donation-details', compact('donation'));
    }

    public function validations() {
        $pendingAssociations = User::where('role', 'association')
            ->where('status','PENDING')
            ->get();
            
        $pendingDonations = Donation::with(['donator', 'project', 'payment'])
            ->whereHas('payment', function ($query) {
                $query->where('status', 'PENDING')
                ->whereNotNull('paymentReceipt');
            })
            ->where('status', 'PENDING')
            ->get();

        $managedProjects = Project::whereIn('status', ['OPEN', 'COMPLETED', 'SUSPENDED'])
            ->with('association')
            ->get();

        return view('admin.validation', compact('pendingAssociations', 'pendingDonations', 'managedProjects'));
    }

    public function users(Request $request) {
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



public function validateAssociation($id){
    $association = User::where('role', 'association')->findOrFail($id);
    
    $association->update(['status' => 'ACTIVE']);
    $association->notify(new AssociationStatusChanged('ACTIVE'));
    
    return back()->with('success', 'Le compte de l association a été validé');
}



 public function validateDonation($id)
    {
        $donation = Donation::findOrFail($id);
        if ($donation->status !== 'PENDING') {
            return back()->with('error', 'Ce don a déjà été traité.');
        }
        
        DB::transaction(function () use ($donation) {
            $payment = Payment::where('donation_id', $donation->id)->first();
       
            $donation->update(['status' => 'VALIDATED']);
            if ($payment) {
                $payment->update(['status' => 'SUCCESS']);
            }
            
            $project = Project::findOrFail($donation->project_id);
            $project->increment('currentAmount', $donation->amount);
            $project->calculateProgress();
            
            if ($donation->donator) {
                $donation->donator->notify(new DonationStatusChanged($donation, 'VALIDATED'));
            }
        });
        
        return back()->with('success', 'Le don manuel a été validé et le montant a été ajouté au projet !');
    }




    public function rejectDonation($id)
    {
        $donation = Donation::findOrFail($id);
        if ($donation->status !== 'PENDING') {
            return back()->with('error', 'Impossible de refuser ce don car il a déjà été traité.');
        }
        
        $payment = Payment::where('donation_id', $donation->id)->first();
       
        
        $donation->update(['status' => 'FAILED']);
        if ($payment) {
            $payment->update(['status' => 'FAILED']);
        }
        
        if ($payment && $payment->paymentReceipt && Storage::disk('public')->exists($payment->paymentReceipt)) {
            Storage::disk('public')->delete($payment->paymentReceipt);
        }
        
        if ($donation->donator) {
            $donation->donator->notify(new DonationStatusChanged($donation, 'FAILED'));
        }
        
        return back()->with('error', 'Le don a été refusé car le reçu est invalide.');
    }


     public function approveWithdrawal($id)
    {
        $project = Project::findOrFail($id);

        $project->donations()->where('status', 'PROCESSING')->update(['status' => 'RECEIVED']);

        return back()->with('success', 'Les fonds ont été marqués comme transférés à l\'association.');
    }


public function banAssociation($id)
    {
        $association = User::where('role', 'association')->findOrFail($id);
        
        $association->update(['status' => 'BANNED']);
        $association->projects()->update(['status' => 'SUSPENDED']);
        $association->notify(new AssociationStatusChanged('BANNED'));
        
        return back()->with('success', 'L\'association a été bannie et tous ses projets ont été suspendus.');
    }



public function suspendProject($id)
    {
        $project = Project::findOrFail($id);

        $project->update(['status' => 'SUSPENDED']);

        return back()->with('success', 'Le projet a été suspendu avec succès. Les dons sont désormais bloqués.');
    }




     public function unbanAssociation($id)
    {
$association = User::where('role', 'association')->findOrFail($id);
         $association->update(['status' => 'ACTIVE']);
         $association->notify(new AssociationStatusChanged('ACTIVE'));

$suspendedProjects = $association->projects()->where('status', 'SUSPENDED')->get();

foreach ($suspendedProjects as $project) {
            $project->update(['status' => 'OPEN']);
            $project->calculateProgress();
            if (method_exists($project, 'checkDeadline')) {
                $project->checkDeadline();
            }
        }
        return back()->with('success', 'L\'association a été réactivée avec succès.');
    }




     public function restoreProject($id)
    {
        $project = Project::findOrFail($id);

         $project->update(['status' => 'OPEN']);

         $project->calculateProgress();
        $project->checkDeadline();

        return back()->with('success', 'Le projet a été restauré et est de nouveau en ligne.');
    }


}
