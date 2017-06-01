<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
     public $fillable=['name',"cardid",'bankaccount','bumen','class','gangwei','sex','educational','worktime','ruraltime','xiangzhen_bz','gongche_bz','jb_gz1','jb_gz2','jinbutie','status','lizhiriqi','resume','sb_js','gjj_js'];


    public function sararys(){
    	return $this->hasMany('App\Sarary','id','member_id');
    }
}
