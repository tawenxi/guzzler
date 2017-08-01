<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\MakeZbArray;
use App\Model\Http;
use App\Model\Tt\Data;
use App\Model\Tt\Replace;

class Getsqzb extends Model
{
    use Data;use Replace;

    private $http;

    public function __construct(Http $http){
        $this->http = $http;
    }

    public function getsqdata()
    {
        $date_xingzheng = $this->find_post($this->findquery_xingzheng);
        $date_xingzheng = (string)$date_xingzheng;
        $date_xingzheng = MakeZbArray::MakeZbArray($date_xingzheng);

        $date_benji = $this->find_post($this->findquery_benji);
        $date_benji = (string)$date_benji;
        $date_benji = MakeZbArray::MakeZbArray($date_benji);

        $date_all = array_merge($date_xingzheng,$date_benji);
        return $date_all;
    }


    public function find_post($findquery)
    {   
         $balancebody = $this->jiema($findquery);
         $balancebody = $this->timereplace($balancebody);
        return $this->http->makerequest($balancebody);
    }

    
}
