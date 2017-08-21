<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Tt\Data;
use App\Model\Respostory\GetSqlResult;


class SqlController extends Controller
{
    use Data;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(GetSqlResult $getdetail)
    {
        

        $res = $getdetail->getdata($this->mysql,[
            ['mysql',"select * from  PUBAUDITLOG       where KJND='2017' and Gsdm='001' and AUDITORID = '897'"]]);  //和直接支付申请，计划申请和作废有关系 

        $res = $getdetail->getdata($this->mysql,[
            ['mysql',"select * From ZB_ZFSQDNR  where  GSDM='001'       and KJND='2017'       and ZFPZPDQJ='201708'  and LRR_ID = '897'"]]);   //只和直接支付有关系 ZFFSDM": "01",


        

        // $res = $getdetail->getdata($this->mysql,[
        //     ['mysql',"select * From ZB_VIEW_ZFPZ A  where   PDQJ='201708' and LRR_ID = '897'"]]);
        return($res);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
