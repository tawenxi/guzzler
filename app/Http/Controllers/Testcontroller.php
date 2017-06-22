<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Lxy;
use App\payout;
use App\Salary;
use App\Member;
use App\Model\Post;

class TestController extends Controller
{
  public function edit($id)
  {
  	$post = Post::findOrFail($id);
  	\Auth::loginUsingId(39);
  	return view('Posts.edit', compact('post'));
  }



  public  function blade()
  {
     $guzzledbs = \App\Guzzledb::orderBy('ZJXZMC',"Asc")
                ->orderBy("KYJHJE","desc")
                ->get();
     \Excel::create('New file', function($excel) use($guzzledbs) {
     $excel->sheet('New sheet', function($sheet) use($guzzledbs){
     $sheet->loadView('guzzle.index',array('guzzledbs' => $guzzledbs));
    })->export('xls');;
    });

  }

   
}
