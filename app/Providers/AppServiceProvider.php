<?php

namespace App\Providers;

use App\Http\Middleware\EnsureUserIsAdmin;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{
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
        // Re-apply the admin check on Livewire update requests from admin pages.
        Livewire::addPersistentMiddleware([
            EnsureUserIsAdmin::class,
        ]);
    }
}
