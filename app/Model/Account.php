<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
	public $timestamps=false;
    protected $fillable = ['account_number','account_name'];
}
