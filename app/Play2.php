<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Play2 extends Model
{
    //
    public function ok()
    {
        echo 'play2';
    }

    public function __construct(\App\Play3 $p)
    {
        $p->ok();
    }
}
