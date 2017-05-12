<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use GuzzleHttp\Psr7\Request;
use App\Guzzle;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use App\Guzzledb;



class GuzzleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function dpt()
    {
        $hello=new Guzzle();
        $info = $hello->updatedb();
        $guzzledbs=Guzzledb::orderBy('ZJXZMC',"Asc")->orderBy("KYJHJE","desc")->get();
        
        
       return view('guzzle.index',compact('guzzledbs'));

           


    }
    public function index()
    {	
			header("Content-Type: text/html;charset=utf-8");
			$arr = file(dirname(__FILE__)."//payee.txt");
			array_walk($arr, function(&$item1, $key) {
				$item1 = preg_split('/[\s,]+/', $item1);
			});
			//var_dump($arr);
			//--------传入二维数组进行批输入------------
          

            foreach ($arr as $key => $value) 
            {
                if (count($value)<6) {

                    session()->flash('danger', '请输入指标编号');
                    return redirect()->action('GuzzleController@dpt');
                }
            }

            $successi=0;
			foreach ($arr as $key => $value) 
			{
				$guzz=new Guzzle($value);//传入一个一位数组（账户信息）
				$guzz->add_post();

                $successi++;
			}

            //=======================
            session()->flash('success',  $successi.'条数据拨款成功');
            return redirect()->action('GuzzleController@dpt');



			
			
			
		
    }
	

    
    public function find()
    {
        //
                    //-------查询可用指标----------------
            $guzz=new Guzzle();
           


          
           $kjhdata=$guzz->find_post();
           $kjhdata=(string)$kjhdata;

           $kjhdata=$guzz->makekjharray($kjhdata);

            dump($kjhdata);
            



            //===============================
            
    }
    public function reflash()
    {
        //
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
                'body' => "required|regex:/<?xml.+$zbidmowei.+<\/R9PACKET>/", //必填 必须32位
         
            ],[

            'body.regex' => '数据源格式不正确,请检查Fillder是否有误',

        ]
            );

        
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

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        $guzzledb=Guzzledb::findOrfail($id);
        
        
       return view('guzzle.edit',compact('guzzledb'));

    }

    
    public function update(Request $request, $id)
    {
        //
    }

   
    public function destroy($id)
    {
        //
    }
}
