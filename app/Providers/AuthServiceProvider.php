<?php

namespace App\Providers;

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
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('all', function ($user) {
            return $user->hasAnyRoles([
            'Manager',
            'BranchManagerAssistant',
            'Salesperson',
            'DeliveryStaff',
            'GeneralStaff'
            ]);
        });
        Gate::define('Manager', function ($user) {
            return $user->hasAnyRoles([
            'Manager',
            // 'BranchManagerAssistant',
            // 'Salesperson',
            // 'DeliveryStaff',
            // 'GeneralStaff'
            ]);
        });
        Gate::define('BranchManagerAssistant', function ($user) {
            return $user->hasAnyRoles([
                // 'Manager',
                'BranchManagerAssistant',
                // 'Salesperson',
                // 'DeliveryStaff',
                // 'GeneralStaff'
                ]);
            });
        Gate::define('Salesperson', function ($user) {
            return $user->hasAnyRoles([
            // 'Manager',
            // 'BranchManagerAssistant',
            'Salesperson',
            // 'DeliveryStaff',
            // 'GeneralStaff'
            ]);
        });
        Gate::define('DeliveryStaff', function ($user) {
            return $user->hasAnyRoles([
            // 'Manager',
            // 'BranchManagerAssistant',
            // 'Salesperson',
            'DeliveryStaff',
            // 'GeneralStaff'
            ]);
        });
        Gate::define('GeneralStaff', function ($user) {
            return $user->hasAnyRoles([
            // 'Manager',
            // 'BranchManagerAssistant',
            // 'Salesperson',
            // 'DeliveryStaff',
            'GeneralStaff'
            ]);
        });
        Gate::define('import', function ($user) {
            return $user->hasAnyRoles([
            'Manager',
            'BranchManagerAssistant',
            'Salesperson',
            // 'DeliveryStaff',
            // 'GeneralStaff'
            ]);
        });
        Gate::define('Manager-menu', function ($user) {
            return $user->hasRole('Manager');
        });
        Gate::define('Manager-product', function ($user) {
            return $user->hasRole(
                ['Manager',
            'BranchManagerAssistant'
            ,]
        );
        });
        Gate::define('edit-employee', function ($user) {
            return $user->hasAnyRoles([
                'Manager',
                'BranchManagerAssistant',
                ]);
        });
    }
}
