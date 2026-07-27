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

    // Clients
    Route::resource('clients', ClientController::class);

    // Campagnes8
    Route::resource('campaigns', CampaignController::class);

    // Tâches
    Route::resource('tasks', TaskController::class);
    Route::patch('/tasks/{task}/update-status', [TaskController::class, 'updateStatus'])->name('tasks.updateStatus');

});
require __DIR__.'/auth.php';