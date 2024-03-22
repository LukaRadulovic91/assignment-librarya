<?php

namespace App\Providers;

 use Illuminate\Support\Facades\Gate;
 use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
 use App\Enums\Roles;
 use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
//        User::class => MenuItemPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('isReviewer', static function ($user) {
            return $user->role_id === Roles::REVIEWER;
        });
    }
}
