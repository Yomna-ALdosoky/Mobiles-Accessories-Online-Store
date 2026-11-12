<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use App\Models\CompanySetting;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $settings = Cache::remember('company_settings', now()->addDay(), function () {
                return CompanySetting::first();
            });
            $mega_categories = Category::whereNull('parent_id')
                ->active()
                ->with(['children' => function ($query) {
                    $query->active();
                }])
                ->latest()
                ->get();

            $view->with([
                'settings' => $settings,
                'mega_categories' => $mega_categories
            ]);
        });
    }
}
