<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guzzledb extends Model
{
    //
    public $fillable = [ "DZKDM" ,"DZKMC" ,"YSDWDM" ,"YSDWMC" ,"ZJXZDM" ,"ZJXZMC" ,"ZFFSDM" ,"YSKMDM" , "YSKMMC" ,"JFLXDM" ,"JFLXMC" , "ZCLXDM" , "ZCLXMC" ,"XMDM" ,"XMMC" , "ZBLYDM", "ZBLYMC" , "ZJLYMC" , "YKJHZB" ,"YYJHJE" , "KYJHJE" , "YSGLLXDM",  "YSGLLXMC" , "NEWYSKMDM" ,"ZBID" ,"ZY" ,"ZBWH","body","ZBID"];
    public function payouts(){
    	return $this->hasMany('App\Payout','zbid','ZBID');
    }
}
