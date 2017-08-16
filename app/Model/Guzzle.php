<?php

namespace App\Model;


use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Client;
use App\Model\Guzzledb;
use App\Acc\Acc;
use App\Model\Payout;
use App\Model\Getsqzb;
use Exception;
use App\Model\Tt\Zhibiao;
use App\Model\Http;
use App\Model\Tt\Data;
use App\Model\Tt\Replace;
use App\Model\Test;

class Guzzle extends Model
{
	use Zhibiao;use Data;use Replace;
	public $insertbody; //发送post的dq部分
	public $payee = []; //需要替换的银行信息
	public $data;  //用来转化utf->GBK
	public $balancebody;//查询余额的dp
	private $amountData;//[金额数据]
	private $rizhiData;//[日志数据]
	private $http;//[日志数据]



	public function __construct(Getsqzb $Getsqzb, Http $http, $payee = [])
	{
		$this->payee = $payee;
		$this->Getsqzb = $Getsqzb;
		$this->http = $http;
        if (!empty($payee)) {
			$zb = Guzzledb::where('ZBID',$payee["zbid"])->firstOrFail();
			$this->insertbody = trim($zb->body);
		}
	}

/**
 
 	TODO:
 	- 设置amountData

  */
  
    private function setAmountData($amount)
	{
		$pattern = '/\d{1,}(.[0-9]{1,})?,\s*\d{1,}(.[0-9]{1,})?,\s*\d{1,}(.[0-9]{1,})?,\s*\d{1,}(.[0-9]{1,})?/';
		preg_match($pattern, $amount,$res);
		if ($res[0] === $amount) {
			$this->amountData = $amount;
		} else {
			throw new Exception("[amount]数据异常".__LINE__, 1);
			
		}
		
	}
	private function getAmountData()
	{
		if (empty($this->amountData)) {
			throw new Exception("[amount]数据异常".__LINE__, 1);
		}else{
			return $this->amountData;
		}
	}

/**
 
 	TODO:
 	- 设置rizhiData
 	 
  */
		private function setRizhiData($rizhi)
	{
		$pattern = "/\[001,.+\]/";
		preg_match($pattern, $rizhi,$res);
		if ($res[0] === $rizhi) {
			$this->rizhiData = $rizhi;
		}else{
			throw new Exception("[rizhi]数据异常".__LINE__, 1);
		}
		
	}
	private function getRizhiData()
	{
		if (empty($this->rizhiData)) {
			throw new Exception("[amount]数据异常".__LINE__, 1);
		}else{
			return $this->rizhiData;
		}
	}




   /**
 
 	TODO:发送制单请求
 	- 传入@
 	- 返回@response
 	 
  */
	public function add_post()
	{	
		Test::log(__METHOD__.'根据一行数据获取对象的指标信息');
		$zb = $this->get_zbdata($this->payee);//获取最新数据
		if ($zb["KYJHJE"]<$this->payee['amount']) {
		Test::log("!!!金额不足");

			echo $zb["KYJHJE"];
			echo "<";
			echo $this->payee['amount'];
			redirect()->action("GuzzleController@dpt");
			die();	
		}
		Test::log(__METHOD__.'验证金额足够');
		$zbamount = $zb["YKJHZB"].",".$zb["YYJHJE"].",".$zb["KYJHJE"].",".$this->payee['amount'];
		Test::log(__METHOD__.'生成金额数据');

		$this->accountreplace($this->payee);
		$this->amountreplace($zbamount);
		$this->insertbody=$this->timereplace($this->insertbody);
		Test::log(__METHOD__.'替换时间金额账户信息');
		$response2 = $this->http->makerequest($this->insertbody);
		Test::log(__METHOD__.'发送POST请求');
		/*=============================================
		=            进行日志增加            =
		=============================================*/
		$response3 = (string)($response2);
		if (stristr($response3, "RES=")) {
			preg_match('/RES="\d+"/', $response3,$pid);
			preg_match('/\d+/', $pid[0],$pid);
			$pid=(string)$pid[0];
			preg_match('/DJBH="\d+"/', $response3,$djbh);
			preg_match('/\d+/', $djbh[0],$djbh);
			$djbh=(string)$djbh[0];
			Test::log(__METHOD__.'获取RESPONSE中的PID和DJBH');
			/*==================================
			=            记录增加的sql日志            =
			==================================*/
			\App\Model\Sql::create(['pid'=>$pid,'type'=>'addshouquan','djbh'=>$djbh,'sql'=>iconv('GB2312','UTF-8',$this->insertbody)]);
			Test::log(__METHOD__.'插入数据库');
			/*=====  End of 进行增加的sql日志  ======*/

			if (!(is_numeric($pid)&&is_numeric($djbh)&&$pid>20000&&$pid<100000&&$djbh>700&&$djbh<1000000)) {
				Test::log(__METHOD__.'!!!取回的编码错误');
				throw new Exception("取回的编码错误".__LINE__, 1);
			}
		Test::log(__METHOD__.'验证PID和DJBH合法性成功');

			$this->add_rizhi($pid,$djbh);

		/*=====  End of  进行日志增加   ======*/		
		$this->deletefj($pid,$djbh);
		} else {
			throw new Exception("取回编码失败,没再进行日志插入和删除FJ".__LINE__, 1);
		}
		Test::log(__METHOD__.'插入日志成功');
		return $response2;
	}

   /**
 
 	TODO:通过一条拨款数据返回指标DATA
 	- 传入@拨款数据
 	- 返回@指标DATA
 	 
  */
	public function get_zbdata($payee)
	{		
		Test::log(__METHOD__.'获取所有的授权指');
		$finddata = $this->Getsqzb->getsqdata();
		$collection = collect($finddata);
		$filtered = $collection->filter(function ($item) use($payee)
			{	
   				return $item['ZBID'] == trim($payee['zbid']);
			});
		Test::log(__METHOD__.'过滤指标');
		$zb = $filtered->pop();
		return $zb;
	}

   /**
 
 	TODO:[amount数据]对$this->insertbody 进行替换
 	- 传入@[amount数据]
 	- 返回@
 	 
  */
		public function amountreplace($zbamount)
	{
		$pattern3='/\d{1,}(.[0-9]{1,})?,\s+\d{1,}(.[0-9]{1,})?,\s+\d{1,}(.[0-9]{1,})?,\s+\d{1,}(.[0-9]{1,})?/';
		 $copydata=$this->insertbody;
		 $this->setAmountData($zbamount);
		 $this->insertbody=preg_replace($pattern3,$this->getAmountData(),$this->insertbody);
		 $this->checkreplace($copydata,$this->insertbody);
	}

   /**
 
 	TODO: 进行账户信息，摘要信息替换
 	- 传入@一条拨款数据
 	- 返回@
 	 
  */
	public function accountreplace($payee)
	{	
		$this->insertbody = $this->jiema($this->insertbody);
		$this->insertbody = iconv('GB2312', 'UTF-8', $this->insertbody);
		
		$this->insertbody = str_replace('遂川县财政局枚江乡财政所','遂川县枚江镇财政所',$this->insertbody);
		$this->insertbody = str_replace('遂川县枚江镇财政所2','遂川县枚江镇财政所',$this->insertbody);
		
		
		$this->insertbody = str_replace('2016年计生事业费',$payee['zhaiyao'],$this->insertbody);
		$this->insertbody = str_replace('zhaiyao',$payee['zhaiyao'],$this->insertbody);
		//---------------------------------------------
		$this->insertbody = str_replace('叶涛',$payee['payee'],$this->insertbody);
		$this->insertbody = str_replace('178190121002547948',$payee["payeeaccount"],$this->insertbody);
		$this->insertbody = str_replace('遂川农商银行',$payee['payeebanker'],$this->insertbody);
		$this->insertbody = str_replace('99991392','',$this->insertbody);
		//名字更改的时候更换这个-------------------------------

		
		

//----------------------------------------------------------
		$this->insertbody = str_replace('吉安遂川县财政局',$payee['payee'],$this->insertbody);
		$this->insertbody = str_replace('190207313396',$payee["payeeaccount"],$this->insertbody);
		$this->insertbody = str_replace('中行遂川支行',$payee['payeebanker'],$this->insertbody);
		
		$this->insertbody = str_replace('99900114','',$this->insertbody);
		
//----------------------------------------------------------
		$this->insertbody = str_replace('\'005\'','\'\'',$this->insertbody);
		$this->insertbody = iconv('UTF-8', 'GB2312', $this->insertbody);

	}

   /**
 
 	TODO: 进行时间信息
 	- 传入@data
 	- 返回@data
 	 
  */
	


	public function setpayee($payee = [])//还没开始使用
	{
		$this->payee = $payee;
	}




	   /**
 
 	TODO: 更新数据库的授权指标
 	- 传入@
 	- 返回@ 
   */
	public function updatedb()
	{
		$finddata = $this->Getsqzb->getsqdata();
		$collection = collect($finddata);
		$collection = $collection->map(function ($item){	
		$info = Guzzledb::updateOrCreate(['ZBID' => $item['ZBID']], $item);
			return $info;
			});
	}





	/**
	 * 插入日志 
	 * @param pid djbh
	 * @return ture
	 * 
	 */
	
	public function add_rizhi($pid, $djbh)
	{
        $data = $this->jiema($this->RZ_data);
		Test::log(__METHOD__.'解码日志sql');

		$timepattern = "/\'\s*20[123]([0-9]{5})\s*\'/"; 
		$copydata = $data;
		$data = preg_replace($timepattern,"to_char(sysdate,'yyyymmdd')",$data);
		$this->checkreplace($copydata,$data);
		Test::log(__METHOD__.'替换日期');
        $pattern = "/\[001,.+\]/";
        $Y = (string)(date('Y'));
        $Ym = (string)(date('Ym'));
        $data2 = "[001,$Y,$Ym,$pid]";
        $copydata = $data;
        $this->setRizhiData($data2);
        $data = preg_replace($pattern,$this->getRizhiData(),$data);
        $this->checkreplace($copydata,$data);
        Test::log(__METHOD__.'替换日志信息[]');
        $ifsuccess=$this->http->makerequest($data);
        if (!stristr($ifsuccess,"NEWNO" )) {
        	//dd($ifsuccess);
        Test::log(__METHOD__.'!!!插入日志失败');
			throw new Exception("插入日志失败，可能是因为pid错误".__LINE__, 1);
        }
        Test::log(__METHOD__.'插入日志成功');
        \App\Model\Sql::create(['pid'=>$pid,'type'=>'addrizhi','djbh'=>$djbh,'sql'=>iconv('GB2312','UTF-8',$data)]);
        Test::log(__METHOD__.'插入日志sql');
        return true; 
	}


	/**
	 * 删除附件
	 *
	 * @param $pid,$djbh
	 * @author 
	 */
	
	public function deletefj($pid, $djbh)
	{
	    $data = $this->jiema($this->FJ_data);
	    $copydata = $data;
	    $data = $this->timereplace($data);
	    $this->checkreplace($copydata,$data);
	    $copydata = $data;
	    $data = str_replace("21886", $pid, $data);
	     $this->checkreplace($copydata,$data);
	     Test::log(__METHOD__.'解码、更换时间和pid');
	    $ifsuccess = $this->http->makerequest($data);
        if (!stristr($ifsuccess,"ZB_ZFPZFJ" )) {
        	//dd("$ifsuccess");
        	Test::log(__METHOD__.'!!!插入日志失败');
			throw new Exception("删除附件失败，可能是因为pid错误".__LINE__, 1);
        }
        \App\Model\Sql::create(['pid'=>$pid,'type'=>'deletefj','djbh'=>$djbh,'sql'=>iconv('GB2312','UTF-8',$data)]);
        return true;
	}

	/**
	 * 进行数据库存档
	 *
	 * @return void
	 * @author 
	 */
	
	public function savesql($data)
	{
		$res=Payout::create($data); 
	}


		/*=============================================
		=            findquery           =
		=============================================*/
		
	
}
