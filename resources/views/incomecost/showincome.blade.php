@extends('layouts.default')
@section('content')
<h1>枚江镇收入指标明细表(<a href="/incomes/1" "email me">1</a>)</h1>
@include('shared.errors')

<article>
  
  <h2>
  <table class="table table-bordered table-striped table-hover table-condensed">
    <caption><center>{{ date("Y-m-d H:i:s") }}</center></caption>

    <thead>
      <tr class='success'>
        <th>id</th>
        <th>日期</th>
        <th>摘要</th>
        <th>性质</th>
        <th>总金额</th>
        <th>已用金额</th>
        <th>剩余金额</th>
        <th>科目</th>
        <th>备注</th>
        @can('delete')
        <th>编辑</th>
        <th>删除</th>
        @endcan
      </tr>
    </thead>
    <tbody class='alert-info'>
        @foreach ($incomes as $income)
      <tr class={{ 


        ($income->amount==$income->costs->sum('amount')||strstr($income->beizhu,'已付完'))?'alert-danger':""}}  >
        <td>
          {{ $income->id }}
        </td>
        <td>
        
          


          <font >{{$income->date}}</font> 

         
        
        </td>
        <td>
        <a href="/cost/{{ $income->id }}">
          {{$income->zhaiyao}}
         </a>
        </td>
        <td>
        
          <font color={{  ($income->xingzhi=='扶贫整合资金')?'Green':'' }}> {{$income->xingzhi}}</font> 
        
        </td>
        <td>
        
          {{$income->amount}}
        
        </td>
        
        <td>
        
          {{$income->costs->sum('amount')}}
        
        </td>
                <td>
        
          {{$income->remain_amount}}
        
        </td>
           <td>
        
         {{--  {{substr($income->kemu, 1+strpos($income->kemu,"@"))}} --}}
          {{$income->kemu }}
        
        </td>
               <td>
        
          {{$income->beizhu}}
        
        </td>
        @can('delete')
        <td>
        
      {!! Form::open(['method' => 'get', 'route' => ['income.edit',$income->id], 'class' => 'form-horizontal']) !!}
          {!! Form::submit('编辑', ['class' => 'btn btn-success pull-right']) !!}
          
          {!! Form::close() !!}
        
        </td>
                <td >
        
      {!! Form::open(['method' => 'delete', 'route' => ['income.destroy',$income->id], 'class' => 'form-horizontal']) !!}
          {!! Form::submit('删除', ['class' => 'btn btn-danger pull-right']) !!}
          
          {!! Form::close() !!}
        
        </td>
        @endcan
      </tr> 
      @endforeach
      <thead>
      <tr class='success'>
        <th>id</th>
        <th>日期</th>
        <th>摘要</th>
        <th>性质</th>
        <th>{{ $incomes->sum('amount') }}</th>
        <th>{{ $incomes->sum('has_costed') }}</th>
        <th>{{ $incomes->sum('remain_amount') }}</th>
        <th>科目</th>
        <th>拨付率{{ $incomes->sum('has_costed')/$incomes->sum('amount') }}</th>
        @can('delete')
        <th>编辑</th>
        <th>删除</th>
        @endcan
      </tr>
    </thead>
    </tbody>
  </table>



      <hr>
  
  </h2>
</article>
{!! $incomes->render() !!}
{{-- {!! Form::open() !!}
 {!! Form::text("name") !!}
{!! Form::close() !!} --}}
@stop