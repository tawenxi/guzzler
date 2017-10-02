<?php

namespace App\Acc;

class Lxy
{
    public $llj;

    public function __construct($llj)
    {
        $this->llj = $llj;
    }

    public function show($arr)
    {
        echo 'I am Lxy function--';
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
