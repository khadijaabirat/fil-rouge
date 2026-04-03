<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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


});

Route::middleware(['auth','role:association'])->group(function(){
Route::get('/association/dashboard',function(){
return view('dashboard');
})->name('association.dashboard');
});

Route::middleware(['auth','role:donator'])->group(function(){
Route::get('/donator/dashboard',function(){
return view('dashboard');
})->name('donator.dashboard');
});
