<header class="navbar navbar-fixed-top navbar-inverse">
  <div class="container">
    <div class="col-md-offset-0 col-md-12">
      <a href="/preview" id="logo">拨款按钮</a>
      <nav>
        <ul class="nav navbar-nav navbar-right">
          @if (Auth::check())
            <li><a href="{{ route('users.index') }}">用户列表</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                {{ Auth::user()->name }} <b class="caret"></b>
              </a>
              <ul class="dropdown-menu">
                <li><a href="{{ route('users.show', Auth::user()->id) }}">个人中心</a></li>
                <li><a href="{{ route('users.edit', Auth::user()->id) }}">编辑资料</a></li>
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
            </li>
          @else
          <li><a href="/salary">工资</a></li>
          <li><a href="/bumen?date=201705">月部门</a></li>
          <li><a href="/byear/2017/">分部汇总</a></li>
          <li><a href="/myear/2017/">分月汇总</a></li>
          <li><a href="/geren?id=39">个人</a></li>
            <li><a href="/payout">支出</a></li>
            <li><a href="/hyy">外网查询</a></li>
            <li><a href="/dpt">大平台更新</a></li>
           
          @endif
        </ul>
      </nav>
    </div>
  </div>
</header>
