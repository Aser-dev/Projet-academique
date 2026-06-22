<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\VisitRequestController;
use App\Http\Controllers\ValidationController;
use App\Http\Controllers\AgencyPropertyController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ProfileController;

Route::get('/', [PropertyController::class, 'index'])->name('home');
Route::get('/property/{property}', [PropertyController::class, 'show'])->name('property.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:client'])->group(function () {
    Route::get('/client/dashboard', [DashboardController::class, 'client'])->name('client.dashboard');
    Route::get('/client/visits-history', [VisitRequestController::class, 'clientHistory'])->name('client.visits-history');
    Route::post('/favorite/{property}', [FavoriteController::class, 'toggle'])->name('favorite.toggle');
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('client.favorites');
    Route::post('/visit/{property}', [VisitRequestController::class, 'store'])->name('visit.request');
});

Route::middleware(['auth', 'role:bailleur'])->group(function () {
    Route::get('/bailleur/dashboard', [DashboardController::class, 'bailleur'])->name('bailleur.dashboard');
    Route::get('/bailleur/properties', [PropertyController::class, 'myProperties'])->name('bailleur.properties');
    Route::resource('properties', PropertyController::class)->except(['index','show']);
});

Route::middleware(['auth', 'role:agent'])->group(function () {
    Route::get('/agent/dashboard', [DashboardController::class, 'agent'])->name('agent.dashboard');
    Route::get('/agent/dashboard/stats', [\App\Http\Controllers\AgentDashboardController::class, 'stats'])->name('agent.dashboard.stats');

    Route::get('/agent/validations', [ValidationController::class, 'index'])->name('agent.validations');
    Route::post('/agent/validations/{property}/validate', [ValidationController::class, 'validate'])->name('agent.validate');
    Route::post('/agent/validations/{property}/reject', [ValidationController::class, 'reject'])->name('agent.reject');

    Route::get('/agent/visits', [VisitRequestController::class, 'agentIndex'])->name('agent.visits');
    Route::post('/agent/visits/{visit}/status', [VisitRequestController::class, 'updateStatus'])->name('agent.visits.update');

    Route::get('/agent/properties', [AgencyPropertyController::class, 'index'])->name('agent.properties');
    Route::get('/agent/properties/agency/create', [AgencyPropertyController::class, 'create'])->name('agent.properties.create');
    Route::post('/agent/properties/agency', [AgencyPropertyController::class, 'store'])->name('agent.properties.store');
});

Route::middleware(['auth', 'role:manager'])->prefix('manager')->group(function () {
    Route::get('/dashboard', [ManagerController::class, 'dashboard'])->name('manager.dashboard');
    Route::get('/stats', [ManagerController::class, 'stats'])->name('manager.stats');
    
    // User Management - EF-D5
    Route::get('/users', [ManagerController::class, 'users'])->name('manager.users');
    Route::get('/users/create', [ManagerController::class, 'createUser'])->name('manager.users.create');
    Route::post('/users', [ManagerController::class, 'storeUser'])->name('manager.users.store');
    Route::get('/users/{user}/edit', [ManagerController::class, 'editUser'])->name('manager.users.edit');
    Route::put('/users/{user}', [ManagerController::class, 'updateUser'])->name('manager.users.update');
    Route::delete('/users/{user}', [ManagerController::class, 'deleteUser'])->name('manager.users.delete');
    Route::put('/users/{user}/toggle-active', [ManagerController::class, 'toggleActive'])->name('manager.users.toggle');
    
    // Client Assignment - EF-D6
    Route::post('/affect-client', [ManagerController::class, 'affectClient'])->name('manager.affect');
    
    // Property Management - EF-D8
    Route::post('/properties/{property}/withdraw', [ManagerController::class, 'withdrawProperty'])->name('manager.properties.withdraw');
});

