<?php

declare(strict_types=1);

namespace Storipress\Facebook;

use Illuminate\Support\ServiceProvider;

class FacebookServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(
            'facebook',
            fn () => $this->app->make(Facebook::class),
        );
    }
}
