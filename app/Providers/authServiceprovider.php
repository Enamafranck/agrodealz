<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

         // Gate pour l'administrateur
        Gate::define('administrateur', function ($user) {
            return $user->hasrole("administrateur");
        });

        // Gate pour le propriétaire
        Gate::define('proprietaire', function ($user) {
            return $user->hasrole("proprietaire");
        });

        // Gate pour l'agriculteur
        Gate::define('agriculteur', function ($user) {
            return $user->hasrole("agriculteur");
        });

        // Vous pouvez ajouter des Gates personnalisés ici
        // Gate::define('admin-only', function ($user) {
        //     return $user->hasRole('admin');
        // });
    }
}