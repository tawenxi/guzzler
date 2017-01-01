<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Client;

class Guzzle extends Model
{
    //

	public $body; //发送post的dq部分
	public $payee=[]; //需要替换的银行信息
	public $data;  //用来转化utf->GBK
	public $balancebody;//查询余额的dp
	
	
	
	public function makerequest()//根据body属性发送请求
	{	$this->body = iconv('UTF-8','GB2312', $this->body);//发送请求之前进行转码GB2312->utf8
		$client = new Client();
		$response = $client->request('POST', 'http://10.108.8.1:7007/Proxy', 
		[
			'form_params' => 
				[
					'cVer' => '9.8.0',
					'dp'=>$this->body,
				],
		
		]);
			//$code = $response->getStatusCode(); // 200
			$body = $response->getBody();
			$body = iconv('GB2312','UTF-8', $body);

			if(strlen($body)<520){
				echo "success<br/>";
				//echo "$body--";
			}else{
			 //	echo "$body";
			};

			return $body;
	}

	
	public function __construct($payee=[])//默认发送guzzledata.txt的数据 后需要如果需要发送别的数据需要对$this->body进行修改
			{
				$this->payee=$payee;//一条数据：一位数组
				$this->body=file_get_contents(dirname(__FILE__)."//Http//Controllers//guzzledata.txt");//这个body需要修改成data
				$this->balancebody=file_get_contents(dirname(__FILE__)."//Http//Controllers//balancebody.txt");

				if ($payee!=[])//不传参数的情况下就 不做替换 不解码可能会出现错误
					 {
						$this->setreplace($payee);
					 }		

		
			}


	public function updatedb()
	{
		echo 'ok';
	}
		
	
	public function setreplace($payee)
	{
		$this->body=$this->jiema($this->body);//替换之前进行解码（decode and utf8->GB2312）

		

		


		$this->body=str_replace('吉安遂川县财政局',$payee[0],$this->body);
		$this->body=str_replace('190207313396',$payee[1],$this->body);
		$this->body=str_replace('中行遂川支行',$payee[2],$this->body);
		$this->body=str_replace('1.61',$payee[3],$this->body);
		$this->body=str_replace('2016年计生事业费',$payee[4],$this->body);
		//echo $this->body;
		
	}
	//public function getbody()
	//{
	//	$body1=str_replace('中文','我的中文',urldecode($this->data);
	//	$body1=str_replace('中文','我的中文',urldecode($this->data);
	//	$body1=str_replace('中文','我的中文',urldecode($this->data);
	//	$this->body=$body1;
		
	//}
	public function setpayee($payee=[])//还没开始使用
	{
		$this->payee=$payee;
	}

	public function jiema($data)//传入加密内容 解码并且转化为GB2312  并进行日期替换
	{
		 $data=urldecode($data);
		echo "<br>";
		echo "<br>";
		echo "<br>-----------------------------";
		 // $a=(string)("'".date('20ymd',time())."'");
		 // $b=(string)("'".date('20ym',time())."'");

		 //dump($a);
		 $pattern="/\'201([0-9]{5})\'/";
		 $pattern1="/\'201([0-9]{3})\'/";

		 

		 $data=preg_replace($pattern,"to_char(sysdate,'yyyymmdd')",$data);
		 $data=preg_replace($pattern1,"to_char(sysdate,'yyyymm')",$data);


		//header("Content-Type: text/html;charset=utf-8");
		echo $data = iconv('GB2312', 'UTF-8', $data);
		
		return $data;
	}

	public function getbalance($ykjjid)
	{

	}

	public function getallykjjid()
	{
			$findquery='<?xml version="1.0" encoding="GB2312"?><R9PACKET version="1"><SESSIONID></SESSIONID><R9FUNCTION><NAME>AS_DataRequest</NAME><PARAMS><PARAM><NAME>ProviderName</NAME><DATA format="text">DataSetProviderData</DATA></PARAM><PARAM><NAME>Data</NAME><DATA format="text">begin%20%20zbsp_ZFPZJYJH%28%20%20%20szkjnd=%26gt;%272017%27%2C%20%20%20szGsdm=%26gt;%27001%27%2C%20%20%20szdzkdm=%26gt;%27%C8%AB%B2%BF%27%2C%20%20%20szzffsdm=%26gt;%2702%27%2C%20%20%20szdwdm=%26gt;%27901006001%27%2C%20%20%20szYWLX=%26gt;%27%C8%AB%B2%BF%27%2C%20%20%20szZJXZDM=%26gt;%27%C8%AB%B2%BF%27%2C%20%20%20szZBLYDM=%26gt;%27%C8%AB%B2%BF%27%2C%20%20%20SJQXFX=%26gt;%270100000000%27%2C%20%20%20QYQX=%26gt;0%2C%20%20%20CZYID=%26gt;899%20%2C%20%20JHDBGZKZ=%26gt;%270%27%2C%20%20ZBDBGZKZ=%26gt;%271%27%2C%20%20szTJ=%26gt;%27_%27%2C%20%20szKJRQ=%26gt;%2720170425%27%2C%20%20%20szRQKZ=%26gt;%270%27%2C%20%20%20szYF=%26gt;%274%27%2C%20%20%20szXJBZ=%26gt;%270%27%2C%20%20%20szXJKZ=%26gt;%270%27%2C%20%20%20szYKJHZT=%26gt;%270%27%2C%20%20%20szFXJKZ=%26gt;%270%27%2C%20%20%20szDJKZYS=%26gt;%270001111111011100%27%2C%20%20%20szSelect=%26gt;%27ZJXZDM%2CZBLYDM%2CYSKMDM%2CJFLXDM%2CZCLXDM%2CYSGLLXDM%2CDZKDM%2CXMDM%2CZFFSDM%2CYSDWDM%27%2C%20%20%20szGrp=%26gt;%27B%2EZJXZDM%2CB%2EZBLYDM%2CB%2EYSKMDM%2CB%2EJFLXDM%2CB%2EZCLXDM%2CB%2EYSGLLXDM%2CB%2EDZKDM%2CB%2EXMDM%2CB%2EZFFSDM%2CB%2EYSDWDM%27%2C%20%20%20CXJEKZ=%26gt;%270%27%2C%20%20%20pRecCur=%26gt;:pRecCur%20%29;end%20;%20</DATA></PARAM></PARAMS></R9FUNCTION></R9PACKET>';

			$findquery=$this->jiema($findquery);
			$this->body=$findquery;

	}
	// public function sendpost(){
	// 	$this->body=;
	// 	$this->makerequest();

	// }
	public function makekjhdata($kjhdata) //将<ROWDATA></ROWDATA>之间的数据转化为数组
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
