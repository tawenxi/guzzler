@extends('layouts.default')
@section('content')
<h1>枚江镇指标支出明细表({{ $results->count().'条' }})</h1>
@include('shared.errors')

<article>
	
	<h2>
	<table class="table table-bordered table-striped table-hover table-condensed">
		<caption><center>{{ date("Y-m-d H:i:s") }}</center></caption>

		<thead>
			<tr class='success'>
				<th>日期</th>
				<th>摘要</th>
				<th>金额</th>
				<th>单位</th>
				<th>项目名称</th>
				<th>支出类别</th>
				<th>XZ</th>
				
			</tr>
		</thead>
		<tbody class='alert-info'>
				@foreach ($results as $result)
			<tr class={{ empty($result->body)?'alert-danger':""}}>
			<td>
				
					{{$result->QS_RQ}}
				
				</td>
			<td>
				<a href="showzbdetail/{{ $result->ZBID }}">
					{{$result->ZY}}
				</a>
				</td>
				<td>
				
					{{$result->JE}} 

					
				
				</td>
				
				
				<td>
				
					{{$result->YSDWMC}}
				
				</td>
				
				<td>
				
					{{$result->XMMC}}
				
				</td>
				<td >
				
			{{$result->ZFFSMC}}
				
				</td>
						<td >
				
			{{$result->ZJXZDM}}
				
				</td>
			</tr>	
			@endforeach
		</tbody>
					<tr class='success'>
				<th>日期</th>
				<th>摘要</th>
				<th>金额</th>
				<th>单位</th>
				<th>项目名称</th>
				<th>支出类别</th>
				<th>XZ</th>
			</tr>
	</table>



			<hr>
	
	</h2>
</article>
{{-- {!! Form::open() !!}
 {!! Form::text("name") !!}
{!! Form::close() !!} --}}
@stop