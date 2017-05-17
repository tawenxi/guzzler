<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Acc\Acc;
use App;

class AccountController extends Controller
{
    //
	public function index(){		

		
        $searchobject=App::make('acc');
        $col_zhaiyao=$searchobject->tokemu();
        $kemu=$searchobject->getAcc($col_zhaiyao);   
        
        return view("account",compact("kemu"));

	}


	
































}
