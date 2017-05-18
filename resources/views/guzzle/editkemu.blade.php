@extends('layouts.default')
@section('title', '更新个人资料')

@section('content')
<div class="col-md-offset-2 col-md-8">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h2>更新指标数据</h2>
    </div>
      <div class="panel-body">

        @include('shared.errors')

        <div class="gravatar_edit">
          <a href="http://gravatar.com/emails" target="_blank">
            <img src="" alt="" class="gravatar"/>
          </a>
        </div>

        <form method="POST" action="{{ route('save') }}">
          <!-- 这里注意route的第二个参数为什么不是[]
          上面代码转为 HTML 后如下所示：

  <form method="POST" action="http://sample.app/users/2">-->
          {{--   {{ method_field('PATCH') }} --}}
            {{ csrf_field() }}


            <input type="hidden" name="id" value={{ $detail->id }}>
            


           
            <div class="form-group">
              <label for="ZY">收款人：</label>
              <input type="text" name="payee" class="form-control" value={{ $detail->payee }}>
            </div>
            <div class="form-group">
              <label for="useable">收款账号：</label>
              <input type="text" name="payeeaccount" class="form-control" value={{ $detail->payeeaccount }}{{ $detail->DZKMC }}>
            </div>
            <div class="form-group">
              <label for="useable">收款银行：</label>
              <input type="text" name="payeebanker" class="form-control" value={{ $detail->payeebanker }}>
            </div>
            <div class="form-group">
              <label for="useable">金额：</label>
              <input type="text" name="amount" class="form-control" value={{ $detail->amount }}>
            </div>
            <div class="form-group">
              <label for="useable">摘要：</label>
              <input type="text" name="zhaiyao" class="form-control" value={{ $detail->zhaiyao }}>
            </div>
            <div class="form-group">
              <label for="useable"><font color="red">指标ID：</font></label>
              <input type="text" name="zbid" class="form-control" value={{ $detail->zbid }}>
            </div>
            <div class="form-group">
              <label for="useable"><font color="black">科目关键字：</font></label>
              <input type="text" name="kemu" class="form-control" value={{ $detail->kemu }}>
            </div>
            <div class="form-group">
              <label for="body"><font color="red">科目(必须带@)：</font></label>
              <textarea type="textarea" name="kemuname" class="form-control" >{{ $detail->kemuname }}</textarea>
            </div>

            <button type="submit" class="btn btn-block btn-success">更新</button>
        </form>
    </div>
  </div>
</div>
@stop
