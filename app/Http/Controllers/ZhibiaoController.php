<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Guzzle;
use App\Model\Zb;
use App\Model\ZbDetail;
use App\Model\Excel;

class ZhibiaoController extends Controller
{
    public function __construct(Excel $excel)
    {
    $this->middleware('auth');
    $this->middleware('admin');
    $this->middleware('sudo');
    $this->excel = $excel;

    $this->guzzleexcel = \App::make(Excel::class,['excel']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Guzzle $guzzle)
    {
        if (strstr($request->ip(),"192.168") AND !(\Input::has('show'))) {
        $zb_data = $guzzle->get_ZB();
        $collection = collect($zb_data);
        $collection = $collection->map(function ($item){    
        $info = Zb::updateOrCreate(['ZBID' => $item['ZBID']], $item);
            return $info;
            });

        if (\Input::has('update')) {
        $ZBIDS = ZB::get(['ZBID']);
        foreach ($ZBIDS as $key => $value) {
            $zb_data = $guzzle->get_detail($value->ZBID);
            if ($zb_data[0]) 
            {
               $collection = collect($zb_data);

               $a=$collection->map(function($v)use($value){
                $v['ZBID'] = $value->ZBID;
                ZbDetail::updateOrCreate(['BGDJID' => $v['BGDJID']], $v);
                return $v;
               });
            }
            
            }
       
            }
        };
        $results = ZB::get();
        //dd($results->sum('ZBYE'));
        return $this->excel->exportBlade('zhibiao.index',compact('results'))->render();
    }


    public function zb_detail(Guzzle $guzzle)
    {
        
        $results = ZbDetail::orderBy('BGDJID','LR_RQ')->get();
        return $this->excel->exportBlade('zhibiao.detail',compact('results'))->render();
       
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
    public function show($zbid)
    {
        $results = ZbDetail::where('ZBID',$zbid)->get();
        return $this->excel->exportBlade('zhibiao.showzbdetail',compact('results'))->render();
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
