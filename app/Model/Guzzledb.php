<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Guzzledb extends Model
{
    //
    public $fillable = ['DZKDM', 'DZKMC', 'YSDWDM', 'YSDWMC', 'ZJXZDM', 'ZJXZMC', 'ZFFSDM', 'YSKMDM', 'YSKMMC', 'JFLXDM', 'JFLXMC', 'ZCLXDM', 'ZCLXMC', 'XMDM', 'XMMC', 'ZBLYDM', 'ZBLYMC', 'ZJLYMC', 'YKJHZB', 'YYJHJE', 'KYJHJE', 'YSGLLXDM',  'YSGLLXMC', 'NEWYSKMDM', 'ZBID', 'ZY', 'ZBWH', 'body', 'ZBID'];

    public function payouts()
    {
        return $this->hasMany('App\Model\Payout', 'zbid', 'ZBID');
    }

    public function setYkjhzbAttribute($amount)
    {
        $this->attributes['YKJHZB'] = $amount * 100;
    }

    public function getYkjhzbAttribute($amount)
    {
        return \bcdiv($this->attributes['YKJHZB'], 100, 2);
    }

    public function setYyjhjeAttribute($amount)
    {
        $this->attributes['YYJHJE'] = $amount * 100;
    }

    public function getYyjhjeAttribute($amount)
    {
        return \bcdiv($this->attributes['YYJHJE'], 100, 2);
    }

    public function setKyjhjeAttribute($amount)
    {
        $this->attributes['KYJHJE'] = $amount * 100;
    }

    public function getKyjhjeAttribute($amount)
    {
        return \bcdiv($this->attributes['KYJHJE'], 100, 2);
    }
}
