<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Donation;
use App\Models\Project;
use App\Models\Payment;
use Illuminate\Support\Facades\Storage;
class AdminController extends Controller
{
    public function dashboard(){
    $pendingAssociations=User::where('role', 'association')
    ->where('status','PENDING')
    ->get();
    $pendingDonations=Donation::whereHas('payment', function ($query) {
                                        $query->where('status', 'PENDING');
                                    })
    ->where('status', 'PENDING')
    ->get();

         $withdrawalRequests = Project::whereHas('donations', function ($query) {
            $query->where('status', 'PROCESSING');
        })->with('association')->get();


$managedAssociations = User::where('role', 'association')
                                   ->whereIn('status', ['ACTIVE', 'BANNED'])
                                   ->get();
 $managedProjects = Project::whereIn('status', ['OPEN', 'COMPLETED', 'SUSPENDED'])
                                  ->with('association')
                                  ->get();

 return view('admin.dashboard', compact('pendingAssociations', 'pendingDonations', 'withdrawalRequests', 'managedAssociations', 'managedProjects'));

  }



 public function validateAssociation($id){
$association = User::findOrFail($id);
$association->update([
            'status' => 'ACTIVE'
        ]);
        return back()->with('success', 'Le compte de l association a été validé');
    }



 public function validateDonation($id)
    {
        $donation = Donation::findOrFail($id);
        $payment = Payment::where('donation_id', $donation->id)->first();

        $donation->update(['status' => 'VALIDATED']);
        $payment->update(['status' => 'SUCCESS']);

        $project = Project::findOrFail($donation->project_id);
        $project->increment('currentAmount', $donation->amount);

        $project->calculateProgress();
        return back()->with('success', 'Le don manuel a été validé et le montant a été ajouté au projet !');
    }

    public function rejectDonation($id)
    {
        $donation = Donation::findOrFail($id);
        $payment = Payment::where('donation_id', $donation->id)->first();

         if ($payment) {
            $payment->update(['status' => 'FAILED']);
        }

         if ($payment && $payment->paymentReceipt) {
            Storage::disk('public')->delete($payment->paymentReceipt);
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
        $association = User::findOrFail($id);

        $association->update(['status' => 'BANNED']);

         $association->projects()->update(['status' => 'SUSPENDED']);

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
        $association = User::findOrFail($id);

         $association->update(['status' => 'ACTIVE']);

         $association->projects()->where('status', 'SUSPENDED')->update(['status' => 'OPEN']);

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
