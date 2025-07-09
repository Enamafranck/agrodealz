<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{
    public const HOME = '/home'; //c
   // vers ta page d'accueil


    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Configuration Livewire (si nécessaire)
        // Pas besoin de configurer les routes ici
    }
}