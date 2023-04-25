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
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
        Gate::define('isAdmin', function($admin) {
            return $admin->role == 'admin';
        });
        Gate::define('isDosen', function($dosen) {
            return $dosen->role == 'dosen';
        });
        Gate::define('isFungsionaris', function($fungsionaris) {
            return $fungsionaris->role == 'fungsionaris';
        });
        Gate::define('isChaplin', function($chaplin) {
            return $chaplin->role == 'chaplin';
        });
        Gate::define('isMahasiswa', function($mahasiswa) {
            return $mahasiswa->role == 'mahasiswa';
        });
    }
}
