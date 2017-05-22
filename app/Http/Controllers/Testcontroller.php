<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Lxy;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $llj=app('llj');
        $llj->show();
        
        Lxy::show('arr1');
        echo "<br>";
        // return Lxy::do();
        echo "<br>";
        Lxy::me()->llj->show();
        echo "<br>";
        echo "===============";
        Lxy::show(['arr1','arr2']);
        echo "===============";
       

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
    public function show()
    {
        dd(app('lxy'));
        //dd($a);
        app()->make('lxy',['llsssj']);
        dd(app("App\Contracts\Lxy"));

        dd(app());
      
    }

   
}
