@extends('layouts.default')
@section('content')
@include('salary.date')




<h1>枚江镇工资花名册({{ $resv[0]->date }})</h1>
@include('shared.errors')

<article>

	<h2>
	<table class="table table-bordered table-striped table-hover table-condensed">
		<caption><center>{{ date("Y-m-d H:i:s") }}</center></caption>

		<thead>
			<tr class='success'>
				<th>ID</th>
				
				{{-- <th>账号</th> --}}

@include('salary.table')
</article>

@stop
