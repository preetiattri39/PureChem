<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentAsset;

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
        $headerPath = storage_path('app/private/content/header.php');
        $footerPath = storage_path('app/private/content/footer.php');

        $headerData = file_exists($headerPath) ? include $headerPath : [];
        $footerData = file_exists($footerPath) ? include $footerPath : [];

        View::share('globalHeaderData', $headerData);
        View::share('globalFooterData', $footerData);

        FilamentAsset::register([
            Css::make('chat-stylesheet', __DIR__ . '/../../resources/css/pages/chat.css'),
        ]);
    }
}
