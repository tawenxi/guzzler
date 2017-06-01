<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Lxy;
use App\payout;
use App\Salary;
use App\Member;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $llj=app('llj');
        $llj->show();
        
        Lxy::show('arr1');
        echo "<br>";
        // return Lxy::do();
        echo "<br>";
        Lxy::me()->llj->show();
        echo "<br>";
        echo "===============";
        Lxy::show(['arr1','arr2']);
        echo "===============";
       

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function diff (\App\Play $p)
    {
        // dd(app('lxy'));
        // //dd($a);
        // app()->make('lxy',['llsssj']);
        // dd(app("App\Contracts\Lxy"));

        // dd(app());

        //$p->say();


        echo "<br>";
         app()->make('\App\Play',[app('play2')]);
         // app()->make('\App\Play',new \App\Play2);
      
    }

    public function testioc (\App\Pay $pay)
    {

       // $pay->say();

    }



    public function excel(\App\UserListImport $import)
    {
        // $res= $import->all()->sortByDesc('amount')->all();
        // $a=$res[1]->payee;

        $import->each(function($v){
            dd($v);
        });



       $res= $import->all();

       foreach ($res as $key => $value) {
        $res[$key]['amount']=$res[$key]['payeeaccount']*2;
           # code...
       }






       dd($res);
       // dd($import->toArray());
    }


    public function testdb()
    {
        // $a=Payout::where("amount",'<',400)->get();

        $a=\App\Guzzledb::where('id',12)->get();
       // $b=$a->payouts;
         dd($a);
             //  $b=\App\Payout::find(50)->guzzledb;
              // $b=$payoutdatas=Guzzledb::where('ZBID',$id)->payouts;

        // dd($b);



    }


        public function salary(\App\SalaryListImport $import)//addsalary
    {
        $ziduan=['member_id','name',"account",'bumen','yishu_bz','tuixiu_gz','bufa_gz','nianzhong_jj','gaowen_jiangwen','jiangjin','beuzhu','gjj_dw','sb_dw','gjj_gr','sb_gr','zhiye_nj','daikou_gz','hongfang_zj','yiliao_bx','shiye_bx','shengyu_bx','gongshang_bx','yirijuan','tiaozheng_gjj','tiaozheng_sb','date','jb_gz1','jb_gz2','jinbutie','gongche_bz','xiangzhen_bz','sb_js','gjj_js','other_daikou','daikou_beizhu'];;//34个字段
       $res = $import->skipRows(1)->setDateColumns(array(
    'created_at',
    'updated_at',
    'date'
))->get($ziduan);
     //  dd($res);
      $res->map(function($v){
       
       // dd($v);
        Salary::updateOrCreate(['member_id'=>$v['member_id'],'date'=>$v['date']],$v->toArray());
      });

      
       

 

    }


        public function member(\App\MemberListImport $import)//addmember
    {
        $ziduan=['name','cardid','bankaccount','bumen','class','gangwei','sex','educational','worktime','ruraltime','xiangzhen_bz','gongche_bz','jb_gz1','jb_gz2','jinbutie','status','lizhiriqi','resume','sb_js','gjj_js'];//20个字段
       $res = $import->skipRows(1)->get($ziduan);  
     
      // dd($res);
      $res->map(function($v){
        Member::updateOrCreate(['name'=>$v['name']],$v->toArray());
      });


 

    }

   
}
