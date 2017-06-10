<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    public $fillable=['member_id','name',"account",'bumen','yishu_bz','tuixiu_gz','bufa_gz','nianzhong_jj','gaowen_jiangwen','jiangjin','jiangjin_beizhu','jjbz','beuzhu','gjj_dw','sb_dw','gjj_gr','sb_gr','zhiye_nj','daikou_gz','hongfang_zj','yiliao_bx','shiye_bx','shengyu_bx','gongshang_bx','yirijuan','tiaozheng_gjj','tiaozheng_sb','date','jb_gz1','jb_gz2','jinbutie','gongche_bz','xiangzhen_bz','sb_js','gjj_js','other_daikou','daikou_beizhu'];


    public function scopeHasjj($query,$jj){

    	switch ($jj) {
    		case '1':
    			return $query->where('jjbz',null);
    			break;

    		case '2':
    			return $query->where('jjbz',2);
    			break;
    		
    		default:
    			return $query;
    			break;
    	}
    	
    }

    public function member(){
	return $this->belongsTo('App\Member','member_id','id');
	}

    public function setNameAttribute($name){
        $name=str_replace(" ", '', $name);
         $this->attributes['name'] = trim($name);
    }
}
