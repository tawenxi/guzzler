<?php

namespace App\Http\Controllers;

use DB;
use Exception;
use App\Model\Post;
use App\Model\Income;
use App\Model\Account;

class TestController extends Controller
{
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        \Auth::loginUsingId(39);

        return view('Posts.edit', compact('post'));
    }

    public function blade()
    {
        $guzzledbs = \App\Model\Guzzledb::orderBy('ZJXZMC', 'Asc')
                ->orderBy('KYJHJE', 'desc')
                ->get();
        \Excel::create('New file', function ($excel) use ($guzzledbs) {
            $excel->sheet('New sheet', function ($sheet) use ($guzzledbs) {
                $sheet->loadView('guzzle.index', ['guzzledbs' => $guzzledbs]);
            })->export('xls');
        });
    }

    public function exception()
    {
        throw new Exception('您不是该文sss章的作者，不能修改', 1);
        echo '111111111111';
    }

    public function test()
    {
        $account = DB::table('accounts')->where('id', '100')->value('name');
        dump($account);
        $orm = Account::where('id', '100')->value('name');
        $orm = collect(DB::table('accounts')->get())->pluck('id');
        $orm = DB::table('accounts')->lists('id');
        $orm = Account::lists('id', 'name');  //"1001@库存现金" => 1,name当做key
        $orm = Account::max('id');
        $orm = Account::select('name', 'id as i')->get()->toArray(); //  更改id字段为i

        $orm = Account::select('name')->addSelect('id')->get()->toarray();
        $orm = Account::where('id', '>', '100')->orWhere('id', '1')->get()->toarray();
        $orm = Account::where('id', '>', '100')->orWhere('id', '1')->lists('id');
        $orm = Account::whereBetween('id', [10, 20])
                     ->whereNotBetween('id', [1, 15])
                     ->whereIn('id', [1, 2, 3, 15, 16, 17])
                     ->whereNotIn('id', [1, 2, 3])
                     ->lists('id');
        $orm = Account::whereNotNull('id')->lists('id'); //->whereNull('updated_at')
        $orm = Account::whereBetween('id', [100, 105])->orWhere(function ($query) {
            $query->where('id', '>', 1)
                      ->where('id', '<', 10);
        })->orderBy('name', 'desc')->lists('id');

        $orm = Income::groupBy('xingzhi')->get();

        $orm = DB::table('incomes')
                ->groupBy('xingzhi')
                ->having('id', '>', 3)
                ->get();

        // $orm = Account::get();
        $a =
<<<'EOF'
<?xml version="1.0" encoding="GB2312"?><R9PACKET version="1"><SESSIONID></SESSIONID><R9FUNCTION><NAME>AS_DataRequest</NAME><PARAMS><PARAM><NAME>ProviderName</NAME><DATA format="text">DataSetProviderData</DATA></PARAM><PARAM><NAME>Data</NAME><DATA format="text">Select to_char(rownum) XH,a.*,SUBSTR(a.DJSHBZ,4,1) PZZT, decode(SUBSTR(a.jkzt,2,1),'1','已确认','0','未确认') YHQR From ZB_VIEW_ZFPZ A where GSDM='001' and KJND='2017' and pdrq&gt;='20170101' and pdrq&lt;=to_char(sysdate,'yyyymmdd')  and PDH= '21299'  and (YSDWDM IN ('901006','901006000','901006001','901006002','901006003','901006004','901006005','901006006','901006007','901006008','901006009','901006010','901006011','901006012','901006013','901006099') or YSDWDM='_')   and to_number(pdh) between '1'  and  '999999'  and (ZFFSDM='02') order by PDQJ,PDH,PDXH</DATA></PARAM></PARAMS></R9FUNCTION></R9PACKET>
EOF;

        $ma = urldecode('<?xml version="1.0" encoding="GB2312"?><R9PACKET version="1"><SESSIONID></SESSIONID><R9FUNCTION><NAME>AS_DataRequest</NAME><PARAMS><PARAM><NAME>ProviderName</NAME><DATA format="text">DataSetProviderData</DATA></PARAM><PARAM><NAME>Data</NAME><DATA format="text">Select%20to_char%28rownum%29%20XH%2Ca%2E%2A%2CSUBSTR%28a%2EDJSHBZ%2C4%2C1%29%20PZZT%2C%20decode%28SUBSTR%28a%2Ejkzt%2C2%2C1%29%2C%271%27%2C%27%D2%D1%C8%B7%C8%CF%27%2C%270%27%2C%27%CE%B4%C8%B7%C8%CF%27%29%20YHQR%20From%20ZB_VIEW_ZFPZ%20A%20where%20GSDM=%27001%27%20and%20KJND=%272017%27%20and%20pdrq%26gt;=%2720170101%27%20and%20pdrq%26lt;=%2720170821%27%20%20and%20%28YSDWDM%20IN%20%28%27901006%27%2C%27901006000%27%2C%27901006001%27%2C%27901006002%27%2C%27901006003%27%2C%27901006004%27%2C%27901006005%27%2C%27901006006%27%2C%27901006007%27%2C%27901006008%27%2C%27901006009%27%2C%27901006010%27%2C%27901006011%27%2C%27901006012%27%2C%27901006013%27%2C%27901006099%27%29%20or%20YSDWDM=%27_%27%29%20%20%20and%20to_number%28pdh%29%20between%20%271%27%20%20and%20%20%27999999%27%20%20%20order%20by%20PDQJ%2CPDH%2CPDXH</DATA></PARAM></PARAMS></R9FUNCTION></R9PACKET>');

        $delete = '<?xml version="1.0" encoding="GB2312"?><R9PACKET version="1"><SESSIONID></SESSIONID><R9FUNCTION><NAME>AS_DataRequest</NAME><PARAMS><PARAM><NAME>ProviderName</NAME><DATA format="text">DataSetProviderData</DATA></PARAM><PARAM><NAME>Data</NAME><DATA format="text">begin%20declare%20%20iRowCount%20smallint;%20%20iResult%20%20%20smallint;%20begin%20%20select%20count%28%2A%29%20into%20iRowCount%20from%20ZB_view_zfpz%20%20%20where%20Gsdm=%27001%27%20%20%20%20and%20kjnd=%272017%27%20%20%20%20and%20PDQJ=%27201708%27%20%20%20%20and%20PDH=37035%20%20and%20DWSHR_ID=%2D1;%20if%20iRowCount%26gt;0%20then%20%20%20%20delete%20from%20%20ZB_zfpzml_y%20%20%20%20%20where%20Gsdm=%27001%27%20%20%20%20%20%20and%20kjnd=%272017%27%20%20%20%20%20%20and%20PDQJ=%27201708%27%20%20%20%20%20%20and%20PDH=37035;%20%20%20%20delete%20from%20%20ZB_zfpznr_y%20%20%20%20%20where%20Gsdm=%27001%27%20%20%20%20%20%20and%20kjnd=%272017%27%20%20%20%20%20%20and%20PDQJ=%27201708%27%20%20%20%20%20%20and%20PDH=37035;%20%20%20%20delete%20from%20%20ZB_zfpznr_y_MC%20%20%20%20%20where%20Gsdm=%27001%27%20%20%20%20%20%20and%20kjnd=%272017%27%20%20%20%20%20%20and%20PDQJ=%27201708%27%20%20%20%20%20%20and%20PDH=37035;%20%20%20%20delete%20from%20%20PUBAUDITLOG%20%20%20%20%20%20%20where%20Gsdm=%27001%27%20%20%20%20%20%20%20%20%20%20%20and%20KJND=%272017%27%20%20%20%20%20%20%20%20%20%20%20and%20BIZNAME=%27%D6%A7%B8%B6%C6%BE%D6%A4%27%20%20%20%20%20%20%20%20%20%20%20and%20BILLID=%27001%2E2017%2E0%2E201708%2E37035%27;%20%20%20%20update%20ZB_ZFSQDNR%20set%20%20%20%20%20%20stamp=stamp%2B1%2C%20%20%20%20%20SHJBR_ID=%27%2D1%27%2C%20%20%20%20%20SHJBR=%27_%27%2C%20%20%20%20%20SHJB_RQ=%27_%27%2C%20%20%20%20%20SHFZR_ID=%27%2D1%27%2C%20%20%20%20%20SHFZR=%27_%27%2C%20%20%20%20%20SHFZ_RQ=%27_%27%2C%20%20%20%20%20PFJBR_ID=%27%2D1%27%2C%20%20%20%20%20PFJBR=%27_%27%2C%20%20%20%20%20PFJB_RQ=%27_%27%2C%20%20%20%20%20PFFZR_ID=%27%2D1%27%2C%20%20%20%20%20PFFZR=%27_%27%2C%20%20%20%20%20PFFZ_RQ=%27_%27%2C%20%20%20%20%20SPBH=%27%27%2C%20%20%20%20%20SHJE=0%2C%20%20%20%20%20PFJE=0%2C%20%20%20%20%20ZFSCBZ=%270%27%2C%20%20%20%20%20%20ZFLB=%270%27%2C%20%20%20%20%20%20ZFPZPDQJ=%27%27%2C%20%20%20%20%20ZFPZPDH=%20null%20%20%20where%20%20GSDM=%27001%27%20%20%20%20%20%20%20and%20KJND=%272017%27%20%20%20%20%20%20%20and%20ZFPZPDQJ=%27201708%27%20and%20ZFPZPDH=37035;%20%20%20%20commit;%20%20%20%20select%200%20into%20iResult%20from%20dual%20;%20%20else%20%20%20%20rollback;%20%20%20%20Select%201%20into%20iResult%20from%20dual%20;%20%20end%20if;%20%20open%20:pRecCur%20for%20%20%20%20select%20iResult%20RES%20from%20dual%20;%20end;%20end;%20</DATA></PARAM></PARAMS></R9FUNCTION></R9PACKET>';

        // dump(urlencode(iconv('UTF-8','GB2312', urldecode($a))));

        dump(iconv('GB2312', 'UTF-8', urldecode($delete)));
        //dd($person->getpersondata('35711')) ;
    }
}
