<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use GuzzleHttp\Psr7\Request;
use App\Guzzle;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use App\Guzzledb;
use App\Payout;
use App\Acc\Acc;



class GuzzleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function dpt(\App\Guzzle $hello)  //带了更新功能
    {
        //$hello=new Guzzle();
        $info = $hello->updatedb();
        $guzzledbs=Guzzledb::orderBy('ZJXZMC',"Asc")->orderBy("KYJHJE","desc")->get();
        return view('guzzle.index',compact('guzzledbs'));
    }
    public function hyy()
    {
        $guzzledbs=Guzzledb::orderBy('ZJXZMC',"Asc")->orderBy("KYJHJE","desc")->get();
        return view('guzzle.index',compact('guzzledbs'));
    }
    /**
     * 预览
     *
     * @return void
     * @author 
     */
    
    public function preview(\App\UserListImport $import)
    {
        
        header("Content-Type: text/html;charset=utf-8");
         $searchobject=\App::make('acc');//初始化
        $arr=$import->each(function($item) use ($searchobject){

            $item['kemuname']=stristr($item['kemu'], "@")?$item['kemu']:$searchobject->findac($item['kemu']);
        })->toArray();



        // $arr = file(dirname(__FILE__)."//payee.txt");
        // $searchobject=\App::make('acc');//初始化
        // array_walk($arr, function(&$item1, $key) use ($searchobject) {
        // $item1 = preg_split('/[\s,]+/', $item1);
        // $item1['payee']=$item1['0'];
        // $item1['payeeaccount']=$item1['1'];
        // $item1['payeebanker']=$item1['2'];
        // $item1['amount']=$item1['3'];
        // $item1['zhaiyao']=$item1['4'];
        // $item1['zbid']=$item1['5'];
        // $item1['kemu']=$item1['6'];
        // //进行科目判断
        // $item1['kemuname']=stristr($item1['kemu'], "@")?$item1['kemu']:$searchobject->findac($item1['kemu']);
        // array_splice($item1, 0, 6); 
        // unset($item1[0]);
        // //$item1 = array_values($item1);//重建索引
        //     });


     

        //dd($arr);

        //--------传入二维数组进行批输入------------
        foreach ($arr as $key => $data) 
        {
            if (count($arr[$key]['kemuname'])==1&&is_array($arr[$key]['kemuname'])) {
                $arr[$key]['kemuname']=(string)(reset($arr[$key]['kemuname']));
                
            }
            $Validator=\Validator::make($arr[$key], [
                "payeeaccount"=>"numeric",
                "amount"=>"numeric|between:0.01,3000000",
                "shujuyuan"=>"size:15"
                ],[
                "numeric"=>":attribute 必须为纯数字",
                "size"=>":attribute 必须为15位",
                ],['zbid'=>"指标ID",
                "amount"=>"金额",
                "payeebanker"=>"银行账号"
            ]);
            if ($Validator->fails()) {
            return \Redirect::to('/hyy')->withErrors($Validator);
            dd("cuowu");
            }



            
 
           

        }

        

        $collection = collect($arr);
        return view('guzzle.preview', compact('collection'));   
    }
    public function index(\App\UserListImport $import)
    {	
         header("Content-Type: text/html;charset=utf-8");
         $searchobject=\App::make('acc');//初始化
        $arr=$import->each(function($item) use ($searchobject){
        $item['kemuname']=stristr($item['kemu'], "@")?$item['kemu']:$searchobject->findac($item['kemu']);
        })->toArray();

        //--------传入二维数组进行批输入------------
        foreach ($arr as $key => $data) 
        {
            $Validator=\Validator::make($data, [
                "payeeaccount"=>"numeric",
                "amount"=>"numeric|between:0.01,300000",
                "shujuyuan"=>"size:15"
                ],[
                "numeric"=>":attribute 必须为纯数字",
                "size"=>":attribute 必须为15位",
                ],['zbid'=>"指标ID",
                "amount"=>"金额",
                "payeebanker"=>"银行账号"
            ]);
            if ($Validator->fails()) {
            return \Redirect::to('/hyy')->withErrors($Validator);
            dd("cuowu");
            }
            
 
           

        }
            

        foreach ($arr as $key => $value) 
        {
            if (count($value)!=8) {
                dd($value);
                session()->flash('warning', '输入字段数量不为8');
                return redirect()->action('GuzzleController@hyy');
            }
          
            if (count($arr[$key]['kemuname'])==1&&is_array($arr[$key]['kemuname'])) {
                $arr[$key]['kemuname']=(string)(reset($arr[$key]['kemuname']));
                
            }//这里使用了reset函数
            //dd($value["kemuname"]);
            
            if (is_array($arr[$key]["kemuname"])) {
                
                session()->flash('info', '请选择确认会计科目并包含@，或者修改关键字');
                return redirect()->action('GuzzleController@hyy');

            }

        }


        $successi=0;
		foreach ($arr as $key => $value) 
		{
			$guzz=new Guzzle($value);//传入一个一位数组（账户信息）
            if (stristr($arr[$key]['kemu'], "#")) {
                session()->flash('info',  "第".(1+$successi).'条数据做账成功但未授权支付');
            }else{

               // dd("拨款成功");//开关
                
                $guzz->add_post();
            }
			

            if (stristr($arr[$key]['kemu'], "***")) {
                session()->flash('info',  "第".(1+$successi).'条数据完成重录，没做账保存');
            }else{
                $res=$guzz->savesql($value);
            }

            
            $successi++;
		}

        //=======================
        session()->flash('success',  $successi.'条数据拨款成功');
        return redirect()->action('GuzzleController@hyy');		
    }
	

    
    public function find()
    {
                    //-------查询可用指标----------------
        $guzz=new Guzzle();
        $kjhdata=$guzz->find_post();
        $kjhdata=(string)$kjhdata;
        $kjhdata=$guzz->makekjharray($kjhdata);
        dump($kjhdata);            
    }
    public function reflash()
    {
        $hello=new Guzzle();
        $info = $hello->updatedb();
        session()->flash('success', '更新数据库成功');
        return redirect()->action('GuzzleController@dpt');
    }

    
    public function store(\Illuminate\Http\Request $request)
    {
       // dd($request);
        $zbid=$request->zbid;
        $zbidmowei=substr($zbid, -4);
        $this->validate($request, 
            [
                'body' => "required|regex:/<?xml.+to_char%28iPDh%2B1%29%2C%270%27%2C%20%20zfpzdjbh.+190207313396.+zhaiyao.+$zbidmowei.+<\/R9PACKET>/", //必填 必须32位
            ],[

            'body.regex' => '数据源格式不正确,请检查Fillder是否有误或者支付类型有变',]);
        $Guzzledb=Guzzledb::where('ZBID',$zbid)->firstOrfail();
        $a=$Guzzledb->update(['body'=>trim($request->body)]);
        if ($a) {   
                    session()->flash('success', '更新成功');
                    return redirect()->action('GuzzleController@edit',$request->id);
                }
    }

    /**
     * summary
     *
     * @return void
     * @author 
     */
    
    public function benji()
    {
        $hello=new Guzzle();
        $info = $hello->updatedb();
        $guzzledbs=Guzzledb::orderBy("KYJHJE","desc")->get();        
       return view('guzzle.index',compact('guzzledbs'));
    }

    
    public function payoutlist(\Illuminate\Http\Request $request)
    {   //$a='created_at';
        $a=is_null($request->order)?"created_at":$request->order;
        $my=is_null($request->my)?"50":$request->my;
       // dd($a);
       
        $date1 = \Input::has('date1')?\Input::get('date1'):date("Y-m-01",time());
        $date2 = \Input::has('date2')?\Input::get('date2'):date("Y-m-d H:i:s",time()+86400);
        $payoutdatas=Payout::whereBetween('created_at', [$date1, $date2])->orderBy($a,'desc')->paginate($my);
        return view('guzzle.payout',compact('payoutdatas','a','my'));
    }


    public function show($id)
    {
       $payoutdatas=Payout::where('zbid',$id)->orderBy("created_at",'desc')->paginate(10);
        return view('guzzle.show',compact('payoutdatas'));
    }

    public function editkemu($id)
    {
        $detail=Payout::find($id);
        
        return view('guzzle.editkemu',compact('detail'));
        
    }
        public function savekemu(\Illuminate\Http\Request $request)
    {

        $this->validate($request, 
            [
                'kemuname' => "required|regex:/.+@.+/", //必填 必须32位
                'amount' => "required|numeric", //必填 必须32位
                'payeeaccount' => "required|alpha_num",
                
            ]);
        $Guzzledb=Guzzledb::where('ZBID',$zbid)->firstOrfail();
        $a=$Guzzledb->update(['body'=>trim($request->body)]);
        if ($a) {   
                    session()->flash('success', '更新成功');
                    return redirect()->action('GuzzleController@edit',$request->id);
                }
    }
    
    public function edit($id)
    {
        $guzzledb=Guzzledb::findOrfail($id);
        return view('guzzle.edit',compact('guzzledb'));
    }

    


   
    public function destroy($id)
    {
        $payout=Payout::findOrFail($id);
                $payout->delete();
        session()->flash('success', '成功删除拨款记录！');
        return back();
        
    }

    public function postsql(\Illuminate\Http\Request $request)
    {


          $this->validate($request, 
            [
                'body' => "required|regex:/^((?!000931).)*$/is|regex:/^((?!22708).)*$/is", //必填 必须32位
            ],[

            'body.regex' => '数据源格式不正确,请检查Fillder是否有误或者支付类型有变',]);
        



        $sql=$request->body;
        $sql= iconv('UTF-8','GB2312',$sql);
        $post=new Guzzle();
        $info = $post->makerequest($sql);
        dd($info);
    }

    public function getsql()
    {
        return view('guzzle.getsql');
    }
}
