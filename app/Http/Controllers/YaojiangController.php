<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class YaojiangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $puk = collect(
            ['3', '3', '3', '3', '3', '3', '3', '3',
              '4', '4', '4', '4', '4', '4', '4', '4',
              '5', '5', '5', '5', '5', '5', '5', '5',
              '6', '6', '6', '6', '6', '6', '6', '6',
              '7', '7', '7', '7', '7', '7', '7', '7',
              '8', '8', '8', '8', '8', '8', '8', '8',
              '9', '9', '9', '9', '9', '9', '9', '9',
              '10', '10', '10', '10', '10', '10', '10', '10',
              'J', 'J', 'J', 'J', 'J', 'J', 'J', 'J',
              'Q', 'Q', 'Q', 'Q', 'Q', 'Q', 'Q', 'Q',
              'K', 'K', 'K', 'K', 'K', 'K', 'K', 'K',
              'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A',
              '2', '2', '2', '2', '2', '2', '2', '2', ]);
        //->shuffle()
        $i = 0;
        $totalnum = 0;
        while ($totalnum < 5) {
            $totalnum++;
            $getpuk = $puk->random(26)->groupBy(function ($item, $key) {
                return $item;
            });
            $res = $getpuk->map(function ($value) {
                return $value->count();
            });
            $jiang = $res->filter(function ($item) {
                return $item >= 5;
            });
            if ($res->get(2) == 4 || $jiang != collect($value = null)) {
                $i++;
                $string = '';
                foreach ($jiang as $key => $value) {
                    $string .= "{$value}个$key,";
                }
                dump("测试第{$totalnum}条数据，摇奖情况{$res->get(2)}个2，$string");
                continue;
            }
        }
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
        //
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
