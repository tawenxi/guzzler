<!DOCTYPE html>
<html>
  <head>
    <title>@yield('title', '枚江镇财务查询系统')</title>
    <link rel="stylesheet" href="/css/app.css">
  </head>
  <body>
    @include('layouts._header')

    <div class="container">
      <div class="col-md-offset-0 col-md-12">
        @include('shared.messages')
        @include('shared.errors')
        @yield('content')
        @include('layouts._footer')
      </div>
    </div>
      <script src="/js/app.js"></script>
  </body>
</html>
