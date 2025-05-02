<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeamController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/teams', [TeamController::class, 'index'])->name('teams.index');
Route::get('/teams/{slug}', [TeamController::class, 'show'])->name('teams.show');
Route::get('/teams/{slug}/modal', [TeamController::class, 'modal'])->name('teams.modal');
Route::get('/teams/create', [TeamController::class, 'create'])->name('teams.create');
Route::post('/teams', [TeamController::class, 'store'])->name('teams.store');
Route::get('/teams/{slug}/edit', [TeamController::class, 'edit'])->name('teams.edit');
Route::put('/teams/{slug}', [TeamController::class, 'update'])->name('teams.update');
Route::delete('/teams/{slug}', [TeamController::class, 'destroy'])->name('teams.destroy');