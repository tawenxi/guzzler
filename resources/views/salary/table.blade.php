				@if ($resv->sum('tuixiu_gz'))<th>退休工资</th>@endif
 				@if ($resv->sum('yishu_bz'))<th>	遗属补助</th>@endif
				@if ($resv->sum('jb_gz1')+$resv->sum('jb_gz2'))<th>基本工资</th>@endif
				@if ($resv->sum('jinbutie'))<th>津补贴</th>@endif
				@if ($resv->sum('gongche_bz'))<th>车补</th>@endif
				@if ($resv->sum('xiangzhen_bz'))<th>乡镇补贴</th>@endif	
				@if ($resv->sum('nianzhong_jj'))<th>年终奖金</th>@endif
				@if ($resv->sum('gaowen_jiangwen'))<th>高温降温</th>@endif
				@if ($resv->sum('jiangjin'))<th>奖金</th><th>备注</th>@endif
				@if ($resv->sum('bufa_gz'))<th>补发工资</th>@endif
				@if ($resv->sum('gjj_dw'))<th>单位公积金</th>@endif
				@if ($resv->sum('sb_dw'))<th>单位社保</th>@endif
				<th>应发合计</th>
				@if ($resv->sum('gjj_gr'))<th>个人公积金</th>@endif
				@if ($resv->sum('sb_gr'))<th>个人社保</th>@endif
				@if ($resv->sum('zhiye_nj'))<th>职业年金</th>@endif
				@if ($resv->sum('daikou_gz'))<th>代扣工资</th>@endif
				@if ($resv->sum('fanghong_zj'))<th>防洪</th>@endif
				@if ($resv->sum('yiliao_bx'))<th>医保</th>@endif
				@if ($resv->sum('shiye_bx'))<th>失业</th>@endif
				@if ($resv->sum('shengyu_bx'))<th>生育</th>@endif
				@if ($resv->sum('gongshang_bx'))<th>工伤</th>@endif
				@if ($resv->sum('yirijuan'))<th>一日捐</th>@endif
				@if ($resv->sum('other_daikou'))<th>其他代扣</th><th>代扣备注</th>@endif
				@if ($resv->sum('tiaozheng_gjj'))<th>公积金调整</th>@endif
				@if ($resv->sum('tiaozheng_sb'))<th>社保调整</th>@endif
				<th>代扣合计</th><th>实发数</th>


			</tr>
		</thead>

		<tbody class='alert-info'>
			@foreach ($res as $k=>$re)
			<tr class='alert-info'>
				
				<td><a href={{ route('sarary',$re[0]->member_id)}}>{{$k}}</a></td>
				{{-- <td>{{$re->account}}</td> --}}
				@if ($resv->sum('tuixiu_gz'))<td>{{$re->sum('tuixiu_gz')}}</td>@endif
				@if ($resv->sum('yishu_bz'))<td>{{$re->sum('yishu_bz')}}</td>@endif
				@if ($resv->sum('jb_gz1')+$resv->sum('jb_gz2'))<td>{{$re->sum('jb_gz1')+$re->sum('jb_gz2')}}</td>@endif
				@if ($resv->sum('jinbutie'))<td>{{$re->sum('jinbutie')}}</td>@endif
			    @if ($resv->sum('gongche_bz'))<td>{{$re->sum('gongche_bz')}}</td>@endif
				@if ($resv->sum('xiangzhen_bz'))<td>{{$re->sum('xiangzhen_bz')}}</td>@endif
				@if ($resv->sum('nianzhong_jj'))<td>{{$re->sum('nianzhong_jj')}}</td>@endif
				@if ($resv->sum('gaowen_jiangwen'))<td>{{$re->sum('gaowen_jiangwen')}}</td>@endif
				@if ($resv->sum('jiangjin'))<td>{{$re->sum('jiangjin')}}</td>
				<td>
				@foreach ($re->unique('jiangjin_beizhu') as $r)
					{{ $r->jiangjin_beizhu }}
				@endforeach

				</td>@endif
				@if ($resv->sum('bufa_gz'))<td>{{$re->sum('bufa_gz')}}</td>@endif
				@if ($resv->sum('gjj_dw'))<td>{{$re->sum('gjj_dw')}}</td>@endif
				@if ($resv->sum('sb_dw'))<td>{{$re->sum('sb_dw')}}</td>@endif
				<td>{{$re->sum('yishu_bz')+
						$re->sum('tuixiu_gz')+
						$re->sum('jb_gz1')+
						$re->sum('jb_gz2')+
						$re->sum('jinbutie')+
						$re->sum('gongche_bz')+
						$re->sum('xiangzhen_bz')+
						$re->sum('bufa_gz')+
						$re->sum('nianzhong_jj')+
						$re->sum('gaowen_jiangwen')+
						$re->sum('jiangjin')+
						$re->sum('gjj_dw')+
						$re->sum('sb_dw')}}</td>
				@if ($resv->sum('gjj_gr'))<td>{{$re->sum('gjj_gr')}}</td>@endif
				@if ($resv->sum('sb_gr'))<td>{{$re->sum('sb_gr')}}</td>@endif
				@if ($resv->sum('zhiye_nj'))<td>{{$re->sum('zhiye_nj')}}</td>@endif
				@if ($resv->sum('daikou_gz'))<td>{{$re->sum('daikou_gz')}}</td>@endif
				@if ($resv->sum('fanghong_zj'))<td>{{$re->sum('fanghong_zj')}}</td>@endif


				@if ($resv->sum('yiliao_bx'))<td>{{$re->sum('yiliao_bx')}}</td>@endif
				@if ($resv->sum('shiye_bx'))<td>{{$re->sum('shiye_bx')}}</td>@endif
				@if ($resv->sum('shengyu_bx'))<td>{{$re->sum('shengyu_bx')}}</td>@endif
				@if ($resv->sum('gongshang_bx'))<td>{{$re->sum('gongshang_bx')}}</td>@endif
				@if ($resv->sum('yirijuan'))<td>{{$re->sum('yirijuan')}}</td>@endif

				@if ($resv->sum('other_daikou'))<td>{{$re->sum('otder_daikou')}}</td><td>{{$re->sum('daikou_beizhu')}}</td>@endif

				@if ($resv->sum('tiaozheng_gjj'))<td>{{$re->sum('tiaozheng_gjj')}}</td>@endif
				@if ($resv->sum('tiaozheng_sb'))<td>{{$re->sum('tiaozheng_sb')}}</td>
				@endif



				
<td>			  {{round(
					$re->sum('gjj_gr')+
					$re->sum('gjj_dw')+
					$re->sum('sb_gr')+
					$re->sum('sb_dw')+
					$re->sum('zhiye_nj')+
					$re->sum('daikou_gz')+
					$re->sum('fanghong_zj')+
					$re->sum('yiliao_bx')+
					$re->sum('shiye_bx')+
					$re->sum('shengyu_bx')+
					$re->sum('gongshang_bx')+
					$re->sum('yirijuan')+
					$re->sum('other_daikou')+
					$re->sum('tiaozheng_gjj')+
					$re->sum('tiaozheng_sb')
					,2)
					}}</td>

					<td>
						
				{{ ($re->sum('yishu_bz')+
						$re->sum('tuixiu_gz')+
						$re->sum('jb_gz1')+
						$re->sum('jb_gz2')+
						$re->sum('jinbutie')+
						$re->sum('gongche_bz')+
						$re->sum('xiangzhen_bz')+
						$re->sum('bufa_gz')+
						$re->sum('nianzhong_jj')+
						$re->sum('gaowen_jiangwen')+
						$re->sum('jiangjin')+
						$re->sum('gjj_dw')+
						$re->sum('sb_dw') )-
						(
					$re->sum('gjj_gr')+
					$re->sum('gjj_dw')+
					$re->sum('sb_gr')+
					$re->sum('sb_dw')+
					$re->sum('zhiye_nj')+
					$re->sum('daikou_gz')+
					$re->sum('fanghong_zj')+
					$re->sum('yiliao_bx')+
					$re->sum('shiye_bx')+
					$re->sum('shengyu_bx')+
					$re->sum('gongshang_bx')+
					$re->sum('yirijuan')+
					$re->sum('other_daikou')+
					$re->sum('tiaozheng_gjj')+
					$re->sum('tiaozheng_sb')	)}}		

					</td>
			</tr>

			@endforeach




			</tbody>
		<th>汇总</th>
				
				{{-- <th>账号</th> --}}


				@if ($resv->sum('tuixiu_gz'))<th>{{ $resv->sum('tuixiu_gz') }}</th>@endif
 				@if ($resv->sum('yishu_bz'))<th>	{{ $resv->sum('yishu_bz') }}</th>@endif
				@if ($resv->sum('jb_gz1')+$resv->sum('jb_gz2'))<th>{{ $resv->sum('jb_gz1')+$resv->sum('jb_gz2') }}</th>@endif
				@if ($resv->sum('jinbutie'))<th>{{ $resv->sum('jinbutie')}}</th>@endif
				@if ($resv->sum('gongche_bz'))<th>{{ $resv->sum('gongche_bz')}}</th>@endif
				@if ($resv->sum('xiangzhen_bz'))<th>{{ $resv->sum('xiangzhen_bz') }}</th>@endif	
				@if ($resv->sum('nianzhong_jj'))<th>{{ $resv->sum('nianzhong_jj') }}</th>@endif
				@if ($resv->sum('gaowen_jiangwen'))<th>{{ $resv->sum('gaowen_jiangwen') }}</th>@endif
				@if ($resv->sum('jiangjin'))<th>{{ $resv->sum('jiangjin') }}</th><th>备注</th>@endif
				@if ($resv->sum('bufa_gz'))<th>{{ $resv->sum('bufa_gz') }}</th>@endif
				@if ($resv->sum('gjj_dw'))<th>{{ $resv->sum('gjj_dw') }}</th>@endif
				@if ($resv->sum('sb_dw'))<th>{{ round($resv->sum('sb_dw'),2) }}</th>@endif
				<th>{{$resv->sum('yishu_bz')+
						$resv->sum('tuixiu_gz')+
						$resv->sum('jb_gz1')+
						$resv->sum('jb_gz2')+
						$resv->sum('jinbutie')+
						$resv->sum('gongche_bz')+
						$resv->sum('xiangzhen_bz')+
						$resv->sum('bufa_gz')+
						$resv->sum('nianzhong_jj')+
						$resv->sum('gaowen_jiangwen')+
						$resv->sum('jiangjin')+
						$resv->sum('gjj_dw')+
						$resv->sum('sb_dw')}}</th>
				@if ($resv->sum('gjj_gr'))<th>{{ $resv->sum('gjj_gr') }}</th>@endif
				@if ($resv->sum('sb_gr'))<th>{{ $resv->sum('sb_gr') }}</th>@endif
				@if ($resv->sum('zhiye_nj'))<th>{{ $resv->sum('zhiye_nj') }}</th>@endif
				@if ($resv->sum('daikou_gz'))<th>{{ $resv->sum('daikou_gz') }}</th>@endif
				@if ($resv->sum('fanghong_zj'))<th>{{ $resv->sum('fanghong_zj') }}</th>@endif
				@if ($resv->sum('yiliao_bx'))<th>{{ $resv->sum('yiliao_bx') }}</th>@endif
				@if ($resv->sum('shiye_bx'))<th>{{ $resv->sum('shiye_bx') }}</th>@endif
				@if ($resv->sum('shengyu_bx'))<th>{{ $resv->sum('shengyu_bx') }}</th>@endif
				@if ($resv->sum('gongshang_bx'))<th>{{ $resv->sum('gongshang_bx') }}</th>@endif
				@if ($resv->sum('yirijuan'))<th>{{ $resv->sum('yirijuan') }}</th>@endif
				@if ($resv->sum('other_daikou'))<th>{{ $resv->sum('other_daikou') }}</th><th>代扣备注</th>@endif
				@if ($resv->sum('tiaozheng_gjj'))<th>{{ $resv->sum('tiaozheng_gjj') }}</th>@endif
				@if ($resv->sum('tiaozheng_sb'))<th>{{ $resv->sum('tiaozheng_sb') }}</th>@endif
				<th>
					{{
						round(
					$resv->sum('gjj_gr')+
					$resv->sum('gjj_dw')+
					$resv->sum('sb_gr')+
					$resv->sum('sb_dw')+
					$resv->sum('zhiye_nj')+
					$resv->sum('daikou_gz')+
					$resv->sum('fanghong_zj')+
					$resv->sum('yiliao_bx')+
					$resv->sum('shiye_bx')+
					$resv->sum('shengyu_bx')+
					$resv->sum('gongshang_bx')+
					$resv->sum('yirijuan')+
					$resv->sum('other_daikou')+
					$resv->sum('tiaozheng_gjj')+
					$resv->sum('tiaozheng_sb')
						,2) 
					}}
				</th><th>
	  	{{  		round(
	  				$resv->sum('yishu_bz')+
					$resv->sum('tuixiu_gz')+
					$resv->sum('jb_gz1')+
					$resv->sum('jb_gz2')+
					$resv->sum('jinbutie')+
					$resv->sum('gongche_bz')+
					$resv->sum('xiangzhen_bz')+
					$resv->sum('bufa_gz')+
					$resv->sum('nianzhong_jj')+
					$resv->sum('gaowen_jiangwen')+
					$resv->sum('jiangjin')+
					$resv->sum('gjj_dw')+
					$resv->sum('sb_dw')-
					(
					$resv->sum('gjj_gr')+
					$resv->sum('gjj_dw')+
					$resv->sum('sb_gr')+
					$resv->sum('sb_dw')+
					$resv->sum('zhiye_nj')+
					$resv->sum('daikou_gz')+
					$resv->sum('fanghong_zj')+
					$resv->sum('yiliao_bx')+
					$resv->sum('shiye_bx')+
					$resv->sum('shengyu_bx')+
					$resv->sum('gongshang_bx')+
					$resv->sum('yirijuan')+
					$resv->sum('other_daikou')+
					$resv->sum('tiaozheng_gjj')+
					$resv->sum('tiaozheng_sb')
							)
							,2) }}
				</th>
</table>