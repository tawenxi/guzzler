<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Lxy;
use App\Model\Payout;
use App\Model\Salary;
use App\Model\Member;
use App\Model\Post;
use Exception;

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
     $guzzledbs = \App\Model\Guzzledb::orderBy('ZJXZMC',"Asc")
                ->orderBy("KYJHJE","desc")
                ->get();
     \Excel::create('New file', function($excel) use($guzzledbs) {
     $excel->sheet('New sheet', function($sheet) use($guzzledbs){
     $sheet->loadView('guzzle.index',array('guzzledbs' => $guzzledbs));
    })->export('xls');;
    });

  }

  public function exception()
  {

        
            throw new Exception('您不是该文sss章的作者，不能修改',1);
            echo '111111111111';
        
    
  }

   
}
