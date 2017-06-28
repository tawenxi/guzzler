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
        <li><a href="?export=1">导出excel</a></li>
          @can('showAllSalary')
             <li><a href="/salary">工资</a></li>
          <li><a href="/bumen">月部门</a></li>
          <li><a href="/byear/2017/">分部汇总</a></li>
          <li><a href="/myear/2017/">分月汇总</a></li>
          <li><a href="/geren">个人</a></li>

            <li><a href="/phb">封神榜</a></li>

            @if ( strstr($request->ip(),"192.168") )
            

            <li><a href="/payout">支出</a></li>
            <li><a href="/hyy">外网查询</a></li>
            <li><a href="/dpt">大平台更新</a></li>
            @endif

            @endcan
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                {{ \Auth::check()?Auth::user()->name:"" }} <b class="caret"></b>
              </a>
               @if (\Auth::check())
              <ul class="dropdown-menu">
                
                <li><a href="{{ route('edit') }}">修改密码</a></li>
                @can('showAllSalary')
                <li><a href="/incomes">收入</a></li>
                <li><a href="/income/create">新建收入</a></li>
                <li><a href="/costs">支出</a></li>
                @endcan
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
