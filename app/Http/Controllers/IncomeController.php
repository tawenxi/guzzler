<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Income;
use Session;
use App\Model\Excel;

class IncomeController extends Controller
{
    private $excel;
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
    public function indexs($fp=0)
    {
        $incomes = Income::fp($fp)->orderBy('date')->paginate(300);
        return $this->excel->exportBlade('incomecost.showincome', compact('incomes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('incomecost.createincome');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'amount'=>'numeric',
            'cost'=>'numeric',
            ]);
         Income::create($request->all());
        \Session::flash('success', "添加收入成功");
        return redirect()->to('/incomes');
        
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
        $income = Income::find($id);
        return view('incomecost.editincome', compact('income'));
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
        Income::where('id',$id)->Update($request->only('date','zhaiyao','xingzhi','amount','cost','kemu','beizhu'));
        Session::flash("success", "更新收入成功");
        return redirect()->to('/incomes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Income::destroy($id);
        Session::flash("success", "删除收入成功");
        return redirect()->back();
    }
}
