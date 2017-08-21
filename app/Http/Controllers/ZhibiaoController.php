<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Respostory\Guzzle;
use App\Model\Zb;
use App\Model\Zfpz;
use App\Model\Respostory\Excel;
use App\Model\GetPerson;
use App\Model\Getzf;
use App\Model\Getsf;
use App\Model\Respostory\GetSqlResult;
use App\Model\Tt\Data;



class ZhibiaoController extends Controller
{
    use Data;

    private $excel;
    private $guzzleexcel;
    private $getperson;


    public function __construct(Excel $excel,  GetSqlResult $getdetail)
    {
    $this->middleware('auth');
    $this->middleware('admin');
    $this->middleware('sudo');
    $this->excel = $excel;
    $this->getdetail = $getdetail;
    $this->guzzleexcel = \App::make(Excel::class,['excel']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Guzzle $guzzle)
    {
        if (strstr($request->ip(),"192.168") AND !(\Input::has('show'))) 
        {
            $zb_data = $guzzle->get_ZB();
            $collection = collect($zb_data);
            $collection = $collection->map(function ($item)
            {    
            $info = Zb::updateOrCreate(['ZBID' => $item['ZBID']], $item);
                return $info;
            });
            if (\Input::has('update')) 
            {
           
                $zfpzdatas = $this->getdetail->getdata($this->zfpz,[
                                ["'20170101'","'20170801'"],
                                ["'20170821'","to_char(sysdate,'yyyymmdd')"],
                                ]);
                foreach ($zfpzdatas as $zfpzdata) {
                           Zfpz::updateOrCreate(['PDH' => $zfpzdata['PDH']], $zfpzdata);
                       }
            };                                        
        };
            $results = ZB::search(\Input::get('search'), 0.01, true)->orderBy('LR_RQ','desc')->get()->unique();
        return $this->excel->exportBlade('zhibiao.index',compact('results'))->render();
    }


    public function zb_detail(Guzzle $guzzle)
    {
        $results = Zfpz::search(\Input::get('search'), 0.01, true)->orderBy('PDRQ','desc')->get()->unique();
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
        $results = Zfpz::where('ZBID',$zbid)->get();
        return $this->excel->exportBlade('zhibiao.showzbdetail',compact('results'))->render();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showzf($id)
    {
        $person = $this->getperson->getpersondata($id);
        dd($person);
    }

    public function showallzf()
    {
        $person = $this->getzf->getpersondata();
        dd($person);
    }

    public function showallsf()//申请
    {
        $person = $this->getsf->getpersondata();
        dd($person);
    }


    public function getdetails()
    {  
        $person = $this->getdetail->getdata($this->zfpz,[
            ["'20170821'","to_char(sysdate,'yyyymmdd')"],]);
        dd($person); 
        
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

    public function inco()
    {
        $results = Zfpz::search(\Input::get('search'), 0.01, true)->orderBy('PDRQ','desc')->get()->unique();

        return $this->excel->exportBlade('zhibiao.inco',compact('results'))->render();
    }


}
