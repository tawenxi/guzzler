<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Zb;

class ZbDetail extends Model
{
    public $timestamps=false;

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
