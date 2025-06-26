<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Livewire\Utilisateurs; // ✅ Namespace correct

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Groupe des routes pour les administrateurs
Route::get('/Habilitations/Utilisateurs', [App\Http\Controllers\UserController::class, 'index'])
    ->name('Utilisateurs');
   
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');

