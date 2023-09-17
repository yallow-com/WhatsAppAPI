<?php

namespace YallowCom\WhatsAppAPI;

use Illuminate\Support\ServiceProvider;

class WhatsAppAPIServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('whatsapp-api', function()
        {
            return new WhatsAppAPI();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
