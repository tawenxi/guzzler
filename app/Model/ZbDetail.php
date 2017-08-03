<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Zb;
use Nicolaslopezj\Searchable\SearchableTrait;

class ZbDetail extends Model
{
    use SearchableTrait;
    public $timestamps=false;

    protected $searchable = [
    'columns' => [
        'zb_details.ZY' => 10,
        'zb_details.JE' => 10,
        'zb_details.LR_RQ' => 5,
        'zb_details.YSDWMC' => 50,
        'zb_details.XMMC' => 10,
        'zb_details.YSKMMC' => 5,
        'zb_details.ZFFSMC' => 5,
        ]
    ];

    public function zb()
    {
        return $this->belongsTo(Zb::class,'ZBID','ZBID');
    }

    protected $fillable = [
    		"BJDJ"
            ,"BGDJID"
            ,"DJZT"
            ,"ZY"
            ,"SQJE1"
            ,"JE"
            ,"WH"
            ,"DZKDM"
            ,"DZKMC"
            ,"YSDWDM"
            ,"YSDWMC"
            ,"YSKMDM"
            ,"YSKMMC"
            ,"JFLXDM"
            ,"JFLXMC"
            ,"XMDM"
            ,"XMMC"
            ,"ZJXZDM"
            ,"ZJXZMC"
            ,"ZBLYDM"
            ,"ZBLYMC"
            ,"ZCLXDM"
            ,"ZCLXMC"
            ,"ZFFSDM"
            ,"ZFFSMC"
            ,"LR_RQ"
            ,"LRR"
            ,"ZBID"];
}
