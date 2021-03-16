<?php

namespace App\Providers;

use App\UseCases\Auth\RegisterService;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Support\ServiceProvider;

class RegisterServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @param \Illuminate\Contracts\Mail\Mailer $mailer
     * @param \Illuminate\Contracts\Events\Dispatcher $dispatcher
     * @return void
     */
    public function boot(Mailer $mailer, Dispatcher $dispatcher)
    {
        $this->app->bind(RegisterService::class, function() use ($mailer, $dispatcher) {
            return new RegisterService($mailer, $dispatcher);
        });
    }
}
