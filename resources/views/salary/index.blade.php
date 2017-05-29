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
				<th>ID</th><th>姓名</th><th>基本工资</th><th>津补贴</th><th>应发合计</th>
			</tr>
		</thead>
		<tbody class='alert-info'>

				@foreach ($res as $re)
			<tr class={{ empty($re->id)?'alert-danger':""}}>
				<td>
				
					<a href="{{ $re->name }}/show">{{$re->name}} 

					</a>
				
				</td>
				<td>
				
					{{$re->name}}
				
				</td>
				<td>
				
					{{$re->jiben_gz}}
				
				</td>
				<td>
				
					{{$re->jinbutie}}
				
				</td>
				<td class='btn btn-link'>
				
					<a href="edit/{{ $re->ok }}" > 编辑</a>
				
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