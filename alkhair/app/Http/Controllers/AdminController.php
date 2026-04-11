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
    return view('admin.dashboard', compact('pendingAssociations','pendingDonations'));
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
}
