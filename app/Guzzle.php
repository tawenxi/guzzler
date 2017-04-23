<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Client;

class Guzzle extends Model
{
    //

	public $body;
	public $payee=[];
	public $data;
	
	
	
	public function makerequest()
	{	
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
			if(strlen($body)<520){
				echo "success";
			}else{
				echo "$body";
			};
	}
	
	public function __construct($payee=[])
	{
		$this->payee=$payee;
		$this->body=file_get_contents(dirname(__FILE__)."//Http//Controllers//guzzledata.txt");//这个body需要修改成data
		$this->setreplace($payee);
		
		
		
	}
	
	public function setreplace($payee)
	{
		$this->body=urldecode($this->body);


		//header("Content-Type: text/html;charset=utf-8");
		$this->body = iconv('GB2312', 'UTF-8', $this->body);


		$this->body=str_replace('吉安遂川县财政局',$payee[0],$this->body);
		$this->body=str_replace('190207313396',$payee[1],$this->body);
		$this->body=str_replace('中行遂川支行',$payee[2],$this->body);
		$this->body=str_replace('1.61',$payee[3],$this->body);
		$this->body=str_replace('2016年计生事业费',$payee[4],$this->body);
		echo $this->body;
		$this->body = iconv('UTF-8','GB2312', $this->body);
	}
	//public function getbody()
	//{
	//	$body1=str_replace('中文','我的中文',urldecode($this->data);
	//	$body1=str_replace('中文','我的中文',urldecode($this->data);
	//	$body1=str_replace('中文','我的中文',urldecode($this->data);
	//	$this->body=$body1;
		
	//}
	public function setpayee($payee=[])
	{
		$this->payee=$payee;
	}
	
	
}
