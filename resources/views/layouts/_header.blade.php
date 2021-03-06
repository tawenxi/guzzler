@inject('request',"Illuminate\Http\Request")
<header class="navbar navbar-fixed-top navbar-inverse">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
  <div class="container">
    <div class="col-md-offset-0 col-md-12">

     @if (\Auth::check())
       
     
      <a href="{{ (\Auth::user()->id==39)?'/preview':'/geren'}}" id="logo">枚江镇</a>
      @else
<a href="" id="logo">枚江镇工资查询系统</a>
      @endif
      <nav>
        <ul class="nav navbar-nav navbar-right">
        <li><a href="{{ url().'/'.\Request::getRequestUri().(stristr(Request::getRequestUri(), '?')?'&':'?').'export=1' }}">导出excel</a></li>
        

          @can('showAllSalary')     
         
             <li><a href="/searchacc">查询</a></li> 
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                 大平台 <b class="caret"></b>
                </a>
                
                <ul class="dropdown-menu">      

                  <li><a href="/payout">授权登记</a></li>
                  <li><a href="/hyy">外网查询</a></li>
                  <li><a href="/dpt">平台更新</a></li>   
                    <li class="divider"></li>
                </ul>
              </li>
       
          @endcan

          @can('showAllSalary')     
         
            
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                 指标查询 <b class="caret"></b>
                </a>
                
                <ul class="dropdown-menu">      
                <li><a href="/inco">收支对照</a></li>
                <li><a href="/zhibiao">[收入(update)]</a></li>
                <li><a href="/zbdetail">[支出]</a></li>
                <li><a href="/incomes">收入</a></li>
                
                <li><a href="/costs">支出</a></li>
                <li><a href="/income/create">新建收入</a></li> 
                    <li class="divider"></li>
                </ul>
              </li>
        
          @endcan


          @can('showAllSalary')     
       
            
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                 知乎 <b class="caret"></b>
                </a>
                
                <ul class="dropdown-menu">      

                <li><a href="http://zhihu.app/zhibiao">[收入]</a></li>
                <li><a href="http://zhihu.app/zbdetail">[支出]</a></li>

                </ul>
              </li>
        
          @endcan

                 

          

 

          @can('showAllSalary')
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                 工资 <b class="caret"></b>
                </a>
                
                <ul class="dropdown-menu">      
                    <li><a href="">月工资表</a></li>
                    <li><a href="/bumen">月部门</a></li>
                    <li><a href="/byear/2017/">分部汇总</a></li>
                    <li><a href="/myear/2017/">分月汇总</a></li>
                    <li><a href="/geren">个人</a></li>
                    <li><a href="/phb">封神榜</a></li>     
                    <li class="divider"></li>
                </ul>
              </li>
          @endcan              












            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                {{ \Auth::check()?Auth::user()->name:"" }} <b class="caret"></b>
              </a>
               @if (\Auth::check())
              <ul class="dropdown-menu">
                
                <li><a href="{{ route('edit') }}">修改密码</a></li>

                <li class="divider"></li>
                <li>
                  <a id="logout" href="#">
                    <form action="{{ route('logout') }}" method="POST">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                      <button class="btn btn-block btn-danger" type="submit" name="button">退出</button>
                    </form>
                  </a>
                </li>
      
              </ul>
              @endif
            </li>
       
       
           
          
        </ul>
      </nav>
    </div>
  </div>
</header>
