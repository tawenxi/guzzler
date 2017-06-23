@extends('layouts.default')
@section('content')
<h1>枚江乡直接支付支出明细表</h1>
@include('shared.errors')

<article>
  
  <h2>
  <table class="table table-bordered table-striped table-hover table-condensed">
    <caption><center>{{ date("Y-m-d H:i:s") }}</center></caption>

    <thead>
        <tr>
      总金额：{{ $costs->sum('amount') }}
    </tr>
      <tr class='success'>
        <th>时间</th><th>摘要</th><th>收款人</th><th>金额</th><th>科目</th><th>Income ID</th>
     @can('delete')
     <th>D</th>
     @endcan
     </tr>
    </thead>

    <tbody class='alert-info'>
        @foreach ($costs as $cost)
      <tr>
        <td>      
          {{substr($cost->date, 0,10)}}     
        </td>

        <td>
        
          <a href= {{ route('editkemu',$cost->id)  }} ><font style="color:green">{{$cost->zhaiyao}}</font></a>
        
        </td>
        <td>
          {{$cost->payee}}</td>
        <td>{{$cost->amount}}</td>
        <td>{{  substr($cost->kemu, 36+strpos($cost->kemu, "@"))}}

       
        </td>
 
        <td>{{$cost->income->zhaiyao}}</td>
       @can('delete')
        <td><form action="{{ route('delete', $cost->id) }}" method="post">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <button type="submit" class="btn btn-sm btn-danger delete-btn">删除</button>
      </form></td>
      @endcan
      </tr> 

      @endforeach

    </tbody>
  {!! $costs->render() !!}
  </table>
      <hr>
  
  </h2>
</article>
{!! $costs->render() !!}
{{-- {!! Form::open() !!}
 {!! Form::text("name") !!->appends(['order' => $a,'my' => $my])}
{!! Form::close() !!} --}}
@stop