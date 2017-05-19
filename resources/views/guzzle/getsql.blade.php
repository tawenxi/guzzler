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
              <textarea type="textarea" name="body" class="form-control" ></textarea>
            </div>

            <button type="submit" class="btn btn-block btn-success">发送</button>
        </form>
    </div>
  </div>
</div>
@stop
