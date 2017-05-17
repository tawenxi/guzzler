<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payout extends Model
{
    public $fillable=[ "id" ,"payee" ,"payeeaccount" ,"payeebanker" ,"amount" ,"zhaiyao" ,"zbid" ,"kemu" , "kemuname"];

}
