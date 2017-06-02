<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Salary;

class SalaryController extends Controller
{
        public function index(Request $request)
    {

    	/*=============================================
    	=            Section comment block            =
    	=============================================*/
    	
    	
       //  $ziduan=['name',"account",'bumen','yishu_bz','tuixiu_gz','jiben_gz','jinbutie','gongche_bz','bufa_gz','nianzhong_jj','gjj_dw','sb_dw','gjj_gr','sb_gr','zhiye_nj','daikou_gz','hongfang_zj','yiliao_bx','shiye_bx','shengyu_bx','gongshang_bx','yirijuan','sb_js','gjj_js','tiaozheng_gjj','tiaozheng_sb','date'];
       // $re = $import->skipRows(1)->get($ziduan)->each(function($v){
       //   $v->put('ok',$v->gjj_dw*2);  

       // });
    	
    	/*=====  End of Section comment block  ======*/
    	


 //      $result->map(function($v){
 //        Salary::updateOrCreate(['name'=>$v['name']],$v->toArray());
      
 // }




 //echo \Carbon\Carbon::parse('2014-01')->todatestring();
      $dt=$request->date?$request->date:substr(str_replace('-','',\Carbon\Carbon::now()->toDateString()),0,-2);
      //dd($dt);

       $res=Salary::where('date','<=',\Carbon\Carbon::parse($dt.'27'))->where('date','>=',\Carbon\Carbon::parse($dt.'01'))->get();
       $dates=Salary::groupBy('date')->get()->pluck('date');
      // $dates=Salary::groupBy('date')->get()->groupBy('date');
       return view('salary.index',compact('res','dates'))->render();
    

	}


   public function bumen(Request $request)
    {

      $dt=$request->date?$request->date:substr(str_replace('-','',\Carbon\Carbon::now()->toDateString()),0,-2);

       $res=Salary::where('date','<=',\Carbon\Carbon::parse($dt.'27'))->where('date','>=',\Carbon\Carbon::parse($dt.'01'))->get()->groupBy('bumen');


       $resv=Salary::where('date','<=',\Carbon\Carbon::parse($dt.'27'))->where('date','>=',\Carbon\Carbon::parse($dt.'01'))->get();

       
       $dates=Salary::groupBy('date')->get()->pluck('date');

       return view('salary.bumen',compact('res','dates','resv'))->render();
    

  }


  public function geren($id=39,$jj=null)
    {

      

       $res=Salary::where('member_id',$id);

         if ($jj!=null) {
         $res=$res->where('jjbz',($jj==1)?null:2);
       }

       $res=$res->get()->groupBy('date');
       $resv=Salary::where('member_id',$id);
       if ($jj!=null) {
         $resv=$resv->where('jjbz',($jj==1)?null:2);
       }
       $resv=$resv->get();

       
       $dates=Salary::groupBy('date')->get()->pluck('date');

       return view('salary.geren',compact('res','dates','resv'))->render();
    

  }



  public function byear($year=2017,$jj=null)//1只显示工资，2只显示奖金
    {

     
      if ($jj==null) {
               $res=Salary::where('date','>=',\Carbon\Carbon::parse($year.'-01-01'))->where('date','<=',\Carbon\Carbon::parse($year.'-12-31'))
         ->get()
         ->groupBy('bumen');

       $resv=Salary::where('date','>=',\Carbon\Carbon::parse($year.'-01-01'))   ->where('date','<=',\Carbon\Carbon::parse($year.'-12-31'))
            ->get();
      }elseif ($jj==1) {
        $res=Salary::where('date','>=',\Carbon\Carbon::parse($year.'-01-01'))->where('date','<=',\Carbon\Carbon::parse($year.'-12-31'))
          ->where('jjbz',null)
         ->get()
         ->groupBy('bumen');

       $resv=Salary::where('date','>=',\Carbon\Carbon::parse($year.'-01-01'))   ->where('date','<=',\Carbon\Carbon::parse($year.'-12-31'))
            ->where('jjbz',null)
            ->get();
      }else {
        $res=Salary::where('date','>=',\Carbon\Carbon::parse($year.'-01-01'))->where('date','<=',\Carbon\Carbon::parse($year.'-12-31'))
          ->where('jjbz',2)
         ->get()
         ->groupBy('bumen');

       $resv=Salary::where('date','>=',\Carbon\Carbon::parse($year.'-01-01'))   ->where('date','<=',\Carbon\Carbon::parse($year.'-12-31'))
            ->where('jjbz',2)
            ->get();
      }


       
       $dates=Salary::groupBy('date')
       ->get()
       ->pluck('date')
       ->map(function($v){

        return $v=substr($v,0,4);

       });
       

       return view('salary.byear',compact('res','dates','resv'))->render();
    

  }



   public function myear($year=2017,$jj=null)//1只显示工资，2只显示奖金
    {

     

       $res=Salary::where('date','>=',\Carbon\Carbon::parse($year.'-01-01'))->where('date','<=',\Carbon\Carbon::parse($year.'-12-31'))
         
         ->get()
         ->groupBy('date');

       $resv=Salary::where('date','>=',\Carbon\Carbon::parse($year.'-01-01'))   ->where('date','<=',\Carbon\Carbon::parse($year.'-12-31'))
            ->get();

       
       $dates=Salary::groupBy('date')
       ->get()
       ->pluck('date')
       ->map(function($v){

        return $v=substr($v,0,4);

       });
       

       return view('salary.myear',compact('res','dates','resv'))->render();
    

  }



	




}
