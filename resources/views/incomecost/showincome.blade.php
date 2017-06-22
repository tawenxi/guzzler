@extends('layouts.default')
@section('content')
<h1>枚江镇收入指标明细表</h1>
@include('shared.errors')

<article>
  
  <h2>
  <table class="table table-bordered table-striped table-hover table-condensed">
    <caption><center>{{ date("Y-m-d H:i:s") }}</center></caption>

    <thead>
      <tr class='success'>
        <th>日期</th>
        <th>摘要</th>
        <th>性质</th>
        <th>总金额</th>
        <th>已用金额</th>
        <th>科目</th>
        <th>备注</th>
        <th>编辑</th>
        <th>删除</th>
      </tr>
    </thead>
    <tbody class='alert-info'>
        @foreach ($incomes as $income)
      <tr class={{ ($income->amount==$income->costs->sum('amount'))?'alert-danger':""}}>
        <td>
        
          <a href="cost/{{ $income->id }}">{{$income->date}} 

          </a>
        
        </td>
        <td>
        
          {{$income->zhaiyao}}
        
        </td>
        <td>
        
          {{$income->xingzhi}}
        
        </td>
        <td>
        
          {{$income->amount}}
        
        </td>
        
        <td>
        
          {{$income->costs->sum('amount')}}
        
        </td>
           <td>
        
          {{substr($income->kemu, 1+strpos($income->kemu,"@"))}}
        
        </td>
               <td>
        
          {{$income->beizhu}}
        
        </td>
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
      </tr> 
      @endforeach
    </tbody>
  </table>



      <hr>
  
  </h2>
</article>
{{-- {!! Form::open() !!}
 {!! Form::text("name") !!}
{!! Form::close() !!} --}}
@stop