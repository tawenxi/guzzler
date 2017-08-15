@extends('layouts.default')
@section('content')
<h1>枚江镇指标明细表({{ $results->count().'条' }})</h1>
@include('shared.errors')

<article>
	
	<h2>
	<table class="table table-bordered table-striped table-hover table-condensed">
		<caption><center>{{ date("Y-m-d H:i:s") }}</center></caption>

		<thead>
			<tr class='success'>
			<th>科目</th>
				<th>指标ID</th>
				<th>日期</th>
				<th>摘要</th>
			{{-- 	<th>指标来源</th> --}}
				<th>预算项目</th>
				<th>总金额</th>
				<th>可用金额</th>
				<th>支出数</th>
				<th>单位</th>
			</tr>
		</thead>
		<tbody class='alert-info'>
				@foreach ($results as $result)
			<tr class={{ abs($result->JE-$result->zbdetails->sum('JE'))<1?'alert-danger':""}}>


				<td class="small">
				
					@if (!is_null($result->account))
					{{$result->account->name}} 
					@endif
				
				</td>
				<td class="small">
				
					<a href="showzbdetail/{{ $result->ZBID }}">{{$result->ZBID}} 

					</a>
				
				</td>
					<td>
				
					{{$result->LR_RQ}}
				
				</td>
				<td class="small">
				
					{{$result->ZY}}
				
				</td>
	{{-- 			<td>
				
					{{substr($result->ZBLYMC,12)}}
				
				</td> --}}
				<td>
				
					{{substr($result->ZJXZMC,0,12)}}
				
				</td>
				<td>
				
					{{$result->JE}}
				
				</td>
				
				<td>
				
					{{round($result->JE-$result->zbdetails->sum('JE'),2)}}
				
				</td>
				<td >
				
			
				{{ $result->zbdetails->count() }}
				</td>
					<td class="small">
				
			
				{{ $result->YSDWMC }}
				</td>
			</tr>	
			@endforeach
		</tbody>
					<tr class='success'>
				<th>科目</th>
				<th>指标ID</th>
				<th>日期</th>
				<th>摘要</th>
	{{-- 			<th>指标来源</th> --}}
				<th>预算项目</th>
				<th>{{round($results->sum('JE')/10000,2)}}</th>
				<th>{{round(($results->sum('JE'))/10000,2)-round($results->sum('detail')/10000,2)}}</th>
				<th>支出数</th>
				<th>单位</th>
			</tr>
	</table>



			<hr>
	
	</h2>
</article>
{{-- {!! Form::open() !!}
 {!! Form::text("name") !!}
{!! Form::close() !!} --}}
@stop