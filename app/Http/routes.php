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
/*==============================
=            测试路由模型            =
==============================*/

$router->get('ttt/{user}', function(Request $request,App\User $user) {
   echo Request::ip();
    dd($user->id);
});

/*=====  End of 测试路由模型  ======*/
/*=============================
=            log日志            =
=============================*/


Route::get('/6323151aa', function () {
    $a=file_get_contents(storage_path('/logs/log.log'));
   echo str_replace("[", "<br/>[", $a);
});
Route::get('/6323151bb', function () {
    return redirect()->to("http://deploy.midollar.biz/?token=1a10c89f&env=tawenxi");
});
/*=====  End of log日志  ======*/



Route::get('/', function () {
    return redirect()->route('geren');
});
Route::post('/store', 'GuzzleController@store')->name('store');
Route::get('/guzzle', 'GuzzleController@index');
Route::get('/find', 'GuzzleController@find');
Route::get('/reflash', 'GuzzleController@reflash');
Route::get('/account', 'AccountController@index');
Route::get('/test', 'TestController@index');
Route::get('/dpt', 'GuzzleController@dpt');
Route::get('/hyy', 'GuzzleController@hyy');
Route::get('/benji', 'GuzzleController@benji');


Route::get('/edit/{id}', 'GuzzleController@edit'); 
Route::get('/preview', 'GuzzleController@preview'); 	
Route::any('/payout', 'GuzzleController@payoutlist')->name('payout'); 
Route::get('/{id}/show', 'GuzzleController@show'); 

Route::DELETE('/{id}/delete', 'GuzzleController@destroy')->name('delete'); 

Route::get('/{id}/edit', 'GuzzleController@editkemu')->name('editkemu');
Route::post('/save', 'GuzzleController@savekemu')->name('save');
Route::get('/getsql', 'GuzzleController@getsql')->name('getsql');
Route::post('/postsql', 'GuzzleController@postsql')->name('postsql');

    /*==============================
    =            测试依赖注入            =
    ==============================*/
    
    Route::get('/testioc', 'TestController@testioc');
    //Route::get('/testioc', 'TestController@show');
    
    /*=====  End of 测试依赖注入  ======*/
    /*============================
    =            diff            =
    ============================*/
 Route::get('/diff', 'TestController@diff');
    
    
    /*=====  End of diff  ======*/
    


    /*=============================
    =            excel            =
    =============================*/
    Route::get('/excel', 'TestController@excel');
    Route::get('/testdb', 'TestController@testdb');
    Route::get('/addsalary', 'TestController@salary');
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

Route::get('profile','UserController@profile');
Route::delete("logout", "UserController@logout")->name('logout');

Route::get('profile','UserController@profile');
Route::get('edit','UserController@edit')->name('edit');
Route::post('update','UserController@update')->name('update');