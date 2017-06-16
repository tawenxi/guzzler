@extends('layouts.default')
@section('title', '更新个人资料')

@section('content')
<div class="col-md-offset-2 col-md-8">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h5>更新指标数据</h5>
    </div>
      <div class="panel-body">

        @include('shared.errors')

        <div class="gravatar_edit">
          <a href="http://gravatar.com/emails" target="_blank">
            <img src="" alt="" class="gravatar"/>
          </a>
        </div>

        <form method="POST" action="{{ route('postsql') }}">

            {{ csrf_field() }}

        
            <div class="form-group">
              <label for="body"><font color="black">数据库代码：</font></label>
              <hidden type="hidden" name="body" class="form-control" >
            </div>
             <div class="form-group{{ $errors->has('djbh') ? ' has-error' : '' }}">
                {!! Form::label('djbh', '单据编号000 require') !!}
                {!! Form::text('djbh', null, ['class' => 'form-control', 'required' => 'required']) !!}
                <small class="text-danger">{{ $errors->first('djbh') }}</small>
            </div>
            <div class="form-group{{ $errors->has('pid') ? ' has-error' : '' }}">
                {!! Form::label('pid', 'PID require') !!}
                {!! Form::text('pid', null, ['class' => 'form-control', 'required' => 'required']) !!}
                <small class="text-danger">{{ $errors->first('pid') }}</small>
            </div>
            <div class="form-group{{ $errors->has('oldamount') ? ' has-error' : '' }}">
                {!! Form::label('oldamount', '原金额 require') !!}
                {!! Form::text('oldamount', null, ['class' => 'form-control', 'required' => 'required']) !!}
                <small class="text-danger">{{ $errors->first('oldamount') }}</small>
            </div>

            <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                {!! Form::label('amount', '金额 require') !!}
                {!! Form::text('amount', null, ['class' => 'form-control', 'required' => 'required']) !!}
                <small class="text-danger">{{ $errors->first('amount') }}</small>
            </div>
            <div class="form-group{{ $errors->has('zy') ? ' has-error' : '' }}">
                {!! Form::label('zy', '摘要 require') !!}
                {!! Form::text('zy', null, ['class' => 'form-control', 'required' => 'required']) !!}
                <small class="text-danger">{{ $errors->first('zy') }}</small>
            </div>

            <div class="form-group{{ $errors->has('payee') ? ' has-error' : '' }}">
                {!! Form::label('payee', '收款人') !!}
                {!! Form::text('payee', null, ['class' => 'form-control']) !!}
                <small class="text-danger">{{ $errors->first('payee') }}</small>
            </div>

            <div class="form-group{{ $errors->has('account') ? ' has-error' : '' }}">
                {!! Form::label('account', '账号') !!}
                {!! Form::text('account', null, ['class' => 'form-control']) !!}
                <small class="text-danger">{{ $errors->first('account') }}</small>
            </div>
            <div class="form-group{{ $errors->has('banker') ? ' has-error' : '' }}">
                {!! Form::label('banker', '收款银行') !!}
                {!! Form::text('banker', null, ['class' => 'form-control']) !!}
                <small class="text-danger">{{ $errors->first('banker') }}</small>
            </div>
          

            <button type="submit" class="btn btn-block btn-success">发送</button>
        </form>
    </div>
  </div>
</div>
@stop
