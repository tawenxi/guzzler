<?php

namespace App\Model\Respostory;

class SalarySum
{
    
    public $object;
	public $title;

	public function __construct(){
		$this->title= collect([	
				'tuixiu_gz',
 				'yishu_bz',
 				'jb_gz1',
				'jb_gz2',
				'jinbutie',
				'gongche_bz',
				'xiangzhen_bz',
				'nianzhong_jj',
				'gaowen_jiangwen',
				'jiangjin',
				'bufa_gz',
				'gjj_dw',
				'sb_dw',
				'gjj_gr',
				'sb_gr',
				'zhiye_nj',
				'daikou_gz',
				'fanghong_zj',
				'yiliao_bx',
				'shiye_bx',
				'shengyu_bx',
				'gongshang_bx',
				'yirijuan',
				'other_daikou',
				'tiaozheng_gjj',
				'tiaozheng_sb',		
]);
	}

    public function getObject($object){
    	$this->object = $object;
    	return $this;
    }

    public function getTitle(){
    	$object = $this->object;
    	$real_title = $this->title->map(function($val) use($object){
    		if ($object->sum($val)>0) {
    			return $val;
    		}
    	})->filter(function($val){
    		return $val!=null;
    	});
    	return $real_title;
    }
}
