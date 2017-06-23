@extends('layouts.default')
@section('content')





<h1>枚江镇工资个人汇总({{ $resv[0]['name'] }})</h1>
<h3><center>为保证您个人及单位信息安全，请不要截图发送工资信息给其他人
</center></h3>
<h3><center>首次登陆后，请立即更改您的密码，以免信息泄露
</center></h3>
<h3><center><a href="/edit" "email me">点我修改密码</a>
</center></h3>
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
