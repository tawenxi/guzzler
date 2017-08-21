<?php

namespace App\Model;

class MakeZbArray
{

public static function MakeZbArray($sqldata) //将<ROWDATA></ROWDATA>之间的数据转化为数组
    {
        $sqldata = (string)$sqldata;
        $sqldata = str_replace(array("\r\n", "\r", "\n"), "", $sqldata); 
        //dd($sqldata);
        $sqldata = substr($sqldata,strpos($sqldata, "<ROWDATA>"),(strpos($sqldata, "</ROWDATA>")-strpos($sqldata, "<ROWDATA>")));
        $sqldata = substr($sqldata,14,-3);
        $fenge = substr($sqldata,0,stripos($sqldata, '='));
        $sqldata = str_replace(" ".$fenge,$fenge,$sqldata);
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
