<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Play extends Model
{
	public $llj;
	public $lxy;
    public function show()
    {
    	echo "hello";
    	echo "br>";
    	$this->lxy->show();

    }
    	public function __construct(\App\Pay $p)
	{

		dd($p);
	}
}
