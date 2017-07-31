<?php

namespace App\Model;

trait Zhibiao
{
    
    public function get_ZB()
    {
        $ZB_data = $this->find_zb_post($this->zhibiao_sql);
        $ZB_data = (string)$ZB_data;
        $response = $this->makeZBarray($ZB_data);
        return $response;
    }

    public function get_detail($zbid)
    {
        $ZB_data = $this->find_zb_post($this->detail_sql,$zbid);
        $ZB_data = (string)$ZB_data;
        $response = $this->makeZBarray($ZB_data);
        if (!$response[0])
            { 
                $ZB_data = $this->find_zb_post($this->detail_sql2,$zbid);
            $ZB_data = (string)$ZB_data;
            $response = $this->makeZBarray($ZB_data);
            }
        return $response;
    }


    public function find_zb_post($findquery, $zbid='')
    {   
         $this->balancebody = $this->jiema($findquery);

         $this->balancebody = str_replace("001.2017.0.2470", $zbid, $this->balancebody);

         $this->balancebody = str_replace("001.2017.0.3035", $zbid, $this->balancebody);

         $this->balancebody = str_replace("'20170728'", "to_char(sysdate,'yyyymmdd')", $this->balancebody);
         //dd($this->balancebody);
        return $this->http->makerequest($this->balancebody);
    }

    public function makeZBarray($sqldata) //将<ROWDATA></ROWDATA>之间的数据转化为数组
    {
        $sqldata = (string)$sqldata;
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
