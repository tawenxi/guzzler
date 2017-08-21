<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\MakeZbArray;
use App\Model\Http;
use App\Model\Tt\Data;
use App\Model\Tt\Replace;

class GetDetail extends Model
{
    use Data;use Replace;

    private $http;

    public function __construct(Http $http){
        $this->http = $http;
    }

    public function getdata($sql, array $replaces)
    {
        $data = $this->find_post($sql, $replaces);
        $data = (string)$data;
        $data = MakeZbArray::MakeZbArray($data);

        return $data;
    }


    public function find_post($data, $replaces)
    {   
        $balancebody = $this->jiema($data);
        foreach ($replaces as $replace) {
            $balancebody = str_replace($replace[0], $replace[1],$balancebody);

        }

        // dd($balancebody);

        return $this->http->makerequest($balancebody);
    }

    
}