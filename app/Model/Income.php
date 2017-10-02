<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    public $timestamps = true;
    protected $casts = [
        'amount' => 'float',
        'cost' => 'float',
    ];
    protected $dates = ['date', 'updated_at', 'created_at'];
    protected $fillable = ['date', 'amount', 'cost', 'zhaiyao', 'kemu', 'beizhu', 'xingzhi'];

    public function costs()
    {
        return $this->hasMany(Cost::class);
    }

    public function SetDateAttribute($val)
    {
        $this->attributes['date'] = \Carbon\Carbon::parse($val)->toDateTimeString();
    }

    public function GetDateAttribute($val)
    {
        return substr($val, 0, 10);
    }

    public function GetRemainAmountAttribute($val)
    {
        return $this->attributes['amount'] - $this->costs->sum('amount');
    }

    public function GetHasCostedAttribute($val)
    {
        return $this->costs->sum('amount');
    }

    public function scopeFp($query, $fp)
    {
        switch ($fp) {
            case '1':
                return $query->where('xingzhi', '扶贫整合资金');
                break;
            case '2':
                return $query->where('xingzhi', '');
                break;

            case '8':
                return $query->where('date', \Carbon\Carbon::parse('2017/04/01')->toDateTimeString());
                break;

            case '2016':
                return $query->where('zhaiyao', 'like', '2016%')->where('xingzhi', '扶贫整合资金');
                break;
            case '2017':
                return $query->where('zhaiyao', 'like', '2017%')->where('xingzhi', '扶贫整合资金');
                break;

            default:
                return $query;
                break;
        }
    }
}
