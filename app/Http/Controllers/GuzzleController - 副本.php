<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    {	$b='begin%20%20declare%20%20%20ierrCount%20smallint;%20%20%20szDjBh%20Varchar%2820%29;%20%20%20iRowCount%20smallint%20;%20%20%20iFlen%20int%20;%20%20begin%20%20%20declare%20%20%20%20%20iPDh%20int%20;%20%20%20%20%20szRBH%20%20char%286%29%20;%20%20%20%20%20TempExp%20Exception%20;%20%20%20begin%20%20delete%20from%20zb_zfpzdjbh;%20%20select%20nvl%28Length%28%27%27%29%2C0%29%20into%20iFlen%20from%20dual;%20%20select%20nvl%28max%28Substr%28djbh%2C1%2C6%29%29%2C%27_%27%29%20into%20szDJBH%20%20from%20ZB_VIEW_ZFPZ_BB%20%20Where%20%20%20%20%20%20Gsdm=%27001%27%20%20and%20KJND=%272017%27%20%20and%20ZFFSDM=%2702%27%20%20and%20length%28djbh%29%20%26gt;=%206;%20%20if%20%20szDJBH=%27_%27%20then%20select%20%27000001%27%20into%20szDJBH%20from%20dual%20;%20else%20%20%20%20if%20Length%28rtrim%28szDJBH%29%29%20=%20nvl%28Length%28%27%27%29%2C0%29%20%2B%206%20%20%20then%20%20%20%20%20%20%20select%20Substr%28szDJBH%2CiFlen%2B1%2C6%29%20into%20szRBH%20from%20dual%20;%20%20%20%20%20select%20to_char%28to_number%28szRBH%29%2B1%29%20into%20szRBH%20from%20dual%20;%20%20%20%20%20%20while%20Length%28LTrim%28RTrim%28szRBH%29%29%29%26lt;6%20Loop%20%20%20%20%20%20%20%20%20%20select%20%270%27%20||%20LTrim%28RTrim%28szRBH%29%29%20into%20szRBH%20from%20dual%20;%20%20%20%20%20%20end%20Loop%20;%20%20%20select%20Rtrim%28%27%27%20||%20szRBH%29%20%20into%20szDJBH%20from%20dual%20;%20%20else%20%20select%20%27000001%27%20into%20szDJBH%20from%20dual%20;%20end%20if%20;%20%20end%20if;%20%20select%20%20max%28to_number%28pdh%29%29%20into%20iPdh%20%20from%20ZB_ZFPZML_Y%20%20where%20gsdm=%27001%27%20%20%20%20and%20kjnd=%272017%27%20;%20%20if%20iPDh%20is%20null%20then%20select%200%20into%20iPDh%20from%20dual;%20end%20if;%20%20%20insert%20into%20ZB_ZFPZDJBH%20values%28szDJBH%29;%20insert%20into%20ZB_ZFPZML_Y%28%20%20%20%20Gsdm%2CKjnd%2CPdqj%2CPdh%2Czflb%2CDjbh%2Cxjbz%2Czphm%2CPdrq%2CDzkdm%2CYsdwdm%2C%20%20%20%20Fkrdm%2CFkr%2CFkryhbh%2CFkzh%2CFkrkhyh%2CFkyhhh%2CPJPCHM%2C%20%20%20%20Skrdm%2CSkr%2CSkryhbh%2CSkzh%2CSkrkhyh%2CSkyhhh%2C%20%20%20%20Zy%2CFJS%2Clrr_ID%2Clrr%2Clr_rq%2Cdwshr_id%2Cdwshr%2Cdwsh_rq%2Ccxbz%2Cbz2%2Czt%2Cdybz%2CZZPZ%29%20select%20%27001%27%2C%20%272017%27%2C%20%27201704%27%2C%20%20to_char%28iPDh%2B1%29%2C%270%27%2C%20%20zfpzdjbh%2C%20%270%27%2C%20%27_%27%2C%20%2720170421%27%2C%20%2784%27%2C%20%27901006001%27%2C%20%2700030005%27%2C%20%27%CB%EC%B4%A8%CF%D8%B2%C6%D5%FE%BE%D6%C3%B6%BD%AD%CF%E7%B2%C6%D5%FE%CB%F9%A3%A8%C1%E3%D3%E0%B6%EE%D5%CB%BB%A7%A3%A9%27%2C%20%2700030005%27%2C%20%27178157750000004662%27%2C%20%27%C5%A9%C9%CC%D0%D0%C3%B6%BD%AD%B7%D6%C0%ED%B4%A6%27%2C%20%27012%27%2C%20%27_%27%2C%2799900114%27%2C%20%27%BC%AA%B0%B2%CB%EC%B4%A8%CF%D8%B2%C6%D5%FE%BE%D6%27%2C%20%2799900114%27%2C%20%27190207313396%27%2C%20%27%D6%D0%D0%D0%CB%EC%B4%A8%D6%A7%D0%D0%27%2C%20%27005%27%2C%20%272016%C4%EA%BC%C6%C9%FA%CA%C2%D2%B5%B7%D1%27%2C%200%2C899%2C%27%B8%B5%B0%AE%C7%ED%27%2C%20to_char%28sysdate%2C%27yyyymmdd%27%29%2C%20%2D1%2C%27%27%2C%27%27%2C%20%270%27%20%2C%270%27%2C%270%27%2C%270%27%2C%270%27%20from%20zb_zfpzdjbh%20;%20%20%20insert%20into%20ZB_ZFPZNR_Y%28%20%20%20%20Gsdm%2CKjnd%2CJHID%2CZBID%2CPdqj%2CPdh%2Cpdxh%2Czflb%2CLINKID%2Czjxzdm%2Cjsfsdm%2CYskmdm%2CJflxdm%2Czffsdm%2Czclxdm%2Cysgllxdm%2Czblydm%2Cxmdm%2CSJWH%2CBJWH%2CYWLXDM%2CXMFLDM%2CKZZLDM1%2CKZZLDM2%2Czbje%2Cyyzbje%2Ckyzbje%2CJE%29%20values%20%28%20%27001%27%2C%20%272017%27%2C%20%27%27%2C%20%27001%2E2017%2E0%2E1731%27%2C%20%27201704%27%2C%20%20to_char%28iPDh%2B1%29%2C%201%2C%270%27%2C%2D1%2C%2711%27%2C%20%20%272%27%2C%20%20%272100799%27%2C%20%20%2739999%27%2C%20%20%2702%27%2C%20%20%270202%27%2C%20%20%272%27%2C%20%20%2782%27%2C%20%20%273001%27%2C%20%20%27_%27%2C%20%27_%27%2C%20%27_%27%2C%20%27_%27%2C%20%27_%27%2C%20%27_%27%2C%20950%2C%20%200%2C%20%20950%2C%20%201%29%20%20;%20%20Insert%20Into%20ZB_ZFPZNR_Y_MC%28GSDM%2CKJND%2CZFLB%2CPDH%2CPDQJ%2CJSFSMC%2CNEWDYBZ%2CNEWZZPZ%2CNEWCXBZ%2CNEWPZLY%2CNEWZT%2CPDXH%2CDZKMC%2CXMMC%2CXMFLMC%2CYSDWMC%2CYSDWQC%2CYWLXMC%2CZFFSMC%2CMXZBWH%2CMXZBXH%2CZBLYMC%2CZJXZMC%2CYSKMMC%2CYSKMQC%2CJFLXMC%2CJFLXQC%2CZCLXMC%2CYSGLLXMC%2CKZZLMC1%2CKZZLMC2%29%20Values%28%27001%27%2C%272017%27%2C%270%27%2Cto_char%28iPDh%2B1%29%2C%27201704%27%2C%27%D7%AA%D5%CB%27%2C%27%CE%B4%B4%F2%D3%A1%27%2C%27%D6%BD%D6%CA%27%2C%27%D5%FD%B3%A3%C6%BE%D6%A4%27%2C%27%D5%FD%B3%A3%27%2C%27%D5%FD%B3%A3%27%2C1%2C%27%D4%A4%CB%E3%B9%C9%CF%E7%D5%F2%D7%E9%27%2C%27%C8%CB%D4%B1%B9%AB%CE%F1%B7%D1%27%2C%27%27%2C%27%C3%B6%BD%AD%D5%F2%D0%D0%D5%FE%27%2C%27%C3%B6%BD%AD%D5%F2%D0%D0%D5%FE%27%2C%27%27%2C%27%CA%DA%C8%A8%D6%A7%B8%B6%27%2C%27%B9%AB%B9%B2%CE%C4%BA%C5%27%2C222%2C%27%BC%AF%D6%D0%D6%A7%B8%B616%C4%EA%BD%E1%D3%E0%27%2C%27%B9%AB%B9%B2%B2%C6%D5%FE%D4%A4%CB%E3%D7%CA%BD%F0%27%2C%27%C6%E4%CB%FB%BC%C6%BB%AE%C9%FA%D3%FD%CA%C2%CE%F1%D6%A7%B3%F6%27%2C%27%D2%BD%C1%C6%CE%C0%C9%FA%D3%EB%BC%C6%BB%AE%C9%FA%D3%FD%D6%A7%B3%F6%2D%BC%C6%BB%AE%C9%FA%D3%FD%CA%C2%CE%F1%2D%C6%E4%CB%FB%BC%C6%BB%AE%C9%FA%D3%FD%CA%C2%CE%F1%D6%A7%B3%F6%27%2C%27%C6%E4%CB%FB%D6%A7%B3%F6%27%2C%27%C6%E4%CB%FB%D6%A7%B3%F6%2D%C6%E4%CB%FB%D6%A7%B3%F6%27%2C%27%CA%DA%C8%A8%D6%A7%B8%B6%27%2C%27%CF%E7%D5%F2%D6%A7%B3%F6%27%2C%27%27%2C%27%27%29;%20%20%20%20%20%20commit;%20%20%20%20%20select%20iPDh%2B1%20into%20ierrCount%20from%20dual%20;%20%20%20%20Exception%20%20%20%20%20when%20others%20then%20%20%20%20%20%20%20RollBack;%20%20%20%20%20%20%20select%200%20into%20ierrCount%20from%20dual%20;%20%20%20end%20;%20%20%20Open%20:pRecCur%20for%20%20%20%20%20select%20ierrCount%20RES%2CszDJBH%20DJBH%20from%20dual;%20%20end;%20end;%20';
	
		$a= '<?xml version="1.0" encoding="GB2312"?><R9PACKET version="1"><SESSIONID></SESSIONID><R9FUNCTION><NAME>AS_DataRequest</NAME><PARAMS><PARAM><NAME>ProviderName</NAME><DATA format="text">DataSetProviderData</DATA></PARAM><PARAM><NAME>Data</NAME><DATA format="text">'.urldecode($b).'</DATA></PARAM></PARAMS></R9FUNCTION></R9PACKET>';
		
	

		$client = new Client();
		$response = $client->request('POST', 'http://10.108.8.1:7007/Proxy', 
		[
			'form_params' => 
				[
					'cVer' => '9.8.0',
					'dp'=>$a,
				],
		
		]);
			//$code = $response->getStatusCode(); // 200
			$body = $response->getBody();
		//dd($code);
		echo $body;
		
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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
