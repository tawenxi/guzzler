<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Cost;

class Income extends Model
{
    public $timestamps=true;
	protected $casts = [
        'amount' => 'float',
        'cost' => 'float',
    ];
    protected $dates = ['date','updated_at','created_at'];
	protected $fillable = ['date','amount','cost','zhaiyao','kemu','beizhu','xingzhi'];

    public function costs()
    {
    	return $this->hasMany(Cost::class);
    }
    public function SetDateAttribute($val)
    {
    	$this->attributes['date']=\Carbon\Carbon::parse($val)->toDateTimeString();
    }
    public function GetDateAttribute($val)
    {
    	return substr($val, 0,10);
    }
    public function GetRemainAmountAttribute($val)
    {
        return $this->attributes['amount']-$this->costs->sum('amount');
    }
}
