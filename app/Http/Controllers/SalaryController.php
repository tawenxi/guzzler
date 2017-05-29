<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Salary;

class SalaryController extends Controller
{
        public function index(\App\SalaryListImport $import)
    {
        $ziduan=['name',"account",'bumen','yishu_bz','tuixiu_gz','jiben_gz','jinbutie','gongche_bz','bufa_gz','nianzhong_jj','gjj_dw','sb_dw','gjj_gr','sb_gr','zhiye_nj','daikou_gz','hongfang_zj','yiliao_bx','shiye_bx','shengyu_bx','gongshang_bx','yirijuan','sb_js','gjj_js','tiaozheng_gjj','tiaozheng_sb','date'];
       $re = $import->skipRows(1)->get($ziduan)->each(function($v){
         $v->put('ok',$v->gjj_dw*2);  

       });


 //      $result->map(function($v){
 //        Salary::updateOrCreate(['name'=>$v['name']],$v->toArray());
      
 // }



     $res=Salary::all();
    // dd($res);
        return view('salary.index',compact('res'))->render();
    

	}



	 public function member(\App\SalaryListImport $import){
        $ziduan=['name',"borthday",'bumen','class','gangwei','sex','educational','worktime','ruraltime','xiangzhen_bz','sb_js','resume'];
       $result = $import
       ->skipRows(1)
       ->get($ziduan)
       ->each(function($v){
         $v->put('ok',$v->gjj_dw*2);  

       });



             $result->map(function($v){
             //	dd($v->toArray());
        $a=\App\Member::create($v->toArray());
       
      
 });


           

}




}
