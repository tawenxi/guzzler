<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    
    public function update(\App\Model\User $currentUser, \App\Model\User $user)
    {

        return $currentUser->id === $user->id;
    }

}
