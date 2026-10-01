<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Agent\AgentController;

// Default redirect to agent dashboard
Route::get('/', function () {
    return redirect()->route('agent.dashboard');
});

// Agent Portal routes
Route::prefix('agent')->name('agent.')->group(function () {
    Route::get('/dashboard', [AgentController::class, 'dashboard'])->name('dashboard');
    Route::get('/leads', [AgentController::class, 'leads'])->name('leads');
    Route::get('/properties', [AgentController::class, 'properties'])->name('properties');
    Route::get('/earnings', [AgentController::class, 'earnings'])->name('earnings');
    
    // Remaining sections redirect with coming soon parameter
    Route::get('/bargain', fn() => redirect()->route('agent.dashboard', ['coming_soon' => 'Smart Bargain & Deals']))->name('bargain');
    Route::get('/visits', fn() => redirect()->route('agent.dashboard', ['coming_soon' => 'Site Visits']))->name('visits');
    Route::get('/analytics', fn() => redirect()->route('agent.dashboard', ['coming_soon' => 'Analytics']))->name('analytics');
    Route::get('/notifications', fn() => redirect()->route('agent.dashboard', ['coming_soon' => 'Notifications']))->name('notifications');
    Route::get('/settings', fn() => redirect()->route('agent.dashboard', ['coming_soon' => 'Settings']))->name('settings');
});
