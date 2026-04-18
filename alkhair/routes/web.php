<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AssociationController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\DonatorController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\ImpactReportController;
use App\Http\Controllers\CategoryController;
use App\Models\Project;
use Illuminate\Http\Request;
require __DIR__.'/auth.php'; 
Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/projets', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/{id}', [ProjectController::class, 'show'])->whereNumber('id')->name('projects.show');

 

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
  

Route::middleware(['auth','role:admin'])->group(function(){
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::post('/admin/association/{id}/validate', [AdminController::class, 'validateAssociation'])->name('admin.validateAssociation');
Route::post('/admin/donation/{id}/validate', [AdminController::class, 'validateDonation'])->name('admin.validateDonation');
Route::post('/admin/donation/{id}/reject', [AdminController::class, 'rejectDonation'])->name('admin.rejectDonation');
Route::post('/admin/project/{id}/approve-withdrawal', [AdminController::class, 'approveWithdrawal'])->name('admin.approveWithdrawal');
 Route::post('/admin/association/{id}/ban', [AdminController::class, 'banAssociation'])->name('admin.banAssociation');
  Route::post('/admin/project/{id}/suspend', [AdminController::class, 'suspendProject'])->name('admin.suspendProject');
     Route::post('/admin/association/{id}/unban', [AdminController::class, 'unbanAssociation'])->name('admin.unbanAssociation');
    Route::post('/admin/project/{id}/restore', [AdminController::class, 'restoreProject'])->name('admin.restoreProject');
     Route::get('/admin/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
    Route::post('/admin/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
 Route::get('/admin/categories/{id}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::put('/admin/categories/{id}', [CategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/admin/categories/{id}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
 
    });

Route::middleware(['auth','verified','role:association'])->group(function(){
Route::get('/association/dashboard', [AssociationController::class, 'dashboard'])->name('association.dashboard');
 
Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/projects/{id}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::put('/projects/{id}', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/projects/{id}', [ProjectController::class, 'destroy'])->name('projects.destroy');

Route::post('/projects/{id}/extend', [\App\Http\Controllers\ProjectController::class, 'extendDeadline'])->name('projects.extend');
Route::post('/association/projects/{id}/withdraw', [AssociationController::class, 'withdrawFunds'])->name('association.withdraw');
Route::get('/association/projects/{id}/impact', [ImpactReportController::class, 'create'])->name('impact.create');
Route::post('/association/projects/{id}/impact', [ImpactReportController::class, 'store'])->name('impact.store');
Route::get('/association/profile', [\App\Http\Controllers\AssociationController::class, 'editProfile'])->name('association.profile');
Route::put('/association/profile', [\App\Http\Controllers\AssociationController::class, 'updateProfile'])->name('association.updateProfile');

});

Route::middleware(['auth','verified','role:donator'])->group(function(){
Route::get('/donator/dashboard', [DonatorController::class, 'dashboard'])->name('donator.dashboard');


Route::get('/projects/{id}/donate', [DonationController::class, 'create'])->name('donations.create');
Route::post('/projects/{id}/donate', [DonationController::class, 'store'])->name('donations.store');

//  Stripe
Route::get('/donations/{id}/success', [DonationController::class, 'success'])->name('donations.success');
Route::get('/donations/{id}/cancel', [DonationController::class, 'cancel'])->name('donations.cancel');
});
