<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Permission;
use App\User;

class Role extends Model
{
    public function permissions()
    {
    	return $this->belongsToMany(Permission::class);
    }
    public function givePermission(Permission $permission)
    {
    	return $this->permissions()->save($permission);
    }
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
