<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\User;
use App\Policies\UserPolicy;
use App\Model\Permission;
use Illuminate\Support\Facades\Schema;

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
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);
        foreach ($this->getPermission() as $key => $permission) {
            $gate->define($permission->name, function($user)use ($permission){
                return $user->hasRole($permission->roles);
            });
        }

        $gate->define('export', function($user){
                return !(\Input::has('export'));
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
