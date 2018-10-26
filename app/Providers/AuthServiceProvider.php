<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Implicitamente concede à função "super-admin" todas as permissões
        // Isso funciona no aplicativo usando funções relacionadas ao gate como auth()->user()->can() e @can()
        Gate::before(function ($user, $ability) {
            if ($user->hasRole('super-admin')) {
                return true;
            }
        });
    }
}
