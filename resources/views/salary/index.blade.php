@extends('layouts.default')
@section('content')
@include('salary.date')




<h1>枚江镇工资花名册({{ $res[0]->date }})</h1>
@include('shared.errors')

<article>
	
	<h2>
	<table class="table table-bordered table-striped table-hover table-condensed">
		<caption><center>{{ date("Y-m-d H:i:s") }}</center></caption>

		<thead>
			<tr class='success'>
				<th>ID</th>
				<th>姓名</th>
				{{-- <th>账号</th> --}}


				@if ($res->sum('tuixiu_gz'))<th>退休工资</th>@endif
 				@if ($res->sum('yishu_bz'))<th>	遗属补助</th>@endif
				@if ($res->sum('jb_gz1')+$res->sum('jb_gz2'))<th>基本工资</th>@endif
				@if ($res->sum('jinbutie'))<th>津补贴</th>@endif
				@if ($res->sum('gongche_bz'))<th>车补</th>@endif
				@if ($res->sum('xiangzhen_bz'))<th>乡镇补贴</th>@endif	
				@if ($res->sum('nianzhong_jj'))<th>年终奖金</th>@endif
				@if ($res->sum('gaowen_jiangwen'))<th>高温降温</th>@endif
				@if ($res->sum('jiangjin'))<th>奖金</th><th>备注</th>@endif
				@if ($res->sum('bufa_gz'))<th>补发工资</th>@endif
				@if ($res->sum('gjj_dw'))<th>单位公积金</th>@endif
				@if ($res->sum('sb_dw'))<th>单位社保</th>@endif
				<th>应发合计</th>
				@if ($res->sum('gjj_gr'))<th>个人公积金</th>@endif
				@if ($res->sum('sb_gr'))<th>个人社保</th>@endif
				@if ($res->sum('zhiye_nj'))<th>职业年金</th>@endif
				@if ($res->sum('daikou_gz'))<th>代扣工资</th>@endif
				@if ($res->sum('fanghong_zj'))<th>防洪</th>@endif
				@if ($res->sum('yiliao_bx'))<th>医保</th>@endif
				@if ($res->sum('shiye_bx'))<th>失业</th>@endif
				@if ($res->sum('shengyu_bx'))<th>生育</th>@endif
				@if ($res->sum('gongshang_bx'))<th>工伤</th>@endif
				@if ($res->sum('yirijuan'))<th>一日捐</th>@endif
				@if ($res->sum('other_daikou'))<th>其他代扣</th><th>代扣备注</th>@endif
				@if ($res->sum('tiaozheng_gjj'))<th>公积金调整</th>@endif
				@if ($res->sum('tiaozheng_sb'))<th>社保调整</th>@endif
				<th>代扣合计</th><th>实发数</th>


			</tr>
		</thead>
		<tbody class='alert-info'>
			@foreach ($res as $re)
			<tr class={{ empty($re->id)?'alert-info':""}}>
				<td>
				{{$re->member_id}} 
				</td>
				<td><a href={{ route('sarary',$re->member_id)}}>{{$re->name}}</a></td>
				{{-- <td>{{$re->account}}</td> --}}
				@if ($res->sum('tuixiu_gz'))<td>{{$re->tuixiu_gz}}</td>@endif
				@if ($res->sum('yishu_bz'))<td>{{$re->yishu_bz}}</td>@endif
				@if ($res->sum('jb_gz1')+$re->sum('jb_gz2'))<td>{{$re->jb_gz1+$re->jb_gz2}}</td>@endif
				@if ($res->sum('jinbutie'))<td>{{$re->jinbutie}}</td>@endif
			    @if ($res->sum('gongche_bz'))<td>{{$re->gongche_bz}}</td>@endif
				@if ($res->sum('xiangzhen_bz'))<td>{{$re->xiangzhen_bz}}</td>@endif
				@if ($res->sum('nianzhong_jj'))<td>{{$re->nianzhong_jj}}</td>@endif
				@if ($res->sum('gaowen_jiangwen'))<td>{{$re->gaowen_jiangwen}}</td>@endif
				@if ($res->sum('jiangjin'))<td>{{$re->jiangjin}}</td>
				<td>{{$re->beizhu}}</td>@endif
				@if ($res->sum('bufa_gz'))<td>{{$re->bufa_gz}}</td>@endif
				@if ($res->sum('gjj_dw'))<td>{{$re->gjj_dw}}</td>@endif
				@if ($res->sum('sb_dw'))<td>{{$re->sb_dw}}</td>@endif
				<td>{{$re->yishu_bz+
						$re->tuixiu_gz+
						$re->jb_gz1+
						$re->jb_gz2+
						$re->jinbutie+
						$re->gongche_bz+
						$re->xiangzhen_bz+
						$re->bufa_gz+
						$re->nianzhong_jj+
						$re->gaowen_jiangwen+
						$re->jiangjin+
						$re->gjj_dw+
						$re->sb_dw}}</td>
				@if ($res->sum('gjj_gr'))<td>{{$re->gjj_gr}}</td>@endif
				@if ($res->sum('sb_gr'))<td>{{$re->sb_gr}}</td>@endif
				@if ($res->sum('zhiye_nj'))<td>{{$re->zhiye_nj}}</td>@endif
				@if ($res->sum('daikou_gz'))<td>{{$re->daikou_gz}}</td>@endif
				@if ($res->sum('fanghong_zj'))<td>{{$re->fanghong_zj}}</td>@endif


				@if ($res->sum('yiliao_bx'))<td>{{$re->yiliao_bx}}</td>@endif
				@if ($res->sum('shiye_bx'))<td>{{$re->shiye_bx}}</td>@endif
				@if ($res->sum('shengyu_bx'))<td>{{$re->shengyu_bx}}</td>@endif
				@if ($res->sum('gongshang_bx'))<td>{{$re->gongshang_bx}}</td>@endif
				@if ($res->sum('yirijuan'))<td>{{$re->yirijuan}}</td>@endif
				@if ($res->sum('other_daikou'))<td>{{$re->otder_daikou}}</td><td>{{$re->daikou_beizhu}}</td>@endif
				@if ($res->sum('tiaozheng_gjj'))<td>{{$re->tiaozheng_gjj}}</td>@endif
				@if ($res->sum('tiaozheng_sb'))<td>{{$re->tiaozheng_sb}}</td>
				@endif



				<td>{{$re->gjj_gr+$re->gjj_dw+
					$re->sb_gr+$re->sb_dw+
					$re->zhiye_nj+
					$re->daikou_gz+
					$re->fanghong_zj+
					$re->yiliao_bx+
					$re->shiye_bx+
					$re->shengyu_bx+
					$re->gongshang_bx+
					$re->yirijuan+
					$re->other_daikou+
					$re->tiaozheng_gjj+
					$re->tiaozheng_sb
					}}</td>

					<td>
						
				{{ ($re->yishu_bz+
						$re->tuixiu_gz+
						$re->jb_gz1+
						$re->jb_gz2+
						$re->jinbutie+
						$re->gongche_bz+
						$re->xiangzhen_bz+
						$re->bufa_gz+
						$re->nianzhong_jj+
						$re->gaowen_jiangwen+
						$re->jiangjin+
						$re->gjj_dw+
						$re->sb_dw )-
						(
					$re->gjj_gr+$re->gjj_dw+
					$re->sb_gr+$re->sb_dw+
					$re->zhiye_nj+
					$re->daikou_gz+
					$re->fanghong_zj+
					$re->yiliao_bx+
					$re->shiye_bx+
					$re->shengyu_bx+
					$re->gongshang_bx+
					$re->yirijuan+
					$re->other_daikou+
					$re->tiaozheng_gjj+
					$re->tiaozheng_sb	)}}		

					</td>
			</tr>

			@endforeach



			





			
		</tbody>
		<th>汇</th>
				<th>总</th>
				{{-- <th>账号</th> --}}


				@if ($res->sum('tuixiu_gz'))<th>{{ $res->sum('tuixiu_gz') }}</th>@endif
 				@if ($res->sum('yishu_bz'))<th>	{{ $res->sum('yishu_bz') }}</th>@endif
				@if ($res->sum('jb_gz1')+$res->sum('jb_gz2'))<th>{{ $res->sum('jb_gz1')+$res->sum('jb_gz2') }}</th>@endif
				@if ($res->sum('jinbutie'))<th>{{ $res->sum('jinbutie')}}</th>@endif
				@if ($res->sum('gongche_bz'))<th>{{ $res->sum('gongche_bz')}}</th>@endif
				@if ($res->sum('xiangzhen_bz'))<th>{{ $res->sum('xiangzhen_bz') }}</th>@endif	
				@if ($res->sum('nianzhong_jj'))<th>{{ $res->sum('nianzhong_jj') }}</th>@endif
				@if ($res->sum('gaowen_jiangwen'))<th>{{ $res->sum('gaowen_jiangwen') }}</th>@endif
				@if ($res->sum('jiangjin'))<th>{{ $res->sum('jiangjin') }}</th><th>备注</th>@endif
				@if ($res->sum('bufa_gz'))<th>{{ $res->sum('bufa_gz') }}</th>@endif
				@if ($res->sum('gjj_dw'))<th>{{ $res->sum('gjj_dw') }}</th>@endif
				@if ($res->sum('sb_dw'))<th>{{ round($res->sum('sb_dw'),2) }}</th>@endif
				<th>{{$res->sum('yishu_bz')+
						$res->sum('tuixiu_gz')+
						$res->sum('jb_gz1')+
						$res->sum('jb_gz2')+
						$res->sum('jinbutie')+
						$res->sum('gongche_bz')+
						$res->sum('xiangzhen_bz')+
						$res->sum('bufa_gz')+
						$res->sum('nianzhong_jj')+
						$res->sum('gaowen_jiangwen')+
						$res->sum('jiangjin')+
						$res->sum('gjj_dw')+
						$res->sum('sb_dw')}}</th>
				@if ($res->sum('gjj_gr'))<th>{{ $res->sum('gjj_gr') }}</th>@endif
				@if ($res->sum('sb_gr'))<th>{{ $res->sum('sb_gr') }}</th>@endif
				@if ($res->sum('zhiye_nj'))<th>{{ $res->sum('zhiye_nj') }}</th>@endif
				@if ($res->sum('daikou_gz'))<th>{{ $res->sum('daikou_gz') }}</th>@endif
				@if ($res->sum('fanghong_zj'))<th>{{ $res->sum('fanghong_zj') }}</th>@endif
				@if ($res->sum('yiliao_bx'))<th>{{ $res->sum('yiliao_bx') }}</th>@endif
				@if ($res->sum('shiye_bx'))<th>{{ $res->sum('shiye_bx') }}</th>@endif
				@if ($res->sum('shengyu_bx'))<th>{{ $res->sum('shengyu_bx') }}</th>@endif
				@if ($res->sum('gongshang_bx'))<th>{{ $res->sum('gongshang_bx') }}</th>@endif
				@if ($res->sum('yirijuan'))<th>{{ $res->sum('yirijuan') }}</th>@endif
				@if ($res->sum('other_daikou'))<th>{{ $res->sum('other_daikou') }}</th><th>代扣备注</th>@endif
				@if ($res->sum('tiaozheng_gjj'))<th>{{ $res->sum('tiaozheng_gjj') }}</th>@endif
				@if ($res->sum('tiaozheng_sb'))<th>{{ $res->sum('tiaozheng_sb') }}</th>@endif
				<th>
					{{
						round(
					$res->sum('gjj_gr')+
					$res->sum('gjj_dw')+
					$res->sum('sb_gr')+
					$res->sum('sb_dw')+
					$res->sum('zhiye_nj')+
					$res->sum('daikou_gz')+
					$res->sum('fanghong_zj')+
					$res->sum('yiliao_bx')+
					$res->sum('shiye_bx')+
					$res->sum('shengyu_bx')+
					$res->sum('gongshang_bx')+
					$res->sum('yirijuan')+
					$res->sum('other_daikou')+
					$res->sum('tiaozheng_gjj')+
					$res->sum('tiaozheng_sb')
					,2) 
					}}
				</th><th>
	  	{{  		round(
	  				$res->sum('yishu_bz')+
					$res->sum('tuixiu_gz')+
					$res->sum('jb_gz1')+
					$res->sum('jb_gz2')+
					$res->sum('jinbutie')+
					$res->sum('gongche_bz')+
					$res->sum('xiangzhen_bz')+
					$res->sum('bufa_gz')+
					$res->sum('nianzhong_jj')+
					$res->sum('gaowen_jiangwen')+
					$res->sum('jiangjin')+
					$res->sum('gjj_dw')+
					$res->sum('sb_dw')-
					(
					$res->sum('gjj_gr')+
					$res->sum('gjj_dw')+
					$res->sum('sb_gr')+
					$res->sum('sb_dw')+
					$res->sum('zhiye_nj')+
					$res->sum('daikou_gz')+
					$res->sum('fanghong_zj')+
					$res->sum('yiliao_bx')+
					$res->sum('shiye_bx')+
					$res->sum('shengyu_bx')+
					$res->sum('gongshang_bx')+
					$res->sum('yirijuan')+
					$res->sum('other_daikou')+
					$res->sum('tiaozheng_gjj')+
					$res->sum('tiaozheng_sb')
							)
							,2) }}
				</th>
</table>
</article>

@stop
