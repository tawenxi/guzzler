@extends('layouts.default')
@section('title', $user->name)
@section('content')


<div class="row">
  <div class="col-md-offset-2 col-md-8">
    <div class="col-md-12">
      <div class="col-md-offset-2 col-md-8">
        <section class="user_info">
          @include('shared.user_info', ['user' => $user])
          <!-- {{session()->put('success1','222')}}
          {{session()->get('success1')}} session 是有效的-->
        

          <!-- //shared.user_info 是绝对路径 include 的第二个参数是变量传递 -->
        </section>
      </div>
    </div>
  </div>
</div>


@stop
