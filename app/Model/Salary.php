<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    public $fillable = ['member_id','name',"account",'bumen','yishu_bz','tuixiu_gz','bufa_gz','nianzhong_jj','gaowen_jiangwen','jiangjin','jiangjin_beizhu','jjbz','beuzhu','gjj_dw','sb_dw','gjj_gr','sb_gr','zhiye_nj','daikou_gz','hongfang_zj','yiliao_bx','shiye_bx','shengyu_bx','gongshang_bx','yirijuan','tiaozheng_gjj','tiaozheng_sb','date','jb_gz1','jb_gz2','jinbutie','gongche_bz','xiangzhen_bz','sb_js','gjj_js','other_daikou','daikou_beizhu'];


    public function scopeHasjj($query,$jj)
    {

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

    public function member()
    {
	   return $this->belongsTo('App\Model\Member','member_id','id');
	}

    public function setNameAttribute($name)
    {
        $name = str_replace(" ", '', $name);
         $this->attributes['name'] = trim($name);
    }

    public function getYingFaSumAttribute($val)
    {
        return $this->attributes['yishu_bz']+
               $this->attributes['tuixiu_gz']+
               $this->attributes['jb_gz1']+
               $this->attributes['jb_gz2']+
               $this->attributes['jinbutie']+
               $this->attributes['gongche_bz']+
               $this->attributes['xiangzhen_bz']+
               $this->attributes['bufa_gz']+
               $this->attributes['nianzhong_jj']+
               $this->attributes['gaowen_jiangwen']+
               $this->attributes['jiangjin']+
               $this->attributes['gjj_dw']+
               $this->attributes['sb_dw'];
        
    }

    public function getDaiKouSumAttribute($val)
    {
        return $this->attributes['gjj_gr']+
               $this->attributes['gjj_dw']+
               $this->attributes['sb_gr']+
               $this->attributes['sb_dw']+
               $this->attributes['zhiye_nj']+
               $this->attributes['daikou_gz']+
               $this->attributes['fanghong_zj']+
               $this->attributes['yiliao_bx']+
               $this->attributes['shiye_bx']+
               $this->attributes['shengyu_bx']+
               $this->attributes['gongshang_bx']+
               $this->attributes['yirijuan']+
               $this->attributes['other_daikou']+
               $this->attributes['tiaozheng_gjj']+
               $this->attributes['tiaozheng_sb'];
    }







                     
}
