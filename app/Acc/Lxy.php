<?php

namespace App\Acc;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class Lxy 

{	

	public $llj;
	public function __construct($llj)
	{

		$this->llj=$llj;

	}
	public function show($arr)
	{
		echo "I am Lxy function--";
		dump($arr);
	}
		public function do()
	{
		return $this->llj->show();
	}

		public function me()
	{
		return $this;
	}


}