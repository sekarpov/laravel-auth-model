<?php

namespace App\Providers;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin-panel', function (User $user) {
            return $user->isAdmin() || $user->isModerator();
        });

        //Gate::define('manage-contacts', function (User $user) {
        //    return $user->isAdmin() || $user->isModerator();
        //});
        //
        //Gate::define('show-contact', function (User $user, Contact $contact) {
        //    return $user->isAdmin() || $user->isModerator() || $contact->user_id === $user->id;
        //});
        //
        Gate::define('manage-own-contact', function (User $user, Contact $contact) {
            return $contact->user_id === $user->id;
        });
    }
}
