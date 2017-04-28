<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Client;
use App\Guzzledb;

class Guzzle extends Model
{
    //

	public $insertbody; //发送post的dq部分
	public $payee=[]; //需要替换的银行信息
	public $data;  //用来转化utf->GBK
	public $balancebody;//查询余额的dp
	
	
	
	public function makerequest($dq)//根据body属性发送请求
	{	//$dq= iconv('UTF-8','GB2312',$dq);//发送请求之前进行转码GB2312->utf8
		echo "=============!request=================<br/>";
		 iconv('GB2312','UTF-8',$dq);

		echo "<br/>=============request=================<br/>";
		$client = new Client();
		$response = $client->request('POST', 'http://10.108.8.1:7007/Proxy', 
		[
			'form_params' => 
				[
					'cVer' => '9.8.0',
					'dp'=>$dq,
				],
		
		]);
			//$code = $response->getStatusCode(); // 200
			$responsebody = $response->getBody();
			$responsebody = iconv('GB2312','UTF-8', $responsebody);

			if(strlen($responsebody)<520){
				echo "success<br/>";

				//echo "$responsebody--";
			}else{
			 //	echo "$responsebody";
			};


			return $responsebody;
	}
	public function add_post()
	{	
		echo $zbamount=$this->get_amountstring($this->payee);//获取最新数据

		$this->accountreplace($this->payee);
		$this->amountreplace($zbamount);

		$this->insertbody=$this->timereplace($this->insertbody);
		return $this->makerequest($this->insertbody);
	}

	public function get_amountstring($payee)
	{		




			$finddata=$this->getfinddata();

			//dump($finddata);
           
			$collection = collect($finddata);

			$filtered = $collection->filter(function ($item) use($payee)
				{	
					
   					 return $item['ZBID']==$payee['5'];
					
				});

			//dump($filtered->pop());
			 $zb=$filtered->pop();


			  $amountstring=$zb["YKJHZB"].",".$zb["YYJHJE"].",".$zb["KYJHJE"].",".$payee['3'];
			 return $amountstring;
			 



	}
	//-----------------------
		public function amountreplace($zbamount)
	{
		 //$this->insertbody=$this->jiema($this->insertbody);//替换之前进行解码

		$pattern3='/\d{1,}(.[0-9]{1,})?,\s+\d{1,}(.[0-9]{1,})?,\s+\d{1,}(.[0-9]{1,})?,\s+\d{1,}(.[0-9]{1,})?/';
		 $this->insertbody=preg_replace($pattern3,$zbamount,$this->insertbody);
		
		//$this->insertbody = iconv('UTF-8', 'GB2312', $this->insertbody);
	}
	public function accountreplace($payee)
	{	
		$this->insertbody=$this->jiema($this->insertbody);//替换之前进行解码
		$this->insertbody = iconv('GB2312', 'UTF-8', $this->insertbody);
		$this->insertbody=str_replace('吉安遂川县财政局',$payee[0],$this->insertbody);
		$this->insertbody=str_replace('190207313396',$payee[1],$this->insertbody);
		$this->insertbody=str_replace('中行遂川支行',$payee[2],$this->insertbody);
		//$this->insertbody=str_replace('1.61',$payee[3],$this->insertbody);
		$this->insertbody=str_replace('2016年计生事业费',$payee[4],$this->insertbody);
		$this->insertbody = iconv('UTF-8', 'GB2312', $this->insertbody);
		//echo $this->insertbody;	
	}
	public function timereplace($data)
	{
		$pattern="/\'201([0-9]{5})\'/";
		$pattern1="/\'201([0-9]{3})\'/"; 
		$data=preg_replace($pattern,"to_char(sysdate,'yyyymmdd')",$data);
		$data=preg_replace($pattern1,"to_char(sysdate,'yyyymm')",$data);
		return $data;
	}
		//-----------------------950,0 950, 

	public function getfinddata()//返回一个数组
	{
			$zbobject=new self();
           $kjhdata=$zbobject->find_post();
           $kjhdata=(string)$kjhdata;

           $kjhdata=$zbobject->makekjharray($kjhdata);
           dump($kjhdata);
           return $kjhdata;

	}

	
	public function __construct($payee=[])//默认发送guzzledata.txt的数据 后需要如果需要发送别的数据需要对$this->insertbody进行修改
			{
				$this->payee=$payee;//一条数据：一位数组

				$this->insertbody=file_get_contents(dirname(__FILE__)."//Http//Controllers//guzzledata.txt");//这个body需要修改成data
				//$this->balancebody=file_get_contents(dirname(__FILE__)."//Http//Controllers//balancebody.txt");
				
				//$zb=ZB::where('ZBID',$payee['5'])-get();
				//$this->insertbody=$zb->zbbq;
			}


	public function updatedb()
	{


			$finddata=$this->getfinddata();
			$collection = collect($finddata);
			$collection = $collection->map(function ($item)
				{	
					
			Guzzledb::updateOrCreate(['ZBID' => $item['ZBID']],
                        $item);

   					// return $item['ZBID']==$payee['5'];
					
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


		public function find_post()
	{	
		$findquery='<?xml version="1.0" encoding="GB2312"?><R9PACKET version="1"><SESSIONID></SESSIONID><R9FUNCTION><NAME>AS_DataRequest</NAME><PARAMS><PARAM><NAME>ProviderName</NAME><DATA format="text">DataSetProviderData</DATA></PARAM><PARAM><NAME>Data</NAME><DATA format="text">begin%20%20zbsp_ZFPZJYJH%28%20%20%20szkjnd=%26gt;%272017%27%2C%20%20%20szGsdm=%26gt;%27001%27%2C%20%20%20szdzkdm=%26gt;%27%C8%AB%B2%BF%27%2C%20%20%20szzffsdm=%26gt;%2702%27%2C%20%20%20szdwdm=%26gt;%27901006001%27%2C%20%20%20szYWLX=%26gt;%27%C8%AB%B2%BF%27%2C%20%20%20szZJXZDM=%26gt;%27%C8%AB%B2%BF%27%2C%20%20%20szZBLYDM=%26gt;%27%C8%AB%B2%BF%27%2C%20%20%20SJQXFX=%26gt;%270100000000%27%2C%20%20%20QYQX=%26gt;0%2C%20%20%20CZYID=%26gt;899%20%2C%20%20JHDBGZKZ=%26gt;%270%27%2C%20%20ZBDBGZKZ=%26gt;%271%27%2C%20%20szTJ=%26gt;%27_%27%2C%20%20szKJRQ=%26gt;%2720170425%27%2C%20%20%20szRQKZ=%26gt;%270%27%2C%20%20%20szYF=%26gt;%274%27%2C%20%20%20szXJBZ=%26gt;%270%27%2C%20%20%20szXJKZ=%26gt;%270%27%2C%20%20%20szYKJHZT=%26gt;%270%27%2C%20%20%20szFXJKZ=%26gt;%270%27%2C%20%20%20szDJKZYS=%26gt;%270001111111011100%27%2C%20%20%20szSelect=%26gt;%27ZJXZDM%2CZBLYDM%2CYSKMDM%2CJFLXDM%2CZCLXDM%2CYSGLLXDM%2CDZKDM%2CXMDM%2CZFFSDM%2CYSDWDM%27%2C%20%20%20szGrp=%26gt;%27B%2EZJXZDM%2CB%2EZBLYDM%2CB%2EYSKMDM%2CB%2EJFLXDM%2CB%2EZCLXDM%2CB%2EYSGLLXDM%2CB%2EDZKDM%2CB%2EXMDM%2CB%2EZFFSDM%2CB%2EYSDWDM%27%2C%20%20%20CXJEKZ=%26gt;%270%27%2C%20%20%20pRecCur=%26gt;:pRecCur%20%29;end%20;%20</DATA></PARAM></PARAMS></R9FUNCTION></R9PACKET>';

		 $this->balancebody=$this->jiema($findquery);
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
	
}
