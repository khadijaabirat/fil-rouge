<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard(){
        $pendingAssociations=User::where('role', 'association')->where('status','PENDING')->get();
return view('admin.dashboard', compact('pendingAssociations'));
    }

    public function validateAssociation($id){
$association = User::findOrFail($id);
$association->update([
            'status' => 'ACTIVE'
        ]);
        return back()->with('success', 'Le compte de l association a été validé');
    }
}
