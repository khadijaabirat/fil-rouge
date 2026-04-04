<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
class DonatorController extends Controller
{
 public function dashboard(){
    $donator=Auth::user();
    $projects=Project::where('status','OPEN')->with('association')->get();
    return view('donator.dashboard',compact('donator','projects'));
 }



}
