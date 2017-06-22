@extends('layouts.default')
@section('title', '更新个人资料')

@section('content')
<div class="col-md-offset-2 col-md-8">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h5>增加收入数据</h5>
    </div>
      <div class="panel-body">

        @include('shared.errors')

  

       {!! Form::open(['method' => 'POST', 'route' => 'income.store', 'class' => 'form-horizontal']) !!}
          {{ csrf_field() }}
           <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
               {!! Form::label('date', '日期') !!}
               {!! Form::text('date', null, ['class' => 'form-control', 'required' => 'required']) !!}
               <small class="text-danger">{{ $errors->first('date') }}</small>
           </div>

           <div class="form-group{{ $errors->has('zhaiyao') ? ' has-error' : '' }}">
               {!! Form::label('zhaiyao', '摘要') !!}
               {!! Form::text('zhaiyao', null, ['class' => 'form-control', 'required' => 'required']) !!}
               <small class="text-danger">{{ $errors->first('zhaiyao') }}</small>
           </div>

           <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
               {!! Form::label('amount', '金额') !!}
               {!! Form::text('amount', null, ['class' => 'form-control', 'required' => 'required']) !!}
               <small class="text-danger">{{ $errors->first('amount') }}</small>
           </div>

           <div class="form-group{{ $errors->has('xingzhi') ? ' has-error' : '' }}">
               {!! Form::label('xingzhi', '性质') !!}
               {!! Form::text('xingzhi', null, ['class' => 'form-control', 'required' => 'required']) !!}
               <small class="text-danger">{{ $errors->first('xingzhi') }}</small>
           </div>

           <div class="form-group{{ $errors->has('cost') ? ' has-error' : '' }}">
               {!! Form::label('cost', '已用金额') !!}
               {!! Form::text('cost', null, ['class' => 'form-control', 'required' => 'required']) !!}
               <small class="text-danger">{{ $errors->first('cost') }}</small>
           </div>

           <div class="form-group{{ $errors->has('kemu') ? ' has-error' : '' }}">
               {!! Form::label('kemu', '科目') !!}
               {!! Form::text('kemu', null, ['class' => 'form-control', 'required' => 'required']) !!}
               <small class="text-danger">{{ $errors->first('kemu') }}</small>
           </div>

           <div class="form-group{{ $errors->has('beizhu') ? ' has-error' : '' }}">
               {!! Form::label('beizhu', '备注') !!}
               {!! Form::text('beizhu', null, ['class' => 'form-control', 'required' => 'required']) !!}
               <small class="text-danger">{{ $errors->first('beizhu') }}</small>
           </div>

       
           <div class="btn-group pull-right">
               
               {!! Form::submit("Add", ['class' => 'btn btn-success']) !!}
           </div>
       
       {!! Form::close() !!}
    </div>
  </div>
</div>
@stop
