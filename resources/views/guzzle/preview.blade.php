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
			@foreach ($collection as $ar)
			<tr>
				<td>
				
					{{$ar['zhaiyao']}}
				
				</td>
				<td>
				
					{{$ar['payee']}}
				
				</td>
				<td>
				
					{{$ar['payeeaccount']}}
				
				</td>
				<td>
				
					{{$ar["payeebanker"]}}
				
				</td>
				<td>
				
					{{$ar['amount']}}
				
				</td>
				<td>
				
					{{$ar["zbid"]}}

				
				</td>
			</tr>	
			@endforeach
			<tr>	<td colspan=6 align="center">
				{{ $collection->sum('amount') }}
			</td>	</tr>	
			


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