<?php

namespace App\Http\Controllers;

use App\Model\Payout;
use App\Model\Account;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    public function account()
    {
        return view('search.account')->render();
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
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $key = $request->account_name;
        $result = Account::where('account_name', 'like', "%$key%")->get();

        return \Response::json([
            'status'=>'success',
            'task'=>$result,
            ]);
    }

    public function addstore(Request $request)
    {
        $result = Account::create(
            ['account_name'=>$request->account_name,
             'account_number'=>$request->account_number, ]);

        return \Response::json([
            'status'=>'success',
            'task'=>$result,
            ]);
    }

    public function payout(Request $request)
    {
        $key = $request->zhaiyao;
        $result = Payout::where('zhaiyao', 'like', "%$key%")
        ->Orwhere('payee', 'like', "%$key%")
        ->Orwhere('amount', 'like', "%$key%")
    //     ->Orwhere(function ($query) use($key) {
    // $query->where('created_at', '>', "$key"."-01 00:00:00")
    //       ->Where('created_at', '<', "$key"."-31 24:00:00");})
        ->get();

        return \Response::json([
            'status'=>'success',
            'task'=>$result,
            ]);
    }

    public function payout_with_date(Request $request)
    {
        $key = $request->zhaiyao;
        $result = Payout::Orwhere(function ($query) use ($key) {
            $query->where('created_at', '>', "$key".'-01 00:00:00')
           ->Where('created_at', '<', "$key".'-31 24:00:00');
        })
        ->get();

        return \Response::json([
            'status'=>'success',
            'task'=>$result,
            ]);
    }

    public function modifyacc()
    {
        return view('search.modifyacc')->render();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
