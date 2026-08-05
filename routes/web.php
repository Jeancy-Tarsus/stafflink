<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


use App\Http\Controllers\MetierController;
use App\Http\Controllers\TravailleurController;

Route::middleware(['auth'])->group(function () {

    Route::resource('metiers', MetierController::class);
});


Route::middleware(['auth'])->group(function () {
    Route::resource('metiers', MetierController::class);
});

Route::resource('travailleurs', TravailleurController::class);

use App\Http\Controllers\ClientController;
use App\Http\Controllers\DemandeController;

Route::resource('clients', ClientController::class);


Route::resource('demandes', DemandeController::class);

use App\Http\Controllers\AffectationController;

Route::get(
    'affectations/travailleurs/{demande}',
    [AffectationController::class, 'getTravailleurs']
)->name('affectations.travailleurs');


Route::resource('affectations', AffectationController::class);


use App\Http\Controllers\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

use App\Http\Controllers\ContratController;

Route::resource('contrats', ContratController::class);

use App\Http\Controllers\FactureController;

Route::resource('factures', FactureController::class);


use App\Http\Controllers\EncaissementController;

Route::resource('encaissements', EncaissementController::class);
