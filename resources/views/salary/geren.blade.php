@extends('layouts.default')
@section('content')





<h1>枚江镇工资个人汇总({{ $resv[0]['name'] }})</h1>
@include('shared.errors')

<article>
	
	<h2>
	<table class="table table-bordered table-striped table-hover table-condensed">
		<caption><center>{{ date("Y-m-d H:i:s") }}</center></caption>

		<thead>
			<tr class='success'>
				
				<th>日期</th>
				{{-- <th>账号</th> --}}


				@include('salary.table')
</article>

@stop
