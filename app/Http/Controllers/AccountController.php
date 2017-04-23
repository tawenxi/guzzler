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

		echo 'hello';
		
		$search=collect([
					"办公"=>"500130201@经费支出-商品和服务支出-办公费",
					"打印"=>"500130202@经费支出-商品和服务支出-印刷费",
					"手续费"=>"500130204@经费支出-商品和服务支出-手续费",
					"水费"=>"500130205@经费支出-商品和服务支出-水费",
					"电费"=>"500130206@经费支出-商品和服务支出-电费",
					"邮寄"=>"500130207@经费支出-商品和服务支出-邮电费",
					"差旅"=>"500130211@经费支出-商品和服务支出-差旅费",
					"修理"=>"500130213@经费支出-商品和服务支出-维修(护)费",
					"接待"=>"500130217@经费支出-商品和服务支出-公务接待费",
					"修理"=>"500130231@经费支出-商品和服务支出-公务用车运行维护费",
					"车辆"=>"500130231@经费支出-商品和服务支出-公务用车运行维护费",
					"赞助"=>"500130245@经费支出-商品和服务支出-赞助捐赠支出",
					"报刊"=>"500130253@经费支出-商品和服务支出-报刊杂志费",
					"伙食"=>"500130280@经费支出-商品和服务支出-食堂支出",
								"环境"=>"500130283@经费支出-商品和服务支出-环境卫生支出",
					"环卫"=>"500130283@经费支出-商品和服务支出-环境卫生支出",
					"印刷"=>"500130202@经费支出-商品和服务支出-印刷费",
					"快递"=>"500130207@经费支出-商品和服务支出-邮电费",
					"取暖费"=>"500130208@经费支出-商品和服务支出-取暖费",
					"出差"=>"500130211@经费支出-商品和服务支出-差旅费",
					"维修"=>"500130213@经费支出-商品和服务支出-维修(护)费",
					"租"=>"500130214@经费支出-商品和服务支出-租赁费",
					"会议"=>"500130215@经费支出-商品和服务支出-会议费",
					"培训"=>"500130216@经费支出-商品和服务支出-培训费",
					"餐费"=>"500130217@经费支出-商品和服务支出-公务接待费",
					"劳务"=>"500130226@经费支出-商品和服务支出-劳务费",
					"工会经费"=>"500130228@经费支出-商品和服务支出-工会经费",
					"加油"=>"500130231@经费支出-商品和服务支出-公务用车运行维护费",
					"交通"=>"500130239@经费支出-商品和服务支出-其他交通费用",
					"税"=>"500130240@经费支出-商品和服务支出-税金及附加费用",
					"招商"=>"500130242@经费支出-商品和服务支出-招商引资费",
					"计生"=>"500130243@经费支出-商品和服务支出-计生支出",
					"捐赠"=>"500130245@经费支出-商品和服务支出-赞助捐赠支出",
					"防疫员"=>"500130249@经费支出-商品和服务支出-防疫员工资支出",
					"新农村"=>"500130251@经费支出-商品和服务支出-新农村建设支出",
					"电话"=>"500130252@经费支出-商品和服务支出-电话通讯费",
					"杂志"=>"500130253@经费支出-商品和服务支出-报刊杂志费",
					"党"=>"500130254@经费支出-商品和服务支出-党组织活动经费支出",
					"集资"=>"500130257@经费支出-商品和服务支出-利息支出",
					"水费"=>"500130259@经费支出-商品和服务支出-水费支出",
					"教育"=>"500130261@经费支出-商品和服务支出-教育支出",
					"食堂"=>"500130280@经费支出-商品和服务支出-食堂支出",
					"征兵"=>"500130281@经费支出-商品和服务支出-征兵支出",
					"垃圾"=>"500130283@经费支出-商品和服务支出-环境卫生支出",
					"扶贫"=>"50013028401@经费支出-商品和服务支出-扶贫支出-扶贫基本支出",
					"扶贫"=>"50013028402@经费支出-商品和服务支出-扶贫支出-扶贫项目支出",
					"宣传"=>"500130285@经费支出-商品和服务支出-宣传费",
					"住房公积金"=>"500130311@经费支出-对个人和家庭的补助-住房公积金",
					"养老保险"=>"500130314@经费支出-对个人和家庭的补助-基本养老保险费",
					"工伤保险"=>"500130315@经费支出-对个人和家庭的补助-工伤保险费",
					"生育保险"=>"500130316@经费支出-对个人和家庭的补助-生育保险费",
					"失业保险"=>"500130317@经费支出-对个人和家庭的补助-失业保险费",
					"岗位津贴"=>"500130318@经费支出-对个人和家庭的补助-岗位津贴",
					"高温"=>"500130320@经费支出-对个人和家庭的补助-高温津贴",
					"美丽乡村"=>"500130241@经费支出-商品和服务支出-美丽乡村建设支出
",
					"村级转移支付"=>"1215012@其他应收款-经管站",
					"工程"=>"工程类",
					"村级公路"=>"230503009@其他应付款-专项往来-路建办",
					"工程"=>"工程类",
					"一事一议"=>"230503007@其他应付款-专项往来-一事一议资金",
					"住宿"=>"500130217@经费支出-商品和服务支出-公务接待费",
					"耗材"=>"500130201@经费支出-商品和服务支出-办公费",
					"电脑配件"=>"500130201@经费支出-商品和服务支出-办公费",
					"公益性岗位"=>"1215012@其他应收款-经管站",
					"工程"=>"工程类",
					"工程"=>"工程类",


				]);
			$c=App::make('acc');
			$c->search=$search;
			 $f=file_get_contents(dirname(__FILE__)."//tests.txt");
			 $f=str_replace("\t\r\n", "_", $f);
			
			$g=explode("_", $f);
			

			$tests=collect($g);

			//传入$c和$tests
			$es=$c->getAcc($tests);

				// $es=$tests->flip()->map(function($item,$key) use ($c)
				// {
				// 	return $c->findac($key);
				// })->toArray();
				//  // $d=$c->findac('办公是是');

			 return view("account",compact("es"));

			
		


	}


	
































}
