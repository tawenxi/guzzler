<?php
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('decompose','\Lubusin\Decomposer\Controllers\DecomposerController@index');
/*=============================
=            log日志            =
=============================*/


Route::get('/6323151aa', function () {
header("Content-type: text/html; charset=utf-8"); 
    if (\Auth::check()&&\Auth::user()->id==39) {
           $a=file_get_contents(storage_path('/logs/logins.log'));
   dd(str_replace("[", "<br/>[", $a)) ;
    }else{
        return redirect()->to("/geren");
    }

});
Route::get('/6323151bb', function () {
     if (\Auth::check()&&\Auth::user()->id==39) {
    return redirect()->to("http://deploy.midollar.biz/?token=1a10c89f&env=tawenxi");
}else{
    return redirect()->to("/geren");
    }
});
/*=====  End of log日志  ======*/



Route::get('/', function () {
    return redirect()->route('geren');
});
Route::post('/store', 'GuzzleController@store')->name('store');
Route::get('/guzzle', 'GuzzleController@index');
Route::get('/find', 'GuzzleController@find');//显示可用授权指标
Route::get('/reflash', 'GuzzleController@reflash');
//Route::get('/account', 'AccountController@index');
Route::get('/dpt', 'GuzzleController@dpt');
Route::get('/hyy', 'GuzzleController@hyy');
Route::get('/edit/{id}', 'GuzzleController@edit')->name('guzzle.edit'); 
Route::get('/preview/{option?}', 'GuzzleController@preview'); 	
Route::any('/payout', 'GuzzleController@payoutlist')->name('payout'); 
Route::get('/{id}/show', 'GuzzleController@show'); 
Route::DELETE('/{id}/delete', 'GuzzleController@destroy')->name('delete');
Route::get('/{id}/edit', 'GuzzleController@editkemu')->name('editkemu');
Route::post('/save', 'GuzzleController@savekemu')->name('save');
Route::get('/getsql', 'GuzzleController@getsql')->name('getsql');
Route::post('/postsql', 'GuzzleController@postsql')->name('postsql');
Route::get('exportaccount', 'GuzzleController@export_account');

    /*=============================
    =            excel            =
    =============================*/
    Route::get('/salary/{date?}/{jj?}', 'SalaryController@index')->name('salary');
    Route::get('/addmember', 'TestController@member');
    Route::get('/bumen/{date?}/{jj?}', 'SalaryController@bumen')->name('bumen');
    Route::get('/geren/{id?}/{jj?}', 'SalaryController@geren')->name('geren');
    Route::get('/byear/{year?}/{jj?}', 'SalaryController@byear')->name('byear');
    Route::get('/myear/{year?}/{jj?}', 'SalaryController@myear')->name('myear');
    Route::get('/phb/{year?}/{jj?}', 'SalaryController@phb')->name('phb');
    
    /*=====  End of excel  ======*/

// 认证路由...
Route::get('auth/login', 'Auth\AuthController@getLogin')->name('loginpage');
Route::post('auth/login', 'Auth\AuthController@postLogin')->name('login');
Route::get('auth/logout', 'Auth\AuthController@getLogout');
// 注册路由...不开放注册
// Route::get('auth/register', 'Auth\AuthController@getRegister');
// Route::post('auth/register', 'Auth\AuthController@postRegister')->name('users.store');
Route::delete("logout", "UserController@logout")->name('logout');
Route::get('edit','UserController@edit')->name('edit');
Route::post('update','UserController@update')->name('update');
Route::get('profile','UserController@profile');




//======================

/*==============================
=            收入支出体系            =
==============================*/
Route::resource('income', 'IncomeController');
Route::get('incomes/{fp?}',"IncomeController@indexs");
Route::resource('cost', 'CostController');
Route::any('/costs','CostController@indexs')->name('cost.indexs');


/*=====  End of 收入支出体系  ======*/










/*==============================
=            测试路由模型            =
==============================*/

$router->get('ttt/{user}', function(Request $request,App\Model\User $user) {
   echo Request::ip();
    dd($user->id);
});

/*=====  End of 测试路由模型  ======*/

    /*============================
    =            diff            =
    ============================*/
 Route::get('/diff', 'TestController@diff');
    
    
    /*=====  End of diff  ======*/
/*========================================
=            Permission::with('roles')->get()            =
========================================*/
 Route::get('/tte', function(){
    return $a=App\Model\Permission::with('roles')->get(); 
 });

 Route::get('/ttq', function(){
    return $a=App\Model\Role::with('permissions')->get(); 
 });
/*=====  End of Permission::with('roles')->get()  ======*/
 Route::get('/aa', function(){
    $a=2;
     dd(!!$a); //!!把一个变量转化成BOOLEAN
 });

 Route::get('/e/{id?}','TestController@edit');

Route::get('/blade','TestController@blade');


/*===============================
=            测试excel            =
===============================*/

Route::get('excel', function() {

    Global $exce;
        $exce = 'cost';
        //dd($GLOBALS);
        $import =app()->make("\App\Model\SalaryListImport");
        $ziduan=[
        'date',
        'payee',
        "payeeaccount",
        'payeebanker',
        'amount',
        'zhaiyao',
        'income_id',
        'kemu',
        'beizhu',
        ];//9个字段
       $res = $import->setDateColumns(array(
            'created_at',
            'updated_at',
            'date'
        ))->first()->keys()->toArray();
       dd($import->get());

    
});

Route::get('excelmodel', function() {
    $excel = new \App\Model\Excel('cost');
    $title = $excel->insertSql();
    //dd($title);
});

Route::get('skip', function() {
    $excel = new \App\Model\Excel('cost');
    $skip = $excel->getSkipNum();
    dd($skip);
});
Route::get('flash', function() {
   //flash('Welcome Aboard!','danger');
   echo "2";
});

/*=====  End of 测试excel  ======*/
/*=====  End of 测试excel  ======*/

/*=================================
=            批量注入excel            =
=================================*/
 //   $sheets->noHeading()->each(function($sheet) use
//Import a folder and multiple sheets
   Route::get('batchimport', function() 
   {
        $excel=array();
        \Excel::batch(storage_path('/excel/w'), function($sheets, $file) use (&$excel)
            {
                $sheets->each(function($sheet) use (&$excel)
                { 
                    if (get_class($sheet) === 'Maatwebsite\Excel\Collections\CellCollection') {
                        $excel[]=$sheet;
                    } elseif (get_class($sheet) === 'Maatwebsite\Excel\Collections\RowCollection')
                    {
                        $sheet->each(function($row)use (&$excel){       
                        $excel[]=$row;
                    });
                    } else {
                        dd(__File__.'---'.__LINE__);
                    }
                });

            });  
        $excel2 = collect($excel);
            //dd($excel2);调试
        Excel::create('Filename', function($excel) use (&$excel2)
        {
            $excel->sheet('Sheetname', function($sheet)use (&$excel2) 
            {
            $sheet -> with($excel2);
            });
        })->export('xls');
   });

/*=====  End of 测试excel  ======*/

/*=============================================
=            Section comment block            =
=============================================*/

Route::get('/exception', ['as'=>'exception','uses'=>'TestController@exception']);

/*=====  End of Section comment block  ======*/


Route::get('/yj', 'YaojiangController@account');


/*==============================
=            查询会计科目            =
==============================*/

Route::get('/searchacc','SearchController@account');
Route::post('/api/account','SearchController@store');
Route::post('/api/addaccount','SearchController@addstore');
Route::post('/api/payout','SearchController@payout');
Route::post('/api/payout_with_date','SearchController@payout_with_date');
Route::get('/modifyacc','SearchController@modifyacc');
/*=====  End of 查询会计科目  ======*/


/*=========================================
=            zhibiaoController            =
=========================================*/

Route::get('/zhibiao', 'ZhibiaoController@index');
Route::get('/zbdetail', 'ZhibiaoController@zb_detail');
Route::get('/showzbdetail/{zbid}', 'ZhibiaoController@show');
/*=====  End of zhibiaoController  ======*/

/*==============================
=            Ardent            =
==============================*/
Route::get('/ardent', 'ArdentController@index');


/*=====  End of Ardent  ======*/

