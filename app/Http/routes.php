<?php

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

Route::get('/', function () {
    return view('welcome');
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
    
    /*=====  End of excel  ======*/
    




Route::get('/dd', function () {
    return urldecode("begin++declare+++ierrCount+smallint%3b+++szDjBh+Varchar(20)%3b+++iRowCount+smallint+%3b+++iFlen+int+%3b++begin+++declare+++++iPDh+int+%3b+++++szRBH++char(6)+%3b+++++TempExp+Exception+%3b+++begin++delete+from+zb_zfpzdjbh%3b++select+nvl(Length(%27%27)%2c0)+into+iFlen+from+dual%3b++select+nvl(max(Substr(djbh%2c1%2c6))%2c%27_%27)+into+szDJBH++from+ZB_VIEW_ZFPZ_BB++Where++++++Gsdm%3d%27001%27++and+KJND%3d%272017%27++and+ZFFSDM%3d%2702%27++and+length(djbh)+%26gt%3b%3d+6%3b++if++szDJBH%3d%27_%27+then+select+%27000001%27+into+szDJBH+from+dual+%3b+else++++if+Length(rtrim(szDJBH))+%3d+nvl(Length(%27%27)%2c0)+%2b+6+++then+++++++select+Substr(szDJBH%2ciFlen%2b1%2c6)+into+szRBH+from+dual+%3b+++++select+to_char(to_number(szRBH)%2b1)+into+szRBH+from+dual+%3b++++++while+Length(LTrim(RTrim(szRBH)))%26lt%3b6+Loop++++++++++select+%270%27+%7c%7c+LTrim(RTrim(szRBH))+into+szRBH+from+dual+%3b++++++end+Loop+%3b+++select+Rtrim(%27%27+%7c%7c+szRBH)++into+szDJBH+from+dual+%3b++else++select+%27000001%27+into+szDJBH+from+dual+%3b+end+if+%3b++end+if%3b++select++max(to_number(pdh))+into+iPdh++from+ZB_ZFPZML_Y++where+gsdm%3d%27001%27++++and+kjnd%3d%272017%27+%3b++if+iPDh+is+null+then+select+0+into+iPDh+from+dual%3b+end+if%3b+++insert+into+ZB_ZFPZDJBH+values(szDJBH)%3b+insert+into+ZB_ZFPZML_Y(++++Gsdm%2cKjnd%2cPdqj%2cPdh%2czflb%2cDjbh%2cxjbz%2czphm%2cPdrq%2cDzkdm%2cYsdwdm%2c++++Fkrdm%2cFkr%2cFkryhbh%2cFkzh%2cFkrkhyh%2cFkyhhh%2cPJPCHM%2c++++Skrdm%2cSkr%2cSkryhbh%2cSkzh%2cSkrkhyh%2cSkyhhh%2c++++Zy%2cFJS%2clrr_ID%2clrr%2clr_rq%2cdwshr_id%2cdwshr%2cdwsh_rq%2ccxbz%2cbz2%2czt%2cdybz%2cZZPZ)+select+%27001%27%2c+%272017%27%2c+%27201704%27%2c++to_char(iPDh%2b1)%2c%270%27%2c++zfpzdjbh%2c+%270%27%2c+%27_%27%2c+%2720170419%27%2c+%2723%27%2c+%27901006001%27%2c+%2700030005%27%2c+%27%cb%ec%b4%a8%cf%d8%b2%c6%d5%fe%be%d6%c3%b6%bd%ad%cf%e7%b2%c6%d5%fe%cb%f9%a3%a8%c1%e3%d3%e0%b6%ee%d5%cb%bb%a7%a3%a9%27%2c+%2700030005%27%2c+%27178157750000004662%27%2c+%27%c5%a9%c9%cc%d0%d0%c3%b6%bd%ad%b7%d6%c0%ed%b4%a6%27%2c+%27012%27%2c+%27_%27%2c%2710000008%27%2c+%27%bd%ad%ce%f7%b9%fa%b9%e2%c9%cc%d2%b5%c1%ac%cb%f8%d3%d0%cf%de%d4%f0%c8%ce%b9%ab%cb%be%cb%ec%b4%a8%b5%ea%27%2c+%2710000008%27%2c+%2714-379201040001874%27%2c+%27%d6%d0%b9%fa%c5%a9%d2%b5%d2%f8%d0%d0%cb%ec%b4%a8%d6%a7%d0%d0%27%2c+%27_%27%2c+%272016%c4%ea%bc%c6%c9%fa%ca%c2%d2%b5%b7%d1%27%2c+0%2c899%2c%27%b8%b5%b0%ae%c7%ed%27%2c+to_char(sysdate%2c%27yyyymmdd%27)%2c+-1%2c%27%27%2c%27%27%2c+%270%27+%2c%270%27%2c%270%27%2c%270%27%2c%270%27+from+zb_zfpzdjbh+%3b+++insert+into+ZB_ZFPZNR_Y(++++Gsdm%2cKjnd%2cJHID%2cZBID%2cPdqj%2cPdh%2cpdxh%2czflb%2cLINKID%2czjxzdm%2cjsfsdm%2cYskmdm%2cJflxdm%2czffsdm%2czclxdm%2cysgllxdm%2czblydm%2cxmdm%2cSJWH%2cBJWH%2cYWLXDM%2cXMFLDM%2cKZZLDM1%2cKZZLDM2%2czbje%2cyyzbje%2ckyzbje%2cJE)+values+(+%27001%27%2c+%272017%27%2c+%27%27%2c+%27001.2017.0.1731%27%2c+%27201704%27%2c++to_char(iPDh%2b1)%2c+1%2c%270%27%2c-1%2c%2711%27%2c++%272%27%2c++%272100799%27%2c++%2739999%27%2c++%2702%27%2c++%270202%27%2c++%272%27%2c++%2782%27%2c++%273001%27%2c++%27_%27%2c+%27_%27%2c+%27_%27%2c+%27_%27%2c+%27_%27%2c+%27_%27%2c+950%2c++247%2c++703%2c++12.3)++%3b++Insert+Into+ZB_ZFPZNR_Y_MC(GSDM%2cKJND%2cZFLB%2cPDH%2cPDQJ%2cJSFSMC%2cNEWDYBZ%2cNEWZZPZ%2cNEWCXBZ%2cNEWPZLY%2cNEWZT%2cPDXH%2cDZKMC%2cXMMC%2cXMFLMC%2cYSDWMC%2cYSDWQC%2cYWLXMC%2cZFFSMC%2cMXZBWH%2cMXZBXH%2cZBLYMC%2cZJXZMC%2cYSKMMC%2cYSKMQC%2cJFLXMC%2cJFLXQC%2cZCLXMC%2cYSGLLXMC%2cKZZLMC1%2cKZZLMC2)+Values(%27001%27%2c%272017%27%2c%270%27%2cto_char(iPDh%2b1)%2c%27201704%27%2c%27%d7%aa%d5%cb%27%2c%27%ce%b4%b4%f2%d3%a1%27%2c%27%d6%bd%d6%ca%27%2c%27%d5%fd%b3%a3%c6%be%d6%a4%27%2c%27%d5%fd%b3%a3%27%2c%27%d5%fd%b3%a3%27%2c1%2c%27%d4%a4%cb%e3%b9%c9%cf%e7%d5%f2%d7%e9%27%2c%27%c8%cb%d4%b1%b9%ab%ce%f1%b7%d1%27%2c%27%27%2c%27%c3%b6%bd%ad%d5%f2%d0%d0%d5%fe%27%2c%27%c3%b6%bd%ad%d5%f2%d0%d0%d5%fe%27%2c%27%27%2c%27%ca%da%c8%a8%d6%a7%b8%b6%27%2c%27%b9%ab%b9%b2%ce%c4%ba%c5%27%2c222%2c%27%bc%af%d6%d0%d6%a7%b8%b616%c4%ea%bd%e1%d3%e0%27%2c%27%b9%ab%b9%b2%b2%c6%d5%fe%d4%a4%cb%e3%d7%ca%bd%f0%27%2c%27%c6%e4%cb%fb%bc%c6%bb%ae%c9%fa%d3%fd%ca%c2%ce%f1%d6%a7%b3%f6%27%2c%27%d2%bd%c1%c6%ce%c0%c9%fa%d3%eb%bc%c6%bb%ae%c9%fa%d3%fd%d6%a7%b3%f6-%bc%c6%bb%ae%c9%fa%d3%fd%ca%c2%ce%f1-%c6%e4%cb%fb%bc%c6%bb%ae%c9%fa%d3%fd%ca%c2%ce%f1%d6%a7%b3%f6%27%2c%27%c6%e4%cb%fb%d6%a7%b3%f6%27%2c%27%c6%e4%cb%fb%d6%a7%b3%f6-%c6%e4%cb%fb%d6%a7%b3%f6%27%2c%27%ca%da%c8%a8%d6%a7%b8%b6%27%2c%27%cf%e7%d5%f2%d6%a7%b3%f6%27%2c%27%27%2c%27%27)%3b++++++commit%3b+++++select+iPDh%2b1+into+ierrCount+from+dual+%3b++++Exception+++++when+others+then+++++++RollBack%3b+++++++select+0+into+ierrCount+from+dual+%3b+++end+%3b+++Open+%3apRecCur+for+++++select+ierrCount+RES%2cszDJBH+DJBH+from+dual%3b++end%3b+end%3b+");




});


// Route::get('/','ArticleController@list');

// Route::resource('article','ArticleController');

