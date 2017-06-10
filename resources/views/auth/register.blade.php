@extends('layouts.default')
@section('title', '注册')

@section('content')
<div class="col-md-offset-2 col-md-8">

  <div class="panel panel-default">
    <div class="panel-heading">
      <h5>注册</h5>
    </div>

    <div class="panel-body">
      @include('shared.errors')
    {!! Form::open(['method' => 'POST', 'route' => 'users.store']) !!}
    {{ csrf_field() }}


        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            {!! Form::label('name', '姓名') !!}
            {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
            <small class="text-danger">{{ $errors->first('name') }}</small>
        </div>
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            {!! Form::label('email', 'Email') !!}
            {!! Form::email('email', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'eg: foo@bar.com']) !!}
            <small class="text-danger">{{ $errors->first('email') }}</small>
        </div>
        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            {!! Form::label('password', 'Password') !!}
            {!! Form::password('password', ['class' => 'form-control', 'required' => 'required']) !!}
            <small class="text-danger">{{ $errors->first('password') }}</small>
        </div>
        <boot
        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
            {!! Form::label('password_confirmation', 'Password Comfirmation') !!}
            {!! Form::password('password_confirmation', ['class' => 'form-control', 'required' => 'required']) !!}
            <small class="text-danger">{{ $errors->first('password_confirmation') }}</small>
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