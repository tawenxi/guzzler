<?php

namespace App\Providers;

use App\Model\User;
use App\Model\Permission;
use App\Policies\UserPolicy;
use Illuminate\Database\QueryException;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        User::class  => UserPolicy::class,
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param \Illuminate\Contracts\Auth\Access\Gate $gate
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);
        foreach ($this->getPermission() as $key => $permission) {
            $gate->define($permission->name, function ($user) use ($permission) {
                return $user->hasRole($permission->roles);
            });
        }

        $gate->define('export', function ($user) {
            return ! (\Input::has('export'));
        });
    }

    protected function getPermission()
    {
        try {
            $permissions = Permission::with('roles')->get();
        } catch (QueryException $e) {
            $permissions = [];
        }

        return $permissions;
    }
}
