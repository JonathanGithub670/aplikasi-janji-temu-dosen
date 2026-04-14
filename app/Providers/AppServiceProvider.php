<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::defaultSimpleView('view-name');
        Carbon::setLocale('id');

        Blade::directive('role', function ($role) {
            return "<?php if(\Auth::check() && in_array(\Auth::user()->role, $role)): ?>";
        });
        Blade::directive('endrole', function () {
            return "<?php endif; ?>";
        });

        // Gates (migrated from AuthServiceProvider)
        Gate::define('isAdmin', function ($admin) {
            return $admin->role == 'admin';
        });
        Gate::define('isDosen', function ($dosen) {
            return $dosen->role == 'dosen';
        });
        Gate::define('isFungsionaris', function ($fungsionaris) {
            return $fungsionaris->role == 'fungsionaris';
        });
        Gate::define('isChaplin', function ($chaplin) {
            return $chaplin->role == 'chaplin';
        });
        Gate::define('isMahasiswa', function ($mahasiswa) {
            return $mahasiswa->role == 'mahasiswa';
        });
    }
}
