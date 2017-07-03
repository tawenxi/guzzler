<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Guzzle;

class Getzb extends Model
{
    private $guzzle;

    public function getfinddata(Guzzle $guzzle)
    {
        $this->guzzle = $guzzle;
        $date_xingzheng = $this->find_post($guzzle->findquery_xingzheng);
        $date_xingzheng = (string)$date_xingzheng;
        $date_xingzheng = $this->makekjharray($date_xingzheng);

        $date_benji = $this->find_post($guzzle->findquery_benji);
        $date_benji = (string)$date_benji;
        $date_benji = $this->makekjharray($date_benji);

        $date_all = array_merge($date_xingzheng,$date_benji);
        return $date_all;
    }


    public function find_post($findquery)
    {   
         $this->guzzle->balancebody = $this->guzzle->jiema($findquery);
         $this->guzzle->balancebody = $this->guzzle->timereplace($this->guzzle->balancebody);
        return $this->guzzle->makerequest($this->guzzle->balancebody);
    }

    public function makekjharray($sqldata) //将<ROWDATA></ROWDATA>之间的数据转化为数组
    {
        $sqldata = (string)$sqldata;
        $sqldata = substr($sqldata,strpos($sqldata, "<ROWDATA>"),(strpos($sqldata, "</ROWDATA>")-strpos($sqldata, "<ROWDATA>")));
        $sqldata = substr($sqldata,14,-3);
        $sqldata = str_replace(" DZKDM",'DZKDM',$sqldata);
        $sqldata = explode(" /><ROW" , $sqldata);
        foreach ($sqldata as $key => $value) 
        {
            $value = '{"'.str_replace("=",'":', $value).'}';
            $sqldata[$key] = str_replace("\" ",'","', $value);
            $sqldata[$key] = json_decode($sqldata[$key],true);  
        }
        return $sqldata;
    }
}
