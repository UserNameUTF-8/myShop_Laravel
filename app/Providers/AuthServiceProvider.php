<?php

namespace App\Providers;


use App\Models\User;
use App\Policies\ProductPolicy;
use App\Models\product;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
    //    product::class => ProductPolicy::class

    ];

    /**
     * Register any authentication / authorization services.
     */

     
    public function boot(): void
    {
        $this->registerPolicies();



        Gate::define('user-product', function ($user, $product) {
            return $user->id === $product->user_id;
        });



        Gate::define('sudo', function ($user) {
            return $user->role == 'Admin';
        });
        


        Gate::define('user', function ($user) {
            return $user->id = Auth::user()->id;
        });


        Gate::define('user-admin', function ($user) {
            return $user->id == Auth::user()->id || $user->role == 'Admin';
        });
        
    }
}
