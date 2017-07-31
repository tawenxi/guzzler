<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Guzzle;
use App\Model\Http;

class Getzb extends Model
{
    private $guzzle;
    private $http;

    public function __construct(Http $http){
        $this->http = $http;
    }

    public function getfinddata(Guzzle $guzzle)
    {
        $this->guzzle = $guzzle;
        $date_xingzheng = $this->find_post($guzzle->findquery_xingzheng);
        $date_xingzheng = (string)$date_xingzheng;
        $date_xingzheng = $this->guzzle->makeZBarray($date_xingzheng);

        $date_benji = $this->find_post($guzzle->findquery_benji);
        $date_benji = (string)$date_benji;
        $date_benji = $this->guzzle->makeZBarray($date_benji);

        $date_all = array_merge($date_xingzheng,$date_benji);
        return $date_all;
    }


    public function find_post($findquery)
    {   
         $this->guzzle->balancebody = $this->guzzle->jiema($findquery);
         $this->guzzle->balancebody = $this->guzzle->timereplace($this->guzzle->balancebody);
        return $this->http->makerequest($this->guzzle->balancebody);
    }

    
}
