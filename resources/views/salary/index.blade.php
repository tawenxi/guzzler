@extends('layouts.default')
@section('content')
<h1>枚江镇工资花名册</h1>
@include('shared.errors')

<article>
	
	<h2>
	<table class="table table-bordered table-striped table-hover table-condensed">
		<caption><center>{{ date("Y-m-d H:i:s") }}</center></caption>

		<thead>
			<tr class='success'>
				<th>ID</th><th>姓名</th>


				@if ($res->sum('tuixiu_gz'))
				
				<th>	{{$res->tuixiu_gz}}</th>
				@endif

				
				<th>基本工资</th><th>津补贴</th>
				<th>车补</th>
				<th>补发工资</th>
				<th>单位公积金</th><th>单位社保</th>

				<th>应发合计</th>
			</tr>
		</thead>
		<tbody class='alert-info'>

				@foreach ($res as $res)
			<tr class={{ empty($re->id)?'alert-danger':""}}>
				<td>
				
					<a href="{{ $res->id }}/show">{{$res->id}} 

					</a>
				
				</td>
				<td>
				
					{{$res->name}}
				
				</td>
								<td>
								@if ($res->tuixiu_gz)
				
					{{$res->tuixiu_gz}}
				@endif
					
				
				</td>
				<td>
				
					{{$res->jiben_gz}}
				
				</td>
				<td>
				
					{{$res->jinbutie}}
				
				</td>
								<td>
				
					{{$res->gongche_bz}}
				
				</td>
							<td>
				
					{{$res->bufa_gz}}
				
				</td>	<td>
				
					{{$res->gjj_dw}}
				
				</td>
								<td>
				
					{{$res->sb_dw}}
				
				</td>

												<td>
				
					{{$res->yishu_bz+
						$res->tuixiu_gz+
						$res->jiben_gz+
						$res->jinbutie+
						$res->sb_dw+
						$res->gjj_dw+
						$res->bufa_gz+
						$res->gongche_bz}}


				
				</td>
				<td class='btn btn-link'>
				
					<a href="edit/{{ $res->ok }}" > 编辑</a>
				
				</td>
			</tr>	
			@endforeach
		</tbody>
	</table>



			<hr>
	
	</h2>
</article>
{{-- {!! Form::open() !!}
 {!! Form::text("name") !!}
{!! Form::close() !!} --}}
@stop