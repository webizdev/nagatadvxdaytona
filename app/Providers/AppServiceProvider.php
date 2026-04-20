<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\WebsiteSetting;
use App\Models\SocialMedia;
use App\Models\Branch;

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
        // Share website settings, social media, and branches with all views
        View::composer('*', function ($view) {
            $settings = WebsiteSetting::all()->pluck('value', 'key');
            $socials = SocialMedia::all();
            $branches = Branch::all();
            
            $view->with([
                'webSettings' => $settings,
                'socials' => $socials,
                'branches' => $branches
            ]);
        });
    }
}
