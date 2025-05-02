<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\Auth\LoginController;

// Public routes
Route::get('/', function () {
    // temporary redirect
    return redirect('/leaderboard');
});

Route::get('/leaderboard', [LeaderboardController::class, 'index'])->name('leaderboard.index');

// Authentication routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Protected routes
Route::middleware(['auth'])->group(function () {
    Route::get('/teams', [TeamController::class, 'index'])->name('teams.index');
    Route::get('/teams/{slug}', [TeamController::class, 'show'])->name('teams.show');
    Route::get('/teams/{slug}/modal', [TeamController::class, 'modal'])->name('teams.modal');
    Route::get('/teams/create', [TeamController::class, 'create'])->name('teams.create');
    Route::post('/teams', [TeamController::class, 'store'])->name('teams.store');
    Route::get('/teams/{slug}/edit', [TeamController::class, 'edit'])->name('teams.edit');
    Route::put('/teams/{slug}', [TeamController::class, 'update'])->name('teams.update');
    Route::delete('/teams/{slug}', [TeamController::class, 'destroy'])->name('teams.destroy');
    Route::post('/teams/{team}/add-match', [LeaderboardController::class, 'addMatch'])->name('leaderboard.add-match');
});