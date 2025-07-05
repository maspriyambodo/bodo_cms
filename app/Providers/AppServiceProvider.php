<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Yajra\DataTables\Html\Builder;
use Laravel\Sanctum\Sanctum;
use App\Models\Sanctum\PersonalAccessToken;

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
        // Configure pagination views
        Paginator::useBootstrapFive();

        // Configure DataTables HTML builder
        Builder::useVite();

        // Configure Sanctum personal access tokens
        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
    }
}
