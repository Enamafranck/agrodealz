<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AnnoncesController;
use App\Http\Controllers\MaterielController;
use App\Http\Controllers\AcceuilController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\PayementController;
use App\Http\Controllers\AproposController;
use App\Http\Controllers\CatalogueController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ReservationController;
use App\Livewire\Utilisateurs; // ✅ Namespace correct

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Groupe des routes pour les administrateurs
Route::get('/Habilitations/Utilisateurs', [App\Http\Controllers\UserController::class, 'index'])
    ->name('Utilisateurs');
   
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
     Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
     // Afficher le formulaire de création
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');

// Afficher le formulaire d'édition
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');

// Mettre à jour un utilisateur
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
Route::resource('users', UserController::class);
// Dans votre fichier routes/web.php, ajoutez cette route :

Route::get('/gestions matériels/materiels', [MaterielController::class, 'index'])->name('Materiels');
Route::resource('materiels', MaterielController::class);
Route::get('/acceuil', [AcceuilController::class, 'index'])->name('acceuil');
Route::post('/materiel/{id}/louer', [LocationController::class, 'louer'])->name('materiel.louer');

// routes/web.php
Route::get('/location', [LocationController::class, 'create'])->name('location.create');
Route::post('/location', [LocationController::class, 'store'])->name('location.submit');
Route::get('/paiement/{location_id}', [PayementController::class, 'showForm'])->name('paiement.form');
Route::post('/paiement', [PayementController::class, 'store'])->name('paiement.store');
Route::get('/apropos', [AproposController::class, 'index'])->name('apropos');
Route::get('/catalogue', [CatalogueController::class, 'index'])->name('catalogue');
// Ajoutez ces routes
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

Route::get('/reservation', [ReservationController::class, 'create'])->name('reservation.create');
Route::post('/reservation', [ReservationController::class, 'store'])->name('reservation.store');
Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
Route::get('/reservations/{reservation}', [ReservationController::class, 'show'])->name('reservations.show');
Route::patch('/reservations/{reservation}/confirmer', [ReservationController::class, 'confirmer'])->name('reservations.confirmer');
Route::patch('/reservations/{reservation}/annuler', [ReservationController::class, 'annuler'])->name('reservations.annuler');Route::get('/reservations', [ReservationController::class, 'listeReservations'])->name('reservations.index');
Route::get('/reservations', [ReservationController::class, 'listeReservations'])->name('reservations.index');
Route::post('/api/calculer-prix', [ReservationController::class, 'calculerPrix'])->name('reservation.calculer-prix');
Route::get('/materiels', [MaterielController::class, 'index'])->name('materiels.index');
Route::get('/materiels/location', [MaterielController::class, 'showLocationForm'])->name('materiels.location');
Route::post('/materiels/location', [MaterielController::class, 'submitLocation'])->name('location.submit');

// Dans routes/web.php
Route::middleware(['auth'])->group(function () {
    Route::get('/publier-annonce', [App\Http\Controllers\AnnoncesController::class, 'create'])->name('publier.annonce');
    Route::post('/publier-annonce', [App\Http\Controllers\AnnoncesController::class, 'store'])->name('publier.annonce.store');
});










