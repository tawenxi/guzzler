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
				<th>时间</th><th>摘要</th><th>收款人</th><th>金额</th><th>科目</th><th>指标ID</th>
			<th>T</th>
			<th>D</th></tr>
		</thead>
		<tbody class='alert-info'>
				@foreach ($payoutdatas as $payoutdata)
			<tr>
				<td>
				
					{{substr($payoutdata->created_at, 0,10)}}
				
				</td>

				<td>
				
										<a href= {{ route('editkemu',$payoutdata->id)  }} ><font style="color:green">{{$payoutdata->zhaiyao}}</font></a>
				
				
				</td>
				<td>
				
					{{$payoutdata->payee}}
				
				</td>
				<td>
				
					{{$payoutdata->amount}}
				
				</td>
				<td>
				
					{{  substr($payoutdata->kemuname, 1+strpos($payoutdata->kemuname, "@"))}}
				
				</td>
								<td>
				
					{{substr($payoutdata->zbid, -4)}}

				
				</td>
				<td>
				
							<font style="font-size: 2px " >{{  substr($payoutdata->kemuname, 0,strpos($payoutdata->kemuname, "@"))}}&
							{{ $payoutdata->zhaiyao }}&
							{{ $payoutdata->amount }}&
							1001&
							001</font>
							
				
				</td>

				<td>
				
		<form action="{{ route('delete', $payoutdata->id) }}" method="post">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <button type="submit" class="btn btn-sm btn-danger delete-btn">删除</button>
      </form>

				
				</td>

			</tr>	
			@endforeach
		</tbody>
	{!! $payoutdatas->render() !!}
	</table>







			<hr>
	
	</h2>
</article>
{{-- {!! Form::open() !!}
 {!! Form::text("name") !!}
{!! Form::close() !!} --}}
@stop