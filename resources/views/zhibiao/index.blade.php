@extends('layouts.default')
@section('content')
<h1>枚江镇授权支付指标明细表</h1>
@include('shared.errors')

<article>
	
	<h2>
	<table class="table table-bordered table-striped table-hover table-condensed">
		<caption><center>{{ date("Y-m-d H:i:s") }}</center></caption>

		<thead>
			<tr class='success'>
				<th>指标ID</th>
				<th>摘要</th>
				<th>预算项目</th>
				<th>总金额</th>
				<th>可用金额</th>
				<th>编辑</th>
			</tr>
		</thead>
		<tbody class='alert-info'>
				@foreach ($results as $result)
			<tr class={{ empty($result->body)?'alert-danger':""}}>
				<td>
				
					<a href="showzbdetail/{{ $result->ZBID }}">{{$result->ZBID}} 

					</a>
				
				</td>
				<td>
				
					{{$result->ZY}}
				
				</td>
				<td>
				
					{{$result->ZJXZMC}}
				
				</td>
				<td>
				
					{{$result->JE}}
				
				</td>
				
				<td>
				
					{{round($result->JE-$result->zbdetails->sum('JE'),2)}}
				
				</td>
				<td class='btn btn-link'>
				
			{!! Form::open(['method' => 'get', 'route' => ['guzzle.edit',$result->id], 'class' => 'form-horizontal']) !!}
          {!! Form::submit('编辑', ['class' => 'btn btn-success pull-right']) !!}
          
          {!! Form::close() !!}
				
				</td>
			</tr>	
			@endforeach
		</tbody>
					<tr class='success'>
				<th>指标ID</th>
				<th>摘要</th>
				<th>预算项目</th>
				<th>{{($results->sum('YKJHZB'))/10000}}</th>
				<th>{{$results->sum('KYJHJE')/10000}}</th>
				<th>编辑</th>
			</tr>
	</table>



			<hr>
	
	</h2>
</article>
{{-- {!! Form::open() !!}
 {!! Form::text("name") !!}
{!! Form::close() !!} --}}
@stop