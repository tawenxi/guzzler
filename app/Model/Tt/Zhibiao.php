<?php

namespace App\Model\Tt;

use App\Model\Respostory\MakeZbArray;

trait Zhibiao
{
    public function get_ZB()
    {
        $ZB_data = $this->find_zb_post($this->zhibiao_sql);
        $ZB_data = (string) $ZB_data;
        $response = MakeZbArray::MakeZbArray($ZB_data);

        return $response;
    }

    public function get_detail($zbid)
    {
        $filter_sql = [$this->detail_sql,
                    $this->detail_sql2, ];
        $response = [];
        foreach ($filter_sql as $key => $item) {
            $ZB_data = $this->find_zb_post($item, $zbid);
            $ZB_data = (string) $ZB_data;
            $response = array_merge(MakeZbArray::MakeZbArray($ZB_data), $response);
            //dump($response);
        }
        $result = collect($response)->reject(function ($item) {
            return $item === null;
        }
            );

        return $result;
    }

    public function find_zb_post($findquery, $zbid = '')
    {
        $this->balancebody = $this->jiema($findquery);

        $this->balancebody = str_replace('001.2017.0.2470', $zbid, $this->balancebody); //过滤sql2

        $this->balancebody = str_replace('001.2017.0.3035', $zbid, $this->balancebody);

        // $this->balancebody = str_replace("001.2017.0.5789", $zbid, $this->balancebody);//过滤 sql3

        $this->balancebody = str_replace("'20170728'", "to_char(sysdate,'yyyymmdd')", $this->balancebody);
        //dd($this->balancebody);
        return $this->http->makerequest($this->balancebody);
    }
}
