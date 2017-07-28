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
        return $response;
    }


    public function find_zb_post($findquery, $zbid='')
    {   
         $this->balancebody = $this->jiema($findquery);

         $this->balancebody = str_replace("001.2017.0.3035", $zbid, $this->balancebody);

         $this->balancebody = str_replace("'20170728'", "to_char(sysdate,'yyyymmdd')", $this->balancebody);
         //dd($this->balancebody);
        return $this->makerequest($this->balancebody);
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


    private $zhibiao_sql = '<?xml version="1.0" encoding="GB2312"?><R9PACKET version="1"><SESSIONID></SESSIONID><R9FUNCTION><NAME>AS_DataRequest</NAME><PARAMS><PARAM><NAME>ProviderName</NAME><DATA format="text">DataSetProviderData</DATA></PARAM><PARAM><NAME>Data</NAME><DATA format="text">Select%20a%2E%2A%2C%28case%20%20when%20substr%28a%2Edybz%2C1%2C1%29=%271%27%20then%20%27%D2%D1%B4%F2%D3%A1%27%20else%20%20%27%CE%B4%B4%F2%D3%A1%27%20end%29%20DYBZ1%20From%20ZB_VIEW_MXZB%20a%20%20%20%20where%20%20%20GSDM=%27001%27%20%20and%20KJND=%272017%27%20%20and%20%28MXZBLB=%270%27%20or%20MXZBLB=%272%27%29%20%20and%20%28YSDWDM%20IN%20%28%27901006%27%2C%27901006000%27%2C%27901006001%27%2C%27901006002%27%2C%27901006003%27%2C%27901006004%27%2C%27901006005%27%2C%27901006006%27%2C%27901006007%27%2C%27901006008%27%2C%27901006009%27%2C%27901006010%27%2C%27901006011%27%2C%27901006012%27%2C%27901006013%27%29%20or%20YSDWDM=%27_%27%29%20%20and%20%28Fwrq%20between%20%2720170101%27%20and%20%2720170728%27%29%20%20and%20MXZBBH%20between%20%271%27%20%20and%20%20%2799999999%27%20%20order%20by%20GSDM%2CKJND%2CMXZBBH%2CMXZBWH%2CMXZBXH</DATA></PARAM></PARAMS></R9FUNCTION></R9PACKET>
';

private $detail_sql = '<?xml version="1.0" encoding="GB2312"?><R9PACKET version="1"><SESSIONID></SESSIONID><R9FUNCTION><NAME>AS_DataRequest</NAME><PARAMS><PARAM><NAME>ProviderName</NAME><DATA format="text">DataSetProviderData</DATA></PARAM><PARAM><NAME>Data</NAME><DATA format="text">select%20%27%D6%A7%B8%B6%C6%BE%D6%A4%27%20BJDJ%2CTRIM%28gsdm%29||%27%2E%27||kjnd||%27%2E%27||PDQJ||%27%2E%27||ZFLB||%27%2E%27||PDH%20BGDJID%2C%20%27%20%27%20djzt%2Czy%2C0%20SQJE1%2Cje%2C%27%20%27%20wh%2Cdzkdm%20%2CDZKMC%2Cysdwdm%2CYSDWMC%2Cyskmdm%2CYSKMMC%2Cjflxdm%2CJFLXMC%2Cxmdm%2CXmMC%2Czjxzdm%2CZJXZMC%2Czblydm%2CZBLYMC%2Czclxdm%2CzclxMC%2Czffsdm%2CZFFSMC%2CLR_RQ%2CLRR%20%2CSJWH%2CBJWH%2CYWLXDM%2CYWLXMC%2CXMFLDM%2CXMFLMC%2CKZZLDM1%2CKZZLMC1%2CKZZLDM2%2CKZZLMC2%20%20from%20ZB_View_zfpz%20where%20%20%20%20%20%20gsdm=%27001%27%20%20and%20KJND=%272017%27%20%20and%20zbid%20=%27001%2E2017%2E0%2E3035%27%20%20</DATA></PARAM></PARAMS></R9FUNCTION></R9PACKET>';


}
