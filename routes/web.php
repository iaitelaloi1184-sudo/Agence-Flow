<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PasswordSetupController;


Route::get('/password/setup/{user}', [PasswordSetupController::class, 'show'])
    ->name('password.setup')
    ->middleware('signed');

Route::post('/password/setup/{user}', [PasswordSetupController::class, 'store'])
    ->name('password.setup.store');


Route::get('/', function () {
    return redirect('/login');
});


Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ---- Gestion complète : réservée aux admins ----
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('clients', ClientController::class)->except(['index', 'show']);
        Route::resource('campaigns', CampaignController::class)->except(['index', 'show']);
        Route::resource('tasks', TaskController::class)->except(['index', 'show']);
        Route::resource('employees', EmployeeController::class);
    });

    // ---- Lecture : accessible à tous les utilisateurs connectés (admin + employé) ----

    Route::get('/clients/search', [ClientController::class, 'search'])->name('clients.search');
    Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
    Route::get('/clients/{client}', [ClientController::class, 'show'])->name('clients.show');

    Route::get('/campaigns', [CampaignController::class, 'index'])->name('campaigns.index');
    Route::get('/campaigns/{campaign}', [CampaignController::class, 'show'])->name('campaigns.show');
    Route::get('/campaigns/{campaign}/pdf', [CampaignController::class, 'exportPdf'])->name('campaigns.pdf');

    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('/tasks/{task}', [TaskController::class, 'show'])->name('tasks.show');

    // Actions employé : mise à jour du statut (sur SES tâches) + commentaires
    Route::patch('/tasks/{task}/update-status', [TaskController::class, 'updateStatus'])->name('tasks.updateStatus');
    Route::post('/tasks/{task}/comments', [TaskController::class, 'addComment'])->name('tasks.comments.store');
    Route::delete('/tasks/{task}/comments/{comment}', [TaskController::class, 'destroyComment'])->name('tasks.comments.destroy');

    
});

require __DIR__.'/auth.php';