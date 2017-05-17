@extends('layouts.default')
@section('content')
<h1>枚江乡授权支付支出明细表</h1>
@include('shared.errors')

<article>
	
	<h2>
	<table class="table table-bordered table-striped table-hover table-condensed">
		<caption><center>{{ date("Y-m-d H:i:s") }}</center></caption>

		<thead>
			<tr class='success'>
				<th>摘要</th><th>收款人</th><th>金额</th><th>科目</th><th>指标ID</th>
			</tr>
		</thead>
		<tbody class='alert-info'>
				@foreach ($payoutdatas as $payoutdata)
			<tr>

				<td>
				
					{{$payoutdata->zhaiyao}}
				
				</td>
				<td>
				
					{{$payoutdata->payee}}
				
				</td>
				<td>
				
					{{$payoutdata->amount}}
				
				</td>
				<td>
				
					{{$payoutdata->kemuname}}
				
				</td>
								<td>
				
					{{$payoutdata->zbid}}
				
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