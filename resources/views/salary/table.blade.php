				@if ($real_title->contains('tuixiu_gz'))<th>退休工资</th>@endif
 				@if ($real_title->contains('yishu_bz'))<th>	遗属补助</th>@endif
				@if ($real_title->contains('jb_gz1')+$real_title->contains('jb_gz2'))<th>基本工资</th>@endif
				@if ($real_title->contains('jinbutie'))<th>津补贴</th>@endif
				@if ($real_title->contains('gongche_bz'))<th>车补</th>@endif
				@if ($real_title->contains('xiangzhen_bz'))<th>乡镇补贴</th>@endif	
				@if ($real_title->contains('nianzhong_jj'))<th>年终奖金</th>@endif
				@if ($real_title->contains('gaowen_jiangwen'))<th>高温降温</th>@endif
				@if ($real_title->contains('jiangjin'))<th>奖金</th>
				@if (!(Route::currentRouteName()=='byear'||Route::currentRouteName()=='phb'))
				<th>备注</th>
				@endif
				@endif
				@if ($real_title->contains('bufa_gz'))<th>补发工资</th>@endif
				@if ($real_title->contains('gjj_dw'))<th>单位公积金</th>@endif
				@if ($real_title->contains('sb_dw'))<th>单位社保</th>@endif
				<th>应发合计</th>
				@if ($real_title->contains('gjj_gr'))<th>个人公积金</th>@endif
				@if ($real_title->contains('sb_gr'))<th>个人社保</th>@endif
				@if ($real_title->contains('zhiye_nj'))<th>职业年金</th>@endif
				@if ($real_title->contains('daikou_gz'))<th>代扣工资</th>@endif
				@if ($real_title->contains('fanghong_zj'))<th>防洪</th>@endif
				@if ($real_title->contains('yiliao_bx'))<th>医保</th>@endif
				@if ($real_title->contains('shiye_bx'))<th>失业</th>@endif
				@if ($real_title->contains('shengyu_bx'))<th>生育</th>@endif
				@if ($real_title->contains('gongshang_bx'))<th>工伤</th>@endif
				@if ($real_title->contains('yirijuan'))<th>一日捐</th>@endif
				@if ($real_title->contains('other_daikou'))<th>其他代扣</th><th>代扣备注</th>@endif
				@if ($real_title->contains('tiaozheng_gjj'))<th>公积金调整</th>@endif
				@if ($real_title->contains('tiaozheng_sb'))<th>社保调整</th>@endif
				<th>代扣合计</th><th>实发数</th>


			</tr>
		    </thead>

		    <tbody class='alert-info'>
	    	@foreach($res->chunk(10) as $ck)
			@foreach ($ck as $k=>$re)
			<tr class='alert-info'>
				
				<td><a href={{ route('geren',$re[0]->member_id)}}>

				@if (Route::currentRouteName()=='salary')
				{{$re[0]->name}}
				@elseif(Route::currentRouteName()=='byear')
				{{$re[0]->bumen}}
				@elseif(Route::currentRouteName()=='bumen')
				{{$re[0]->bumen}}
				@elseif(Route::currentRouteName()=='myear')
				{{$re[0]->date}}
				@elseif(Route::currentRouteName()=='geren')
				{{$re[0]->date}}
				@elseif(Route::currentRouteName()=='phb')
				{{$re[0]->name}}
				@endif

				</a></td>
				{{-- <td>{{$re->account}}</td> --}}
				@if ($real_title->contains('tuixiu_gz'))<td>{{$re->sum('tuixiu_gz')}}</td>@endif
				@if ($real_title->contains('yishu_bz'))<td>{{$re->sum('yishu_bz')}}</td>@endif
				@if ($real_title->contains('jb_gz1')+$real_title->contains('jb_gz2'))<td>{{$re->sum('jb_gz1')+$re->sum('jb_gz2')}}</td>@endif
				@if ($real_title->contains('jinbutie'))<td>{{$re->sum('jinbutie')}}</td>@endif
			    @if ($real_title->contains('gongche_bz'))<td>{{$re->sum('gongche_bz')}}</td>@endif
				@if ($real_title->contains('xiangzhen_bz'))<td>{{$re->sum('xiangzhen_bz')}}</td>@endif
				@if ($real_title->contains('nianzhong_jj'))<td>{{$re->sum('nianzhong_jj')}}</td>@endif
				@if ($real_title->contains('gaowen_jiangwen'))<td>{{$re->sum('gaowen_jiangwen')}}</td>@endif
				@if ($real_title->contains('jiangjin'))<td>{{$re->sum('jiangjin')}}</td>
				@if (!(Route::currentRouteName()=='byear'||Route::currentRouteName()=='phb'))
				<td>
				
				@foreach ($re->unique('jiangjin_beizhu') as $r)
					{{ $r->jiangjin_beizhu }}
				@endforeach
				</td>
				@endif

				@endif
				@if ($real_title->contains('bufa_gz'))<td>{{$re->sum('bufa_gz')}}</td>@endif
				@if ($real_title->contains('gjj_dw'))<td>{{$re->sum('gjj_dw')}}</td>@endif
				@if ($real_title->contains('sb_dw'))<td>{{$re->sum('sb_dw')}}</td>@endif
				<td>{{$re->sum('ying_fa_sum')}}</td>
				@if ($real_title->contains('gjj_gr'))<td>{{$re->sum('gjj_gr')}}</td>@endif
				@if ($real_title->contains('sb_gr'))<td>{{$re->sum('sb_gr')}}</td>@endif
				@if ($real_title->contains('zhiye_nj'))<td>{{$re->sum('zhiye_nj')}}</td>@endif
				@if ($real_title->contains('daikou_gz'))<td>{{$re->sum('daikou_gz')}}</td>@endif
				@if ($real_title->contains('fanghong_zj'))<td>{{$re->sum('fanghong_zj')}}</td>@endif
				@if ($real_title->contains('yiliao_bx'))<td>{{$re->sum('yiliao_bx')}}</td>@endif
				@if ($real_title->contains('shiye_bx'))<td>{{$re->sum('shiye_bx')}}</td>@endif
				@if ($real_title->contains('shengyu_bx'))<td>{{$re->sum('shengyu_bx')}}</td>@endif
				@if ($real_title->contains('gongshang_bx'))<td>{{$re->sum('gongshang_bx')}}</td>@endif
				@if ($real_title->contains('yirijuan'))<td>{{$re->sum('yirijuan')}}</td>@endif

				@if ($real_title->contains('other_daikou'))<td>{{$re->sum('other_daikou')}}</td><td>{{$re->sum('daikou_beizhu')}}</td>@endif

				@if ($real_title->contains('tiaozheng_gjj'))<td>{{$re->sum('tiaozheng_gjj')}}</td>@endif
				@if ($real_title->contains('tiaozheng_sb'))<td>{{$re->sum('tiaozheng_sb')}}</td>
				@endif 				
                <td>{{round($re->sum('dai_kou_sum'),2)}}</td>
		        <td>						
		        {{ $re->sum('ying_fa_sum')-$re->sum('dai_kou_sum')}}	    </td>
			   </tr>
			   @endforeach
			   @endforeach
		       </tbody>
			   <tr>
		       <td>汇总</td>
				
				{{-- <th>账号</th> --}}


				@if ($resv->sum('tuixiu_gz'))<td>{{ $resv->sum('tuixiu_gz') }}</td>@endif
 				@if ($resv->sum('yishu_bz'))<td>	{{ $resv->sum('yishu_bz') }}</td>@endif
				@if ($resv->sum('jb_gz1')+$resv->sum('jb_gz2'))<td>{{ $resv->sum('jb_gz1')+$resv->sum('jb_gz2') }}</td>@endif
				@if ($resv->sum('jinbutie'))<td>{{ $resv->sum('jinbutie')}}</td>@endif
				@if ($resv->sum('gongche_bz'))<td>{{ $resv->sum('gongche_bz')}}</td>@endif
				@if ($resv->sum('xiangzhen_bz'))<td>{{ $resv->sum('xiangzhen_bz') }}</td>@endif	
				@if ($resv->sum('nianzhong_jj'))<td>{{ $resv->sum('nianzhong_jj') }}</td>@endif
				@if ($resv->sum('gaowen_jiangwen'))<td>{{ $resv->sum('gaowen_jiangwen') }}</td>@endif
				@if ($resv->sum('jiangjin'))<td>{{ $resv->sum('jiangjin') }}</td>
				@if (!(Route::currentRouteName()=='byear'||Route::currentRouteName()=='phb'))
				<td>备注</td>
				@endif
				@endif
				@if ($resv->sum('bufa_gz'))<td>{{ $resv->sum('bufa_gz') }}</td>@endif
				@if ($resv->sum('gjj_dw'))<td>{{ $resv->sum('gjj_dw') }}</td>@endif
				@if ($resv->sum('sb_dw'))<td>{{ round($resv->sum('sb_dw'),2) }}</td>@endif
				<td>{{$resv->sum('ying_fa_sum')}}</td>
				@if ($resv->sum('gjj_gr'))<td>{{ $resv->sum('gjj_gr') }}</td>@endif
				@if ($resv->sum('sb_gr'))<td>{{ $resv->sum('sb_gr') }}</td>@endif
				@if ($resv->sum('zhiye_nj'))<td>{{ $resv->sum('zhiye_nj') }}</td>@endif
				@if ($resv->sum('daikou_gz'))<td>{{ $resv->sum('daikou_gz') }}</td>@endif
				@if ($resv->sum('fanghong_zj'))<td>{{ $resv->sum('fanghong_zj') }}</td>@endif
				@if ($resv->sum('yiliao_bx'))<td>{{ $resv->sum('yiliao_bx') }}</td>@endif
				@if ($resv->sum('shiye_bx'))<td>{{ $resv->sum('shiye_bx') }}</td>@endif
				@if ($resv->sum('shengyu_bx'))<td>{{ $resv->sum('shengyu_bx') }}</td>@endif
				@if ($resv->sum('gongshang_bx'))<td>{{ $resv->sum('gongshang_bx') }}</td>@endif
				@if ($resv->sum('yirijuan'))<td>{{ $resv->sum('yirijuan') }}</td>@endif
				@if ($resv->sum('other_daikou'))<td>{{ $resv->sum('other_daikou') }}</td><td>代扣备注</td>@endif
				@if ($resv->sum('tiaozheng_gjj'))<td>{{ $resv->sum('tiaozheng_gjj') }}</td>@endif
				@if ($resv->sum('tiaozheng_sb'))<td>{{ $resv->sum('tiaozheng_sb') }}</td>@endif
				<td>
					{{ round($resv->sum('dai_kou_sum'),2) }}
				</td><td>
	        	{{ round($resv->sum('ying_fa_sum')-$resv->sum('dai_kou_sum'),2) }}
				</td>
				</tr>
</table>
{{-- {!! $res->render() !!} --}}