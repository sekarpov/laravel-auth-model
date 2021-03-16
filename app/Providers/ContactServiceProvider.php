<?php

namespace App\Providers;

use App\UseCases\Contacts\ContactService;
use App\UseCases\Contacts\FavoriteService;
use Illuminate\Support\ServiceProvider;

class ContactServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ContactService::class, function (){
            return new ContactService();
        });
        $this->app->bind(FavoriteService::class, function () {
            return new FavoriteService();
        });
    }
}
