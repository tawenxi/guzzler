<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use GuzzleHttp\Psr7\Request;
use App\Guzzle;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;



class GuzzleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {	
			header("Content-Type: text/html;charset=utf-8");
			$arr = file(dirname(__FILE__)."//payee.txt");
			array_walk($arr, function(&$item1, $key) {
				$item1 = preg_split('/[\s,]+/', $item1);
			});
			//var_dump($arr);
			
			foreach ($arr as $key => $value) 
			{
				$guzz=new Guzzle($value);
				$guzz->makerequest();
			}

			
			
			
		
    }
	

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        //
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        //
    }

   
    public function destroy($id)
    {
        //
    }
}
