<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Psr7\Request;
use App\Model\Guzzle;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use App\Model\Guzzledb;
use App\Model\Payout;
use App\Acc\Acc;
use App\Model\Excel;
use App\Model\Getsqzb;
use App\Model\Http;
use App\Model\Test;

class InsertSq extends Command
{
    private $guzzleexcel;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'insert:sq';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '注入授权指标';

    /**
     * Create a new command instance.
     *
     * @return void
     */


    public function __construct()
    {
        parent::__construct();
        $this->guzzleexcel = \App::make(Excel::class,['excel']);
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $searchobject=\App::make('acc');//初始化
        $arr = $this->guzzleexcel->setSkipNum()->getexcel()->each(function($item) use ($searchobject){
        $item['kemuname'] = stristr($item['kemu'], "@")?$item['kemu']:$searchobject->findac($item['kemu']);
        })->toArray();
        Test::log('获取excel数据并增加科目');
        foreach ($arr as $key => $data) 
        {
            $Validator=\Validator::make($data, [
                "payeeaccount"=>"numeric",
                "amount"=>"numeric|between:0.01,3000000",
                "zbid"=>"size:15"
                ],[
                "numeric"=>":attribute 必须为纯数字",
                "size"=>":attribute 必须为15位",
                ],['zbid'=>"ZBID",
                
                "payeebanker"=>"Banker Number"
            ]);
            Test::log('验证excel数据');
            if ($Validator->fails()) {
                Test::log('!!!检核数据错误，Excel.xls有错误');
                foreach($Validator->errors()->all() as $error){
                    $this->info($error);
                }

                dd('检核数据出错');
            }
        }

        foreach ($arr as $key => $value) 
        {
            if (count($value) != 8) {
                dd('warning', '输入字段数量不为8');
            }
          
            if (count($arr[$key]['kemuname']) == 1&&is_array($arr[$key]['kemuname'])) {
                $arr[$key]['kemuname']=(string)(reset($arr[$key]['kemuname']));             
            }
            //这里使用了reset函数            
            if (is_array($arr[$key]["kemuname"])) {
                dd('info', '请选择确认会计科目并包含@，或者修改关键字');
            }
        }
        Test::log('验证科目数量');
        $successi = 0;
        foreach ($arr as $key => $value) 
        {
            $guzz = \App::make(Guzzle::class,[app()->make(Getsqzb::class),app()->make(Http::class),$value]);//传入一个一位数组（账户信息）
            if (stristr($arr[$key]['kemu'], "#")) {
                $this->info("info:第".(1+$successi).'条数据做账成功但未授权支付'.$value['zhaiyao']);
            } else {
               // dd("拨款成功");//开关             
               $guzz->add_post();
            }
            if (stristr($arr[$key]['kemu'], "***")) {
                $this->info("Info:第".(1+$successi).'条数据完成重录，没做账保存'.$value['zhaiyao']);
            } else {
                $res = $guzz->savesql($value);
            }           
            $successi++;
            $this->info('success--第'.$successi.'条数据拨款成功'.$value['zhaiyao'].'--'.$value['amount']);
        }
        Test::log('注入授权数据');
        $this->info('success--'.$successi.'条数据拨款成功');
       // dump(Test::$info);
    }
}
