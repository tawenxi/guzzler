<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Pay;

class Alipay extends Model implements Pay
{
    public function say()
    {
    	echo "alipsay";
    }
}
