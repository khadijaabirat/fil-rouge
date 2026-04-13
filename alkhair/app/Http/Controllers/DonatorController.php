<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use  App\Models\Donation;
class DonatorController extends Controller
{
 public function dashboard(){
    Project::where('status', 'OPEN')
                           ->where('endDate', '<', now())
                           ->update(['status' => 'CLOSED']);

    Project::where('status', 'OPEN')
                           ->whereColumn('currentAmount', '>=', 'goalAmount')
                           ->update(['status' => 'COMPLETED']);

    $donator=Auth::user();
    $projects=Project::where('status','OPEN')
    ->with('association')
    ->get();
    $myDonations = Donation::where('donator_id', $donator->id)
                                           ->with(['project', 'payment'])
                                           ->get();
    return view('donator.dashboard',compact('donator','projects', 'myDonations'));
 }



}
