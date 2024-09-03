<?php

namespace App\Providers;

use Illuminate\Support\Facades;
use Illuminate\Support\ServiceProvider;
use App\Filament\Services\PageSectionResolver;

use App\Filament\Services\PageSectionsService;

class PageSectionsServiceProvider extends ServiceProvider
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
        PageSectionsService::bootViewComposers();

    }
}
