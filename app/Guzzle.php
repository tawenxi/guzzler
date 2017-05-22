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
    //

	public $insertbody; //发送post的dq部分
	public $payee=[]; //需要替换的银行信息
	public $data;  //用来转化utf->GBK
	public $balancebody;//查询余额的dp

	
	/**
	 * summary
	 *
	 * @return void
	 * @author 
	 */
	
	public function checkreplace($data1,$data2)
	{
	    if ($data1==$data2) {
	    	dd("替换失败");
	    }
	}
	
	public function makerequest($dq)//根据body属性发送请求
	{	//$dq= iconv('UTF-8','GB2312',$dq);//发送请求之前进行转码GB2312->utf8
		//echo "=============!request=================<br/>";//调试
		// echo iconv('GB2312','UTF-8',$dq);

		//echo "<br/>=============request=================<br/>";//调试
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
			echo "success<br/>";			
			//echo "$responsebody--";
			};
		    if (stristr($responsebody, "ERROR")) {
			echo iconv('GB2312','UTF-8',$dq);
				dd("sql语句错误----$responsebody");

			}
			
			/*=====  End of  判断Response中是否包含错误信息 ======*/
				



			return $responsebody;
	}
	public function add_post()
	{	
		$zb=$this->get_zbdata($this->payee);//获取最新数据
		//dd($zb);
		if ($zb["KYJHJE"]<$this->payee['amount']) {
			echo $zb["KYJHJE"];
			echo "<";
			echo $this->payee['amount'];
			redirect()->action("GuzzleController@dpt");
			die();
			
		}
		$zbamount=$zb["YKJHZB"].",".$zb["YYJHJE"].",".$zb["KYJHJE"].",".$this->payee['amount'];

		$this->accountreplace($this->payee);
		$this->amountreplace($zbamount);

		$this->insertbody=$this->timereplace($this->insertbody);
		// $this->insertbody=iconv('GB2312','UTF-8',$this->insertbody);//拿到请求数据
		// dd($this->insertbody);//拿到请求数据

		$response2 = $this->makerequest($this->insertbody);
		
		/*=============================================
		=            进行日志增加            =
		=============================================*/
		
		$response3=(string)($response2);
		if (stristr($response3, "RES=")) {
			//echo $pid=substr($response3, 5+strpos($response3, 'RES="'),5);
			preg_match('/RES="\d+"/', $response3,$pid);
			preg_match('/\d+/', $pid[0],$pid);
			$pid=(string)$pid[0];
			echo "<br>";

			//echo $djbh=substr($response3, 6+strpos($response3, 'DJBH="'),6);

			preg_match('/DJBH="\d+"/', $response3,$djbh);
			preg_match('/\d+/', $djbh[0],$djbh);
			$djbh=(string)$djbh[0];
			echo "<br>";

			/*==================================
			=            记录增加的sql日志            =
			==================================*/
			
			\App\Sql::create(['pid'=>$pid,'type'=>'addshouquan','djbh'=>$djbh,'sql'=>iconv('GB2312','UTF-8',$this->insertbody)]);
			
			/*=====  End of 进行增加的sql日志  ======*/
			


			echo "<br>";
			if (!(is_numeric($pid)&&is_numeric($djbh)&&$pid>20000&&$pid<100000&&$djbh>700&&$djbh<1000000)) {
				dd("取回的编码错误");
			}
			$this->add_rizhi($pid,$djbh);


		
		/*=====  End of  进行日志增加   ======*/

		/*==========================
		=            删除 DJBHFJ           =
		==========================*/
		
		$this->deletefj($pid,$djbh);

		
		/*=====  End of 删除 DJBHFJ  ======*/
		

			
			
			

		}else{
			dd("取回编码失败,没再进行日志插入和删除FJ");
		}

		return $response2;
	}

	public function get_zbdata($payee)
	{		




			$finddata=$this->getfinddata();

			//dump($finddata);
           
			$collection = collect($finddata);

			$filtered = $collection->filter(function ($item) use($payee)
				{	
					
   					 return $item['ZBID']==$payee['zbid'];
					
				});

			//dump($filtered->pop());
			 $zb=$filtered->pop();


			 // $amountstring=$zb["YKJHZB"].",".$zb["YYJHJE"].",".$zb["KYJHJE"].",".$payee['3'];
			 return $zb;
			 



	}
	//-----------------------
		public function amountreplace($zbamount)
	{
		 //$this->insertbody=$this->jiema($this->insertbody);//替换之前进行解码

		$pattern3='/\d{1,}(.[0-9]{1,})?,\s+\d{1,}(.[0-9]{1,})?,\s+\d{1,}(.[0-9]{1,})?,\s+\d{1,}(.[0-9]{1,})?/';
		 $copydata=$this->insertbody;
		 $this->insertbody=preg_replace($pattern3,$zbamount,$this->insertbody);

		 $this->checkreplace($copydata,$this->insertbody);
		
		//$this->insertbody = iconv('UTF-8', 'GB2312', $this->insertbody);
	}
	public function accountreplace($payee)
	{	
		$this->insertbody=$this->jiema($this->insertbody);//替换之前进行解码
		$this->insertbody = iconv('GB2312', 'UTF-8', $this->insertbody);
		$this->insertbody=str_replace('吉安遂川县财政局',$payee['payee'],$this->insertbody);
		$this->insertbody=str_replace('遂川县财政局枚江乡财政所','遂川县枚江镇财政所',$this->insertbody);
		$this->insertbody=str_replace('190207313396',$payee["payeeaccount"],$this->insertbody);
		$this->insertbody=str_replace('中行遂川支行',$payee['payeebanker'],$this->insertbody);
		//$this->insertbody=str_replace('1.61',$payee[3],$this->insertbody);
		$this->insertbody=str_replace('2016年计生事业费',$payee['zhaiyao'],$this->insertbody);
		$this->insertbody=str_replace('zhaiyao',$payee['zhaiyao'],$this->insertbody);
		$this->insertbody=str_replace('99900114','',$this->insertbody);//替换助记码
		$this->insertbody=str_replace('\'005\'','\'\'',$this->insertbody);//删除银行行号
		//dd($this->insertbody);
		$this->insertbody = iconv('UTF-8', 'GB2312', $this->insertbody);

		//echo $this->insertbody;	
	}
	public function timereplace($data)
	{
		$pattern="/\'201([0-9]{5})\'/";
		$pattern1="/\'201([0-9]{3})\'/"; 
		$pattern2="/\'201([0-9]{1})\'/"; 

		$data=preg_replace($pattern,"to_char(sysdate,'yyyymmdd')",$data);
		$data=preg_replace($pattern1,"to_char(sysdate,'yyyymm')",$data);
		$data=preg_replace($pattern2,"to_char(sysdate,'yyyy')",$data);
		return $data;
	}
		//-----------------------950,0 950, 

	public function getfinddata()//返回一个数组
	{
			$zbobject=new self();
           $kjhdata=$zbobject->find_post();
           $kjhdata=(string)$kjhdata;

           $kjhdata_benji=$zbobject->find_post("benji");
           $kjhdata_benji=(string)$kjhdata_benji;
           

           $kjhdata=$zbobject->makekjharray($kjhdata);
           $kjhdata_benji=$zbobject->makekjharray($kjhdata_benji);
           $kjhdata_all=array_merge($kjhdata,$kjhdata_benji);

           //dd($kjhdata_all);//调试
           return $kjhdata_all;

	}

	
	public function __construct($payee=[])//默认发送guzzledata.txt的数据 后需要如果需要发送别的数据需要对$this->insertbody进行修改
			{
				$this->payee=$payee;//一条数据：一位数组

				if (!empty($payee)) 
					{
					# code...
				
				
				$zb=Guzzledb::where('ZBID',$payee["zbid"])->firstOrFail();
				// dump($zb[0]->body);
				 //dd($zb);
				$this->insertbody = trim($zb->body);

					}
				//$this->insertbody=file_get_contents(dirname(__FILE__)."//Http//Controllers//guzzledata.txt");//这个body需要修改成data
				//$this->balancebody=file_get_contents(dirname(__FILE__)."//Http//Controllers//balancebody.txt");
				

			}


	public function updatedb()
	{


			$finddata=$this->getfinddata();
			$collection = collect($finddata);
			$collection = $collection->map(function ($item)
				{	
					//dump($item);  //调试数据

			$info = Guzzledb::updateOrCreate(['ZBID' => $item['ZBID']],
                        $item);

   					// return $item['ZBID']==$payee['5'];
			return $info;
					
				});


			
           
			// $collection = collect($finddata);

			// $filtered = $collection->filter(function ($item) use($payee)
			// 	{	
					
   // 					 return $item['ZBID']==$payee['5'];
					
			// 	});

			// //dump($filtered->pop());
			//  $zb=$filtered->pop();


			//   $amountstring=$zb["YKJHZB"].",".$zb["YYJHJE"].",".$zb["KYJHJE"].",".$payee['3'];
			//  return $amountstring;
			 
		
	}
		
	
	
	//public function getbody()
	//{
	//	$body1=str_replace('中文','我的中文',urldecode($this->data);
	//	$body1=str_replace('中文','我的中文',urldecode($this->data);
	//	$body1=str_replace('中文','我的中文',urldecode($this->data);
	//	$this->insertbody=$body1;
		
	//}
	public function setpayee($payee=[])//还没开始使用
	{
		$this->payee=$payee;
	}

	public function jiema($data)//传入加密内容 解码
	{
		 $data=urldecode($data);

		return $data;
	}

	public function getbalance($ykjjid)
	{

	}


		public function find_post($xingzheng_benji="xingzheng")
	{	
		/*=============================================
		=            Section comment block            =
		=============================================*/
		
		$findquery='<?xml version="1.0" encoding="GB2312"?><R9PACKET version="1"><SESSIONID></SESSIONID><R9FUNCTION><NAME>AS_DataRequest</NAME><PARAMS><PARAM><NAME>ProviderName</NAME><DATA format="text">DataSetProviderData</DATA></PARAM><PARAM><NAME>Data</NAME><DATA format="text">begin%20%20zbsp_ZFPZJYJH%28%20%20%20szkjnd=%26gt;%272017%27%2C%20%20%20szGsdm=%26gt;%27001%27%2C%20%20%20szdzkdm=%26gt;%27%C8%AB%B2%BF%27%2C%20%20%20szzffsdm=%26gt;%2702%27%2C%20%20%20szdwdm=%26gt;%27901006001%27%2C%20%20%20szYWLX=%26gt;%27%C8%AB%B2%BF%27%2C%20%20%20szZJXZDM=%26gt;%27%C8%AB%B2%BF%27%2C%20%20%20szZBLYDM=%26gt;%27%C8%AB%B2%BF%27%2C%20%20%20SJQXFX=%26gt;%270100000000%27%2C%20%20%20QYQX=%26gt;0%2C%20%20%20CZYID=%26gt;899%20%2C%20%20JHDBGZKZ=%26gt;%270%27%2C%20%20ZBDBGZKZ=%26gt;%271%27%2C%20%20szTJ=%26gt;%27_%27%2C%20%20szKJRQ=%26gt;%2720170425%27%2C%20%20%20szRQKZ=%26gt;%270%27%2C%20%20%20szYF=%26gt;%274%27%2C%20%20%20szXJBZ=%26gt;%270%27%2C%20%20%20szXJKZ=%26gt;%270%27%2C%20%20%20szYKJHZT=%26gt;%270%27%2C%20%20%20szFXJKZ=%26gt;%270%27%2C%20%20%20szDJKZYS=%26gt;%270001111111011100%27%2C%20%20%20szSelect=%26gt;%27ZJXZDM%2CZBLYDM%2CYSKMDM%2CJFLXDM%2CZCLXDM%2CYSGLLXDM%2CDZKDM%2CXMDM%2CZFFSDM%2CYSDWDM%27%2C%20%20%20szGrp=%26gt;%27B%2EZJXZDM%2CB%2EZBLYDM%2CB%2EYSKMDM%2CB%2EJFLXDM%2CB%2EZCLXDM%2CB%2EYSGLLXDM%2CB%2EDZKDM%2CB%2EXMDM%2CB%2EZFFSDM%2CB%2EYSDWDM%27%2C%20%20%20CXJEKZ=%26gt;%270%27%2C%20%20%20pRecCur=%26gt;:pRecCur%20%29;end%20;%20</DATA></PARAM></PARAMS></R9FUNCTION></R9PACKET>';
		//*********************************************************************
		$findquery_benji='<?xml version="1.0" encoding="GB2312"?><R9PACKET version="1"><SESSIONID></SESSIONID><R9FUNCTION><NAME>AS_DataRequest</NAME><PARAMS><PARAM><NAME>ProviderName</NAME><DATA format="text">DataSetProviderData</DATA></PARAM><PARAM><NAME>Data</NAME><DATA format="text">begin%20%20zbsp_ZFPZJYJH%28%20%20%20szkjnd=%26gt;%272017%27%2C%20%20%20szGsdm=%26gt;%27001%27%2C%20%20%20szdzkdm=%26gt;%27%C8%AB%B2%BF%27%2C%20%20%20szzffsdm=%26gt;%2702%27%2C%20%20%20szdwdm=%26gt;%27901006000%27%2C%20%20%20szYWLX=%26gt;%27%C8%AB%B2%BF%27%2C%20%20%20szZJXZDM=%26gt;%27%C8%AB%B2%BF%27%2C%20%20%20szZBLYDM=%26gt;%27%C8%AB%B2%BF%27%2C%20%20%20SJQXFX=%26gt;%270100000000%27%2C%20%20%20QYQX=%26gt;0%2C%20%20%20CZYID=%26gt;899%20%2C%20%20JHDBGZKZ=%26gt;%270%27%2C%20%20ZBDBGZKZ=%26gt;%271%27%2C%20%20szTJ=%26gt;%27_%27%2C%20%20szKJRQ=%26gt;%2720170511%27%2C%20%20%20szRQKZ=%26gt;%270%27%2C%20%20%20szYF=%26gt;%275%27%2C%20%20%20szXJBZ=%26gt;%270%27%2C%20%20%20szXJKZ=%26gt;%270%27%2C%20%20%20szYKJHZT=%26gt;%270%27%2C%20%20%20szFXJKZ=%26gt;%270%27%2C%20%20%20szDJKZYS=%26gt;%270001111111011100%27%2C%20%20%20szSelect=%26gt;%27ZJXZDM%2CZBLYDM%2CYSKMDM%2CJFLXDM%2CZCLXDM%2CYSGLLXDM%2CDZKDM%2CXMDM%2CZFFSDM%2CYSDWDM%27%2C%20%20%20szGrp=%26gt;%27B%2EZJXZDM%2CB%2EZBLYDM%2CB%2EYSKMDM%2CB%2EJFLXDM%2CB%2EZCLXDM%2CB%2EYSGLLXDM%2CB%2EDZKDM%2CB%2EXMDM%2CB%2EZFFSDM%2CB%2EYSDWDM%27%2C%20%20%20CXJEKZ=%26gt;%270%27%2C%20%20%20pRecCur=%26gt;:pRecCur%20%29;end%20;%20</DATA></PARAM></PARAMS></R9FUNCTION></R9PACKET>';
		
		/*=====  End of Section comment block  ======*/
		
		
		if ($xingzheng_benji=="benji") {
			$findquery=$findquery_benji;
			
		}
		 $this->balancebody=$this->jiema($findquery);
		 //dd($this->balancebody);
		 $this->balancebody=$this->timereplace($this->balancebody);
		 
		return $this->makerequest($this->balancebody);
	}

	// public function sendpost(){
	// 	$this->insertbody=;
	// 	$this->makerequest();

	// }
	public function makekjharray($kjhdata) //将<ROWDATA></ROWDATA>之间的数据转化为数组
	{
		           $kjhdata=(string)$kjhdata;


            $kjhdata = substr($kjhdata,strpos($kjhdata, "<ROWDATA>"),(strpos($kjhdata, "</ROWDATA>")-strpos($kjhdata, "<ROWDATA>")));
            $kjhdata = substr($kjhdata,14,-3);

           

            $kjhdata=explode(" /><ROW" , $kjhdata);
            $kjhdata=str_replace(" DZKDM",'DZKDM',$kjhdata);

            foreach ($kjhdata as $key => $value) 
            	{

                # code...
                $value='{"'.str_replace("=",'":', $value).'}';
                $kjhdata[$key]=str_replace(" ",',"', $value);

                $kjhdata[$key] = json_decode($kjhdata[$key],true);
                
            	}
            return $kjhdata;
	}


	/**
	 * summary
	 *
	 * @return void
	 * @author 
	 */
	
	public function add_rizhi($pid,$djbh)
	{
	           
         $data= '<?xml version="1.0" encoding="GB2312"?><R9PACKET version="1"><SESSIONID></SESSIONID><R9FUNCTION><NAME>AS_DataRequest</NAME><PARAMS><PARAM><NAME>ProviderName</NAME><DATA format="text">DataSetProviderData</DATA></PARAM><PARAM><NAME>Data</NAME><DATA format="text">%20begin%20%20%20declare%20maxNo%20int;%20%20%20begin%20%20%20%20%20%20Select%20nvl%28Max%28no%29%2C0%29%2B1%20into%20maxNo%20from%20ZB_czrz%20%20%20where%20station%20like%20%27PC%2D20161129CAOZ%25%27%20;%20%20%20%20insert%20into%20ZB_czrz%28station%2C%20no%2C%20name%2C%20%26quot;DATE%26quot;%2C%20zwrq%2C%20qssj%2C%20zzsj%2C%20cznr%2Ccznrkz%29%20%20%20%20values%20%28%27PC%2D20161129CAOZ_10%2E111%2E102%2E41%27%2CmaxNo%2C%27%B8%B5%B0%AE%C7%ED%27%2C%20TO_CHAR%28SYSDATE%2C%27YYYYMMDD%27%29%2C%2720170516%27%20%20%20%20%2CTO_CHAR%28SYSDATE%2C%27HH24:MI:SS%27%29%2CTO_CHAR%28SYSDATE%2C%27HH24:MI:SS%27%29%2C%27[%CA%DA%C8%A8%D6%A7%B8%B6%C6%BE%D6%A4][%D0%C2%D4%F6][001%2C2017%2C201705%2C21886]%27%2C%27%27%29%20;%20%20%20%20%20commit;%20%20%20%20%20%20open%20:pRecCur%20for%20select%20maxNo%20NewNo%20from%20dual;%20%20%20%20end;%20end;</DATA></PARAM></PARAMS></R9FUNCTION></R9PACKET>';
         $data=$this->jiema($data);


		$timepattern="/\'201([0-9]{5})\'/"; 
		$copydata=$data;
		$data=preg_replace($timepattern,"to_char(sysdate,'yyyymmdd')",$data);
		
		 $this->checkreplace($copydata,$data);

        $pattern="/\[001,.+\]/";
        $Y=(string)(date('Y'));
         $Ym=(string)(date('Ym'));
         

         $data2="[001,$Y,$Ym,$pid]";

        $copydata=$data;
        $data=preg_replace($pattern,$data2,$data);
        $this->checkreplace($copydata,$data);
        //dd($data);
        $ifsuccess=$this->makerequest($data);
        if (!stristr($ifsuccess,"NEWNO" )) {
        	dd("$ifsuccess");//更改NEWNO就可以调试增加日志的response
        }

        \App\Sql::create(['pid'=>$pid,'type'=>'addrizhi','djbh'=>$djbh,'sql'=>iconv('GB2312','UTF-8',$data)]);



        return true;
        
	}


	/**
	 * summary
	 *
	 * @return void
	 * @author 
	 */
	
	public function deletefj($pid,$djbh)
	{
	    $data = '<?xml version="1.0" encoding="GB2312"?><R9PACKET version="1"><SESSIONID></SESSIONID><R9FUNCTION><NAME>AS_DataRequest</NAME><PARAMS><PARAM><NAME>ProviderName</NAME><DATA format="text">DataSetProviderData</DATA></PARAM><PARAM><NAME>Data</NAME><DATA format="text">Begin%20%20%20delete%20from%20ZB_ZFPZFJ%20where%20%20%20%20%20%20GSDM=%27001%27%20%20and%20KJND=%272017%27%20%20and%20PDQJ=%27201704%27%20%20and%20ZFLB=%270%27%20%20and%20PDH=21886%20;%20%20commit%20;%20%20%20open%20:pRecCur%20for%20select%200%20ierrCount%20from%20dual;%20Exception%20when%20others%20then%20RollBack%20;%20end;%20</DATA></PARAM></PARAMS></R9FUNCTION></R9PACKET>';
	    $data=$this->jiema($data);
	    //进行日期替换  这里把月份修改成201704
	    $copydata=$data;
	    $data=$this->timereplace($data);
	    $this->checkreplace($copydata,$data);

	    $copydata=$data;
	    $data=str_replace("21886", $pid, $data);
	     $this->checkreplace($copydata,$data);
	    //dd($data);


	    $ifsuccess=$this->makerequest($data);
        if (!stristr($ifsuccess,"ZB_ZFPZFJ" )) {
        	dd("$ifsuccess");//更改NEWNO就可以调试增加日志的response
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
		//dd();
		$res=Payout::create($data);

	    

	    
	}

	
}
