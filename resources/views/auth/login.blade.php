@extends('layouts.default')
@section('title',"a")
@section('content')

<div class="col-md-offset-2 col-md-8">
<div class="panel panel-default">
	<div class="panel-heading">
		<h5 class="panel-title">登陆</h5>
	</div>
	<div class="panel-body">
		{!! Form::open(['method' => 'POST', 'route' => 'login']) !!}
		
		    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
		        {!! Form::label('email', 'Email address') !!}
		        {!! Form::email('email', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'eg: foo@bar.com']) !!}
		        <small class="text-danger">{{ $errors->first('email') }}</small>
		    </div>
		    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
		        {!! Form::label('password', 'Password') !!}
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
		        {!! Form::reset("Reset", ['class' => 'btn btn-warning']) !!}
		        {!! Form::submit("Add", ['class' => 'btn btn-success']) !!}
		    </div>
		
		{!! Form::close() !!}
	</div>
</div>
</div>
	
@stop



