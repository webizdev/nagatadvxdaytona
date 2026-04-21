<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\WebsiteSetting;
use App\Models\SocialMedia;
use App\Models\Branch;
use Illuminate\Support\Facades\URL;

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
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        // Share website settings, social media, branches, and web content with all views
        View::composer('*', function ($view) {
            $settings = WebsiteSetting::all()->pluck('value', 'key');
            $socials = SocialMedia::all();
            $branches = Branch::all();
            
            // Get all web content as a collection for easy access
            $webContents = \App\Models\WebContent::all()->mapWithKeys(function($item) {
                $val = $item->value;
                if ($item->type === 'image' && $val && !str_starts_with($val, 'http')) {
                    $val = asset('storage/' . $val);
                }
                return [$item->slug => $val];
            });
            
            $view->with([
                'webSettings' => $settings,
                'socials' => $socials,
                'branches' => $branches,
                'webContents' => $webContents
            ]);
        });
    }
}
