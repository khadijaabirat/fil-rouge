<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AssociationController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\DonatorController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\ImpactReportController;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::middleware(['auth','role:admin'])->group(function(){
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::post('/admin/association/{id}/validate', [AdminController::class, 'validateAssociation'])->name('admin.validateAssociation');
Route::post('/admin/donation/{id}/validate', [AdminController::class, 'validateDonation'])->name('admin.validateDonation');
Route::post('/admin/donation/{id}/reject', [AdminController::class, 'rejectDonation'])->name('admin.rejectDonation');
Route::post('/admin/project/{id}/approve-withdrawal', [AdminController::class, 'approveWithdrawal'])->name('admin.approveWithdrawal');
 Route::post('/admin/association/{id}/ban', [AdminController::class, 'banAssociation'])->name('admin.banAssociation');
  Route::post('/admin/project/{id}/suspend', [AdminController::class, 'suspendProject'])->name('admin.suspendProject');

});

Route::middleware(['auth','role:association'])->group(function(){
Route::get('/association/dashboard', [AssociationController::class, 'dashboard'])->name('association.dashboard');
Route::resource('projects', ProjectController::class);
Route::post('/projects/{id}/extend', [\App\Http\Controllers\ProjectController::class, 'extendDeadline'])->name('projects.extend');
Route::post('/association/projects/{id}/withdraw', [AssociationController::class, 'withdrawFunds'])->name('association.withdraw');
Route::get('/association/projects/{id}/impact', [ImpactReportController::class, 'create'])->name('impact.create');
Route::post('/association/projects/{id}/impact', [ImpactReportController::class, 'store'])->name('impact.store');


});

Route::middleware(['auth','role:donator'])->group(function(){
Route::get('/donator/dashboard', [DonatorController::class, 'dashboard'])->name('donator.dashboard');


Route::get('/projects/{id}/donate', [DonationController::class, 'create'])->name('donations.create');
Route::post('/projects/{id}/donate', [DonationController::class, 'store'])->name('donations.store');

//  Stripe
Route::get('/donations/{id}/success', [DonationController::class, 'success'])->name('donations.success');
Route::get('/donations/{id}/cancel', [DonationController::class, 'cancel'])->name('donations.cancel');
});
