<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Client;

class Guzzle extends Model
{
    //

	public $body;
	public $payee = [];
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
		$this->payee = $payee;
		$this->body = file_get_contents(dirname(__FILE__)."//Http//Controllers//guzzledata.txt");//这个body需要修改成data
		$this->body = urldecode($this->body);


		header("Content-Type: text/html;charset=utf-8");
		$this->body = iconv('GB2312', 'UTF-8', $this->body);


		$this->body=str_replace('遂川','LXY',$this->body);
		
		
		
		
	}
	//public function getbody()
	//{
	//	$body1=str_replace('中文','我的中文',urldecode($this->data);
	//	$body1=str_replace('中文','我的中文',urldecode($this->data);
	//	$body1=str_replace('中文','我的中文',urldecode($this->data);
	//	$this->body=$body1;
		
	//}
	
	
}
