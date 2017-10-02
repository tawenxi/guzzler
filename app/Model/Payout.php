<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Payout extends Model
{
    public $fillable = ['id', 'payee', 'payeeaccount', 'payeebanker', 'amount', 'zhaiyao', 'zbid', 'kemu', 'kemuname'];

    public function guzzledb()
    {
        return $this->belongsTo('App\Model\Guzzledb', 'zbid', 'ZBID');
    }

    public function setDateAttribute($val)
    {
        return $this->attributes['created_at']->toDateString();
    }
}
