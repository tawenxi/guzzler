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

        <form method="POST" action="{{ route('store') }}">
          <!-- 这里注意route的第二个参数为什么不是[]
          上面代码转为 HTML 后如下所示：

  <form method="POST" action="http://sample.app/users/2">-->
          {{--   {{ method_field('PATCH') }} --}}
            {{ csrf_field() }}

            <div class="form-group">
              <label for="zbid">指标ID</label>
              <input type="text" name="zbid" class="form-control" value={{ $guzzledb->ZBID }}>
            </div>
            <input type="hidden" name="id" value={{ $guzzledb->id }}>
            


            <div class="form-group">
              <label for="total">总金额：</label>
              <input type="text" name="total" class="form-control" value={{ $guzzledb->YKJHZB }} disabled>
            </div>

            <div class="form-group">
              <label for="used">已用指标:</label>
              <input type="text" name="used" class="form-control" value={{ $guzzledb->YYJHJE }}>
            </div>

            <div class="form-group">
              <label for="useable"><font color="red">可用金额：</font></label>
              <input type="text" name="useable" class="form-control" value={{ $guzzledb->KYJHJE }}>

            </div>
            <div class="form-group">
              <label for="ZY">摘要：</label>
              <input type="text" name="ZY" class="form-control" value={{ $guzzledb->ZY }}>
            </div>
            <div class="form-group">
              <label for="useable">归口股室：</label>
              <input type="text" name="gushi" class="form-control" value={{ $guzzledb->DZKDM }}{{ $guzzledb->DZKMC }}>
            </div>
            <div class="form-group">
              <label for="useable">资金性质：</label>
              <input type="text" name="zjxz" class="form-control" value={{ $guzzledb->ZJXZDM }}{{ $guzzledb->ZJXZMC }}>
            </div>
            <div class="form-group">
              <label for="useable">功能分类：</label>
              <input type="text" name="gnfl" class="form-control" value={{ $guzzledb->YSKMDM }}{{ $guzzledb->YSKMMC }}>
            </div>
            <div class="form-group">
              <label for="useable">经济分类：</label>
              <input type="text" name="jjfl" class="form-control" value={{ $guzzledb->JFLXDM }}{{ $guzzledb->JFLXMC }}>
            </div>
            <div class="form-group">
              <label for="useable"><font color="red">预算项目：</font></label>
              <input type="text" name="ysxm" class="form-control" value={{ $guzzledb->XMDM }}{{ $guzzledb->XMMC }}>
            </div>
            <div class="form-group">
              <label for="useable"><font color="black">指标来源：</font></label>
              <input type="text" name="zbly" class="form-control" value={{ $guzzledb->ZBLYDM }}{{ $guzzledb->ZBLYMC }}>
            </div>
            <div class="form-group">
              <label for="body"><font color="black">数据源：</font></label>
              <textarea type="textarea" name="body" class="form-control" >{{ $guzzledb->body }}</textarea>
            </div>

            <button type="submit" class="btn btn-block btn-success">更新</button>
        </form>
    </div>
  </div>
</div>
@stop
