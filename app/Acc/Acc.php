<?php

namespace App\Acc;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class Acc 
{
	public $search;

	// public function __construct($search)
	// {
	// 	$this->search=$search;
	// }
	private function findac($test)
	//传入一个文本  返回可能的会计科目，以数组的方式返回
		{
			return $b = $this->search->map(function($item,$key) use ($test)
			{
				if(strpos($test, $key)!==false)
					{
						return $item;
					};
			})->reject(function($item)
				{
					return $item==NULL;
				})->unique()->toArray();

		}
				/*****
	$tests 是一个集合



				*****/

		public function getAcc($tests)
		{


				return $es=$tests->flip()->map(function($item,$key)// use ($this)
				{
					return $this->findac($key);
				})->toArray();
				 // $d=$c->findac('办公是是');
		}



				


}