<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Client;
use App\Guzzledb;
use App\Acc\Acc;
use App\Payout;
class Guzzle extends Model
{
	public $insertbody; //发送post的dq部分
	public $payee = []; //需要替换的银行信息
	public $data;  //用来转化utf->GBK
	public $balancebody;//查询余额的dp
	private $amountData;//[金额数据]
	private $rizhiData;//[日志数据]

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
		}else{
			dd("[amount]数据异常");
		}
		
	}
	private function getAmountData()
	{
		if (empty($this->amountData)) {
			dd("[amount]数据异常");
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
			dd("[rizhi]数据异常");
		}
		
	}
	private function getRizhiData()
	{
		if (empty($this->rizhiData)) {
			dd("[rizhi]数据异常");
		}else{
			return $this->rizhiData;
		}
	}

	public function checkreplace($data1,$data2)
	{
	    if ($data1==$data2) {
	    	dd("替换失败");
	    }
	}

/**
 
 	TODO:
 	- 发送sql语句
    @接收sql语句
    @返回sql response
 	 
  */
	public function makerequest($dq)//根据body属性发送请求
	{
		$client = new Client();
		$response = $client->request('POST', 'http://10.108.8.1:7007/Proxy', 
		[
			'form_params' => 
				[
					'cVer' => '9.8.0',
					'dp'=>$dq,
				],		
		]);
		$code = $response->getStatusCode(); // 200
		$responsebody = $response->getBody();
		$responsebody = iconv('GB2312','UTF-8', $responsebody);
		/*=============================================
		=            判断Response中是否包含错误信息          =
		=============================================*/
		if(strlen($responsebody)<520){
			//echo "success<br/>";			
		};
		if (stristr($responsebody, "ERROR")) {
			echo iconv('GB2312','UTF-8',$dq);
			dd("sql语句错误----$responsebody");
		}
		/*=====  End of  判断Response中是否包含错误信息 ======*/
		return $responsebody;
	}

   /**
 
 	TODO:发送制单请求
 	- 传入@
 	- 返回@response
 	 
  */
	public function add_post()
	{	
		$zb = $this->get_zbdata($this->payee);//获取最新数据
		if ($zb["KYJHJE"]<$this->payee['amount']) {
			echo $zb["KYJHJE"];
			echo "<";
			echo $this->payee['amount'];
			redirect()->action("GuzzleController@dpt");
			die();	
		}
		$zbamount = $zb["YKJHZB"].",".$zb["YYJHJE"].",".$zb["KYJHJE"].",".$this->payee['amount'];
		$this->accountreplace($this->payee);
		$this->amountreplace($zbamount);
		$this->insertbody=$this->timereplace($this->insertbody);
		$response2 = $this->makerequest($this->insertbody);
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
			/*==================================
			=            记录增加的sql日志            =
			==================================*/
			\App\Sql::create(['pid'=>$pid,'type'=>'addshouquan','djbh'=>$djbh,'sql'=>iconv('GB2312','UTF-8',$this->insertbody)]);
			/*=====  End of 进行增加的sql日志  ======*/
			if (!(is_numeric($pid)&&is_numeric($djbh)&&$pid>20000&&$pid<100000&&$djbh>700&&$djbh<1000000)) {
				dd("取回的编码错误");
			}
			$this->add_rizhi($pid,$djbh);
		/*=====  End of  进行日志增加   ======*/		
		$this->deletefj($pid,$djbh);
		} else {
			dd("取回编码失败,没再进行日志插入和删除FJ");
		}
		return $response2;
	}

   /**
 
 	TODO:通过一条拨款数据返回指标DATA
 	- 传入@拨款数据
 	- 返回@指标DATA
 	 
  */
	public function get_zbdata($payee)
	{		
		$finddata = $this->getfinddata();           
		$collection = collect($finddata);
		$filtered = $collection->filter(function ($item) use($payee)
			{	
   				return $item['ZBID'] == trim($payee['zbid']);
			});
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
		$this->insertbody = str_replace('吉安遂川县财政局',$payee['payee'],$this->insertbody);
		$this->insertbody = str_replace('遂川县财政局枚江乡财政所','遂川县枚江镇财政所',$this->insertbody);
		$this->insertbody = str_replace('遂川县枚江镇财政所2','遂川县枚江镇财政所',$this->insertbody);
		$this->insertbody = str_replace('190207313396',$payee["payeeaccount"],$this->insertbody);
		$this->insertbody = str_replace('中行遂川支行',$payee['payeebanker'],$this->insertbody);
		$this->insertbody = str_replace('2016年计生事业费',$payee['zhaiyao'],$this->insertbody);
		$this->insertbody = str_replace('zhaiyao',$payee['zhaiyao'],$this->insertbody);
		$this->insertbody = str_replace('99900114','',$this->insertbody);
		$this->insertbody = str_replace('\'005\'','\'\'',$this->insertbody);
		$this->insertbody = iconv('UTF-8', 'GB2312', $this->insertbody);
	}

   /**
 
 	TODO: 进行时间信息
 	- 传入@data
 	- 返回@data
 	 
  */
	public function timereplace($data)
	{
		$pattern ="/\'\s*20[123]([0-9]{5})\s*\'/";
		$pattern1 ="/\'\s*20[123]([0-9]{3})\s*\'/"; 
		$pattern2 ="/\'\s*20[123]([0-9]{1})\s*\'/"; 
		$data = preg_replace($pattern,"to_char(sysdate,'yyyymmdd')",$data);
		$data = preg_replace($pattern1,"to_char(sysdate,'yyyymm')",$data);
		$data = preg_replace($pattern2,"to_char(sysdate,'yyyy')",$data);
		return $data;
	}



	
	public function __construct($payee = [])
	{
		$this->payee = $payee;
        if (!empty($payee)) {
			$zb = Guzzledb::where('ZBID',$payee["zbid"])->firstOrFail();
			$this->insertbody = trim($zb->body);
		}
	}



	public function setpayee($payee = [])//还没开始使用
	{
		$this->payee = $payee;
	}

	public function jiema($data)//传入加密内容 解码
	{
		$data = urldecode($data);
		return $data;
	}


	   /**
 
 	TODO: 更新数据库的授权指标
 	- 传入@
 	- 返回@ 
   */
	public function updatedb()
	{
		$finddata = $this->getfinddata();
		$collection = collect($finddata);
		$collection = $collection->map(function ($item){	
		$info = Guzzledb::updateOrCreate(['ZBID' => $item['ZBID']], $item);
			return $info;
			});
	}

	   /**
 
 	TODO: 返回@可用授权指标数组
 	- 传入@
 	- 返回@可用授权指标数组
 	 
  */
	public function getfinddata()
	{
		$zbobject = new self();
        $kjhdata_xingzheng = $zbobject->find_post('xingzheng');
        $kjhdata_xingzheng = (string)$kjhdata_xingzheng;
        $kjhdata_benji = $zbobject->find_post("benji");
        $kjhdata_benji = (string)$kjhdata_benji;
        $kjhdata_xingzheng = $zbobject->makekjharray($kjhdata_xingzheng);
        $kjhdata_benji = $zbobject->makekjharray($kjhdata_benji);
        $kjhdata_all = array_merge($kjhdata_xingzheng,$kjhdata_benji);
        return $kjhdata_all;
	}

		public function find_post($xingzheng_benji)
	{	
		/*=============================================
		=            Section comment block            =
		=============================================*/
		
		$findquery_xingzheng = '<?xml version="1.0" encoding="GB2312"?><R9PACKET version="1"><SESSIONID></SESSIONID><R9FUNCTION><NAME>AS_DataRequest</NAME><PARAMS><PARAM><NAME>ProviderName</NAME><DATA format="text">DataSetProviderData</DATA></PARAM><PARAM><NAME>Data</NAME><DATA format="text">begin%20%20zbsp_ZFPZJYJH%28%20%20%20szkjnd=%26gt;%272017%27%2C%20%20%20szGsdm=%26gt;%27001%27%2C%20%20%20szdzkdm=%26gt;%27%C8%AB%B2%BF%27%2C%20%20%20szzffsdm=%26gt;%2702%27%2C%20%20%20szdwdm=%26gt;%27901006001%27%2C%20%20%20szYWLX=%26gt;%27%C8%AB%B2%BF%27%2C%20%20%20szZJXZDM=%26gt;%27%C8%AB%B2%BF%27%2C%20%20%20szZBLYDM=%26gt;%27%C8%AB%B2%BF%27%2C%20%20%20SJQXFX=%26gt;%270100000000%27%2C%20%20%20QYQX=%26gt;0%2C%20%20%20CZYID=%26gt;899%20%2C%20%20JHDBGZKZ=%26gt;%270%27%2C%20%20ZBDBGZKZ=%26gt;%271%27%2C%20%20szTJ=%26gt;%27_%27%2C%20%20szKJRQ=%26gt;%2720170425%27%2C%20%20%20szRQKZ=%26gt;%270%27%2C%20%20%20szYF=%26gt;%274%27%2C%20%20%20szXJBZ=%26gt;%270%27%2C%20%20%20szXJKZ=%26gt;%270%27%2C%20%20%20szYKJHZT=%26gt;%270%27%2C%20%20%20szFXJKZ=%26gt;%270%27%2C%20%20%20szDJKZYS=%26gt;%270001111111011100%27%2C%20%20%20szSelect=%26gt;%27ZJXZDM%2CZBLYDM%2CYSKMDM%2CJFLXDM%2CZCLXDM%2CYSGLLXDM%2CDZKDM%2CXMDM%2CZFFSDM%2CYSDWDM%27%2C%20%20%20szGrp=%26gt;%27B%2EZJXZDM%2CB%2EZBLYDM%2CB%2EYSKMDM%2CB%2EJFLXDM%2CB%2EZCLXDM%2CB%2EYSGLLXDM%2CB%2EDZKDM%2CB%2EXMDM%2CB%2EZFFSDM%2CB%2EYSDWDM%27%2C%20%20%20CXJEKZ=%26gt;%270%27%2C%20%20%20pRecCur=%26gt;:pRecCur%20%29;end%20;%20</DATA></PARAM></PARAMS></R9FUNCTION></R9PACKET>';
		//*********************************************************************
		$findquery_benji = '<?xml version="1.0" encoding="GB2312"?><R9PACKET version="1"><SESSIONID></SESSIONID><R9FUNCTION><NAME>AS_DataRequest</NAME><PARAMS><PARAM><NAME>ProviderName</NAME><DATA format="text">DataSetProviderData</DATA></PARAM><PARAM><NAME>Data</NAME><DATA format="text">begin%20%20zbsp_ZFPZJYJH%28%20%20%20szkjnd=%26gt;%272017%27%2C%20%20%20szGsdm=%26gt;%27001%27%2C%20%20%20szdzkdm=%26gt;%27%C8%AB%B2%BF%27%2C%20%20%20szzffsdm=%26gt;%2702%27%2C%20%20%20szdwdm=%26gt;%27901006000%27%2C%20%20%20szYWLX=%26gt;%27%C8%AB%B2%BF%27%2C%20%20%20szZJXZDM=%26gt;%27%C8%AB%B2%BF%27%2C%20%20%20szZBLYDM=%26gt;%27%C8%AB%B2%BF%27%2C%20%20%20SJQXFX=%26gt;%270100000000%27%2C%20%20%20QYQX=%26gt;0%2C%20%20%20CZYID=%26gt;899%20%2C%20%20JHDBGZKZ=%26gt;%270%27%2C%20%20ZBDBGZKZ=%26gt;%271%27%2C%20%20szTJ=%26gt;%27_%27%2C%20%20szKJRQ=%26gt;%2720170511%27%2C%20%20%20szRQKZ=%26gt;%270%27%2C%20%20%20szYF=%26gt;%275%27%2C%20%20%20szXJBZ=%26gt;%270%27%2C%20%20%20szXJKZ=%26gt;%270%27%2C%20%20%20szYKJHZT=%26gt;%270%27%2C%20%20%20szFXJKZ=%26gt;%270%27%2C%20%20%20szDJKZYS=%26gt;%270001111111011100%27%2C%20%20%20szSelect=%26gt;%27ZJXZDM%2CZBLYDM%2CYSKMDM%2CJFLXDM%2CZCLXDM%2CYSGLLXDM%2CDZKDM%2CXMDM%2CZFFSDM%2CYSDWDM%27%2C%20%20%20szGrp=%26gt;%27B%2EZJXZDM%2CB%2EZBLYDM%2CB%2EYSKMDM%2CB%2EJFLXDM%2CB%2EZCLXDM%2CB%2EYSGLLXDM%2CB%2EDZKDM%2CB%2EXMDM%2CB%2EZFFSDM%2CB%2EYSDWDM%27%2C%20%20%20CXJEKZ=%26gt;%270%27%2C%20%20%20pRecCur=%26gt;:pRecCur%20%29;end%20;%20</DATA></PARAM></PARAMS></R9FUNCTION></R9PACKET>';
		/*=====  End of Section comment block  ======*/
		if ($xingzheng_benji == "benji") {
			$findquery=$findquery_benji;	
		}elseif ($xingzheng_benji == "xingzheng") {
			$findquery=$findquery_xingzheng;
		}
		 $this->balancebody = $this->jiema($findquery);
		 $this->balancebody = $this->timereplace($this->balancebody);
		return $this->makerequest($this->balancebody);
	}

	public function makekjharray($kjhdata) //将<ROWDATA></ROWDATA>之间的数据转化为数组
	{
		$kjhdata = (string)$kjhdata;
        $kjhdata = substr($kjhdata,strpos($kjhdata, "<ROWDATA>"),(strpos($kjhdata, "</ROWDATA>")-strpos($kjhdata, "<ROWDATA>")));
        $kjhdata = substr($kjhdata,14,-3);
        $kjhdata = str_replace(" DZKDM",'DZKDM',$kjhdata);
        $kjhdata = explode(" /><ROW" , $kjhdata);
        foreach ($kjhdata as $key => $value) 
        {
            $value = '{"'.str_replace("=",'":', $value).'}';
            $kjhdata[$key] = str_replace("\" ",'","', $value);
            $kjhdata[$key] = json_decode($kjhdata[$key],true);  
        }
        return $kjhdata;
	}

	/**
	 * 插入日志 
	 * @param pid djbh
	 * @return ture
	 * 
	 */
	
	public function add_rizhi($pid, $djbh)
	{
	           
         $data = '<?xml version="1.0" encoding="GB2312"?><R9PACKET version="1"><SESSIONID></SESSIONID><R9FUNCTION><NAME>AS_DataRequest</NAME><PARAMS><PARAM><NAME>ProviderName</NAME><DATA format="text">DataSetProviderData</DATA></PARAM><PARAM><NAME>Data</NAME><DATA format="text">%20begin%20%20%20declare%20maxNo%20int;%20%20%20begin%20%20%20%20%20%20Select%20nvl%28Max%28no%29%2C0%29%2B1%20into%20maxNo%20from%20ZB_czrz%20%20%20where%20station%20like%20%27PC%2D20161129CAOZ%25%27%20;%20%20%20%20insert%20into%20ZB_czrz%28station%2C%20no%2C%20name%2C%20%26quot;DATE%26quot;%2C%20zwrq%2C%20qssj%2C%20zzsj%2C%20cznr%2Ccznrkz%29%20%20%20%20values%20%28%27PC%2D20161129CAOZ_10%2E111%2E102%2E41%27%2CmaxNo%2C%27%B8%B5%B0%AE%C7%ED%27%2C%20TO_CHAR%28SYSDATE%2C%27YYYYMMDD%27%29%2C%2720170516%27%20%20%20%20%2CTO_CHAR%28SYSDATE%2C%27HH24:MI:SS%27%29%2CTO_CHAR%28SYSDATE%2C%27HH24:MI:SS%27%29%2C%27[%CA%DA%C8%A8%D6%A7%B8%B6%C6%BE%D6%A4][%D0%C2%D4%F6][001%2C2017%2C201705%2C21886]%27%2C%27%27%29%20;%20%20%20%20%20commit;%20%20%20%20%20%20open%20:pRecCur%20for%20select%20maxNo%20NewNo%20from%20dual;%20%20%20%20end;%20end;</DATA></PARAM></PARAMS></R9FUNCTION></R9PACKET>';
        $data = $this->jiema($data);
		$timepattern = "/\'\s*20[123]([0-9]{5})\s*\'/"; 
		$copydata = $data;
		$data = preg_replace($timepattern,"to_char(sysdate,'yyyymmdd')",$data);
		$this->checkreplace($copydata,$data);
        $pattern = "/\[001,.+\]/";
        $Y = (string)(date('Y'));
        $Ym = (string)(date('Ym'));
        $data2 = "[001,$Y,$Ym,$pid]";
        $copydata = $data;
        $this->setRizhiData($data2);
        $data = preg_replace($pattern,$this->getRizhiData(),$data);
        $this->checkreplace($copydata,$data);
        $ifsuccess=$this->makerequest($data);
        if (!stristr($ifsuccess,"NEWNO" )) {
        	dd("$ifsuccess");
        }
        \App\Sql::create(['pid'=>$pid,'type'=>'addrizhi','djbh'=>$djbh,'sql'=>iconv('GB2312','UTF-8',$data)]);
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
	    $data = '<?xml version="1.0" encoding="GB2312"?><R9PACKET version="1"><SESSIONID></SESSIONID><R9FUNCTION><NAME>AS_DataRequest</NAME><PARAMS><PARAM><NAME>ProviderName</NAME><DATA format="text">DataSetProviderData</DATA></PARAM><PARAM><NAME>Data</NAME><DATA format="text">Begin%20%20%20delete%20from%20ZB_ZFPZFJ%20where%20%20%20%20%20%20GSDM=%27001%27%20%20and%20KJND=%272017%27%20%20and%20PDQJ=%27201704%27%20%20and%20ZFLB=%270%27%20%20and%20PDH=21886%20;%20%20commit%20;%20%20%20open%20:pRecCur%20for%20select%200%20ierrCount%20from%20dual;%20Exception%20when%20others%20then%20RollBack%20;%20end;%20</DATA></PARAM></PARAMS></R9FUNCTION></R9PACKET>';
	    $data = $this->jiema($data);
	    $copydata = $data;
	    $data = $this->timereplace($data);
	    $this->checkreplace($copydata,$data);
	    $copydata = $data;
	    $data = str_replace("21886", $pid, $data);
	     $this->checkreplace($copydata,$data);
	    $ifsuccess = $this->makerequest($data);
        if (!stristr($ifsuccess,"ZB_ZFPZFJ" )) {
        	dd("$ifsuccess");
        }
        \App\Sql::create(['pid'=>$pid,'type'=>'deletefj','djbh'=>$djbh,'sql'=>iconv('GB2312','UTF-8',$data)]);
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
}
