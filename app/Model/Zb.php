<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\ZbDetail;

class Zb extends Model
{
    public $timestamps=false;

    public function zbdetails()
    {
    	return $this->hasMany(ZbDetail::class,'ZBID','ZBID');
    }

    public function GetDetailAttribute()
    {
      return $this->zbdetails->sum('JE');
    }



    protected $fillable = [
    'id'

            ,"GSDM"
            ,"KJND"
            ,"MXZBLB"
            ,"MXZBBH"
            ,"MXZBWH"
            ,"MXZBXH"
            ,"ZZBLB"
            ,"ZZBBH"
            ,"FWRQ"
            ,"DZKDM"
            ,"YSDWDM"
            ,"ZBLYDM"
            ,"YSKMDM"
            ,"ZJXZDM"
            ,"JFLXDM"
            ,"ZCLXDM"
            ,"XMDM"
            ,"ZFFSDM"
            ,"JE"
            ,"ZY"
            ,"LRR_ID"
            ,"LRR"
            ,"LR_RQ"
            ,"XGR_ID"
            ,"CSR_ID"
            ,"CSR"
            ,"CS_RQ"
            ,"HQBZ"
            ,"HQWCBZ"
            ,"SHJBR_ID"
            ,"SHR_ID"
            ,"SHR"
            ,"SH_RQ"
            ,"SNJZ"
            ,"NCYS"
            ,"BNZA"
            ,"BNZF"
            ,"BNBF"
            ,"ZBYE"
            ,"SJLY"
            ,"YZBLB"
            ,"YSGLLXDM"
            ,"ZBZT"
            ,"TZBZ"
            ,"JZRQ"
            ,"ZBID"
            ,"ZBIDWM"
            ,"DCBZ"
            ,"DCRID"
            ,"STAMP"
            ,"OAZT"
            ,"TZH"
            ,"JZR_ID"
            ,"PZFLH"
            ,"JZR_ID1"
            ,"PZFLH1"
            ,"DJZT"
            ,"SCJHJE"
            ,"DYBZ"
            ,"YWLXDM"
            ,"XMFLDM"
            ,"SJWH"
            ,"KZZLDM1"
            ,"KZZLDM2"
            ,"ASHR_ID"
            ,"ASHR"
            ,"ASH_RQ"
            ,"ASHJD"
            ,"AXSHJD"
            ,"ASFTH"
            ,"ZBLB"
            ,"DZKMC"
            ,"ZBLYMC"
            ,"YSDWMC"
            ,"YSDWQC"
            ,"YSKMMC"
            ,"YSKMQC"
            ,"ZJXZMC"
            ,"XMMC"
            ,"YSGLLXMC"
            ,"HQNAME"
            ,"ZZBWH"
            ,"ZZBXH",

    ];
}
