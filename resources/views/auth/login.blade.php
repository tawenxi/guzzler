@extends('layouts.default')
@section('title',"")
@section('content')

<div class="col-md-offset-2 col-md-8">
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title" ><center><b><h3>登 陆	</h3></b></center></h3>
	</div>
	<div class="panel-body">
		{!! Form::open(['method' => 'POST', 'route' => 'login']) !!}
		{{ csrf_field() }}
<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    {!! Form::label('name', '姓名') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
    <small class="text-danger">{{ $errors->first('name') }}</small>
</div>
		    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
		        {!! Form::label('password', '密码') !!}
		        {!! Form::password('password', ['class' => 'form-control', 'required' => 'required']) !!}
		        <small class="text-danger">{{ $errors->first('password') }}</small>
		    </div>
		    <div class="form-group">
		        <div class="checkbox{{ $errors->has('remember') ? ' has-error' : '' }}">
		            <label for="remember">
		                {!! Form::checkbox('remember', '1', null, ['id' => 'remember']) !!} 记住我
		            </label>
		        </div>
		        <small class="text-danger">{{ $errors->first('remember') }}</small>
		    </div>
		
		    <div class="btn-group btn-block">
		        
		        {!! Form::submit("登陆", ['class' => 'btn btn-success']) !!}
		    </div>
		
		{!! Form::close() !!}
	</div>
</div>
</div>
	
@stop



