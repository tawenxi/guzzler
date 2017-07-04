<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Cost;
use App\Model\Excel;

class CostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Excel $excel)
    {
        $this->middleware('auth');
        $this->middleware('admin');
        $this->excel = $excel;
        
    }
    public function indexs(\Illuminate\Http\Request $request)
    {
        $a = is_null($request->order)?"date":$request->order;
        $my = is_null($request->my)?"50":$request->my;
        $date1 = \Input::has('date1')?\Input::get('date1'):date("Y-m-01",time());
        $date2 = \Input::has('date2')?\Input::get('date2'):date("Y-m-d H:i:s",time()+86400);
        $costs = Cost::whereBetween('date', [$date1, $date2])->orderBy($a,'desc')->paginate($my);

        return $this->excel->exportBlade('incomecost.showcost', compact('costs'));
    }
    public function show($id)
    {
       $costs = Cost::where('income_id',$id)
           ->orderBy("date",'desc')
           ->paginate(10);
           //dd($incomes);
        return $this->excel->exportBlade('incomecost.showiicost',compact('costs'));
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
    public function show1($id)
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
