<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Role;

class Permission extends Model
{
    public function roles()
    {
    	return $this->belongsToMany(Role::class);
    }
}
