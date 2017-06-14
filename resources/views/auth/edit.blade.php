@extends('layouts.default')
@section('title',"用户编辑")
@section('content')
	<div class="col-md-offset-1 col-md-10">
	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title">用户编辑</h3>
		</div>
		<div class="panel-body">
			{!! Form::model($user, ['route' => ['update']]) !!}
			<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
			    
			    {!! Form::text('name',old($user->name), ['class' => 'form-control hidden', 'required' => 'required']) !!}
			    <small class="text-danger">{{ $errors->first('name') }}</small>
			</div>

			<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
			    {!! Form::label('email', 'email') !!}
			    {!! Form::text('email',old($user->email), ['class' => 'form-control', 'required' => 'required']) !!}
			    <small class="text-danger">{{ $errors->first('email') }}</small>
			</div>

			<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
			    {!! Form::label('password', '密码') !!}
			    {!! Form::password('password', ['class' => 'form-control', 'required' => 'required']) !!}
			    <small class="text-danger">{{ $errors->first('password') }}</small>
			</div>
			<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
			    {!! Form::label('password', '确认密码') !!}
			    {!! Form::password('password', ['class' => 'form-control', 'required' => 'required']) !!}
			    <small class="text-danger">{{ $errors->first('password') }}</small>
			</div>
		
			    
			
				<div class="btn-group btn-block">
				{!! Form::submit('修改资料', ['class' => 'btn btn-info']) !!}
				</div>
			
			{!! Form::close() !!}
		</div>
	</div>
		
	</div>
@stop
	

