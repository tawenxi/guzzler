<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Salary;
use App\User;

class SalaryController extends Controller
{
      public function __construct(){
        $this->middleware('auth');
        $this->middleware('admin', ['except' => ['geren']] );
    }

        public function index($date='201705',$jj=null)
    {
       $dt=$date;
       $res=Salary::hasJJ($jj)
           ->where('date','<=',\Carbon\Carbon::parse($dt.'27'))
           ->where('date','>=',\Carbon\Carbon::parse($dt.'01'))
           ->get()
           ->groupBy('member_id');
       $dates=Salary::groupBy('date')
           ->get()
           ->pluck('date');

            $resv=Salary::hasJJ($jj)
            ->where('date','<=',\Carbon\Carbon::parse($dt.'27'))
            ->where('date','>=',\Carbon\Carbon::parse($dt.'01'))
            ->get();
       return view('salary.index',compact('resv','res','dates'))->render();
	 }


   public function bumen($date='201703',$jj=null)
    {
      $dt=$date;
      $res=Salary::hasJJ($jj)
          ->where('date','<=',\Carbon\Carbon::parse($dt.'27'))
          ->where('date','>=',\Carbon\Carbon::parse($dt.'01'))
          ->get()
          ->groupBy('bumen');


       $resv=Salary::hasJJ($jj)
           ->where('date','<=',\Carbon\Carbon::parse($dt.'27'))
           ->where('date','>=',\Carbon\Carbon::parse($dt.'01'))
           ->get();
  
       $dates=Salary::groupBy('date')->get()->pluck('date');
       return view('salary.bumen',compact('res','dates','resv'))->render();
  }


  public function geren($id=39,$jj=null)
    {
       if (\Auth::check()) {
          $id=\Auth::user()->id;
        } 
       $this->authorize('update', User::find($id));
       $res=Salary::hasJJ($jj)
           ->where('member_id',$id)
           ->Hasjj($jj)
           ->get()
           ->groupBy('date');
       $resv=Salary::hasJJ($jj)
           ->where('member_id',$id)
           ->Hasjj($jj)
           ->get();

       
       $dates=Salary::groupBy('date')
           ->get()
           ->pluck('date');
       return view('salary.geren',compact('res','dates','resv'))->render();
  }



  public function byear($year=2017,$jj=null)//1只显示工资，2只显示奖金
    {
       $res=Salary::where('date','>=',\Carbon\Carbon::parse($year.'-01-01'))
           ->where('date','<=',\Carbon\Carbon::parse($year.'-12-31'))
           ->Hasjj($jj)
           ->get()
           ->groupBy('bumen');

       $resv=Salary::where('date','>=',\Carbon\Carbon::parse($year.'-01-01'))
            ->where('date','<=',\Carbon\Carbon::parse($year.'-12-31'))
            ->Hasjj($jj)
            ->get();
        $dates=Salary::groupBy('date')
            ->get()
            ->pluck('date')
            ->map(function($v){
        return $v=substr($v,0,4);
        })->toarray();
       $dates=collect($dates);
       $dates = $dates->unique();
       $dates->values()->all();
       return view('salary.byear',compact('res','dates','resv'))->render();
 }



   public function myear($year=2017,$jj=null)//1只显示工资，2只显示奖金
    {
       $res=Salary::where('date','>=',\Carbon\Carbon::parse($year.'-01-01'))->where('date','<=',\Carbon\Carbon::parse($year.'-12-31'))
         ->Hasjj($jj)
         ->get()
         ->groupBy('date');

       $resv=Salary::where('date','>=',\Carbon\Carbon::parse($year.'-01-01'))   ->where('date','<=',\Carbon\Carbon::parse($year.'-12-31'))
            ->Hasjj($jj)
            ->get();

       
       $dates=Salary::groupBy('date')
       ->get()
       ->pluck('date')
       ->map(function($v){
              return $v=substr($v,0,4);
           })->toarray();
       $dates=collect($dates);
       $dates = $dates->unique();
       $dates->values()->all();
       return view('salary.myear',compact('res','dates','resv'))->render();
    

  }

     public function phb($year=2017,$jj=null)//1只显示工资，2只显示奖金
    {

       $res=Salary::where('date','>=',\Carbon\Carbon::parse($year.'-01-01'))->where('date','<=',\Carbon\Carbon::parse($year.'-12-31'))
         ->Hasjj($jj)
         ->get()
         ->groupBy('name')->sortByDesc(function ($product, $key) {
             return        
            $product->sum('yishu_bz')+
          $product->sum('tuixiu_gz')+
          $product->sum('jb_gz1')+
          $product->sum('jb_gz2')+
          $product->sum('jinbutie')+
          $product->sum('gongche_bz')+
          $product->sum('xiangzhen_bz')+
          $product->sum('bufa_gz')+
          $product->sum('nianzhong_jj')+
          $product->sum('gaowen_jiangwen')+
          $product->sum('jiangjin')+
          $product->sum('gjj_dw')+
          $product->sum('sb_dw')-
          (
          $product->sum('gjj_gr')+
          $product->sum('gjj_dw')+
          $product->sum('sb_gr')+
          $product->sum('sb_dw')+
          $product->sum('zhiye_nj')+
          $product->sum('daikou_gz')+
          $product->sum('fanghong_zj')+
          $product->sum('yiliao_bx')+
          $product->sum('shiye_bx')+
          $product->sum('shengyu_bx')+
          $product->sum('gongshang_bx')+
          $product->sum('yirijuan')+
          $product->sum('other_daikou')+
          $product->sum('tiaozheng_gjj')+
          $product->sum('tiaozheng_sb')
              );
          });
       $resv=Salary::where('date','>=',\Carbon\Carbon::parse($year.'-01-01'))
            ->where('date','<=',\Carbon\Carbon::parse($year.'-12-31'))
            ->Hasjj($jj)
            ->get();

         return view('salary.phb',compact('res','resv'))->render();
  }
  
}
