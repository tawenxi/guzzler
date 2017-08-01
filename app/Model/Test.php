<?php

namespace App\Model;


class Test 
{
	public static $open = false;
	public static $info = [];

	public static function log($log)
	{
		if (self::$open) {
			self::$info[] = $log;
		}
	}


     
}
