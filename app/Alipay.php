<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alipay extends Model implements Pay
{
    public function say()
    {
        echo 'alipsay';
    }
}
