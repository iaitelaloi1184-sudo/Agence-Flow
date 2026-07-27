<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\DashboardController;


// Page d'accueil → redirige vers login
Route::get('/', function () {
    return redirect('/login');
});

// Routes protégées (uniquement connectés)
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Clients — search AVANT resource
    Route::get('/clients/search', [ClientController::class, 'search'])
        ->name('clients.search');
    Route::resource('clients', ClientController::class);

    // Campagnes
    Route::resource('campaigns', CampaignController::class);

    // Tâches
    Route::resource('tasks', TaskController::class);
 
});

require __DIR__.'/auth.php';