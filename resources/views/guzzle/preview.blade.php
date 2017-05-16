@extends('layouts.default')
@section('content')
<h1>枚江乡授权支付指标明细表</h1>
@include('shared.errors')

<article>
	
	<h2>
	<table class="table table-bordered table-striped table-hover table-condensed">
		<caption><center>{{ date("Y-m-d H:i:s") }}</center></caption>

		<thead>
			<tr class='success'>
				<th>摘要</th><th>收款人</th><th>收款账号</th><th>收款银行</th><th>金额</th><th>指标来源</th>
			</tr>
		</thead>
		<tbody class='alert-info'>
				@foreach ($arr as $ar)
			<tr>
				<td>
				
					{{$ar[4]}}
				
				</td>
				<td>
				
					{{$ar[0]}}
				
				</td>
				<td>
				
					{{$ar[1]}}
				
				</td>
				<td>
				
					{{$ar[2]}}
				
				</td>
				<td>
				
					{{$ar[3]}}
				
				</td>
				<td>
				
					{{$ar[5]}}
				
				</td>
			</tr>	
			@endforeach
		</tbody>
	</table>

	<a href="/guzzle"><p class="btn btn-block btn-success">确认无误</p></a>
	



			<hr>
	
	</h2>
</article>
{{-- {!! Form::open() !!}
 {!! Form::text("name") !!}
{!! Form::close() !!} --}}
@stop