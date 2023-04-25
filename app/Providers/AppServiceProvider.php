<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Paginator::useBootstrapFive();
        Paginator::defaultSimpleView('view-name');
        Carbon::setLocale('id');

        Blade::directive('role', function($role) {
            return "<?php if(\Auth::check() && in_array(\Auth::user()->role, $role)): ?>";
        });
        Blade::directive('endrole', function() {
            return "<?php endif; ?>";
        });
    }
}
