<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\Show;
use App\Observers\PostObserver;
use App\Observers\ShowObserver;

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
        if (config('database.default') === 'pgsql') {
            try {
                DB::statement('SET search_path TO public');
            } catch (\Exception $e) {
                // ignore if DB not available yet
            }
        }
        Post::observe(PostObserver::class);
        Show::observe(ShowObserver::class);
    }
}
