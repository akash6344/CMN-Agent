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
    
    // Non-dashboard sections redirect with coming soon parameter
    Route::get('/leads', fn() => redirect()->route('agent.dashboard', ['coming_soon' => 'Leads Management']))->name('leads');
    Route::get('/properties', fn() => redirect()->route('agent.dashboard', ['coming_soon' => 'Property Portfolio']))->name('properties');
    Route::get('/bargain', fn() => redirect()->route('agent.dashboard', ['coming_soon' => 'Smart Bargain & Deals']))->name('bargain');
    Route::get('/visits', fn() => redirect()->route('agent.dashboard', ['coming_soon' => 'Site Visits']))->name('visits');
    Route::get('/earnings', fn() => redirect()->route('agent.dashboard', ['coming_soon' => 'Earnings & Commission']))->name('earnings');
    Route::get('/analytics', fn() => redirect()->route('agent.dashboard', ['coming_soon' => 'Analytics']))->name('analytics');
    Route::get('/notifications', fn() => redirect()->route('agent.dashboard', ['coming_soon' => 'Notifications']))->name('notifications');
    Route::get('/settings', fn() => redirect()->route('agent.dashboard', ['coming_soon' => 'Settings']))->name('settings');
});
