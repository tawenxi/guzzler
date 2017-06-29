<!DOCTYPE html>
<html>
  <head>
    <title>@yield('title', '枚江镇财务查询系统')</title>
    <link rel="stylesheet" href={{ asset('css/app.css') }}>
  </head>
  <body>
@can('export')
    @include('layouts._header')
@endcan
    <div class="container">
      <div class="col-md-offset-0 col-md-12">
        @include('shared.messages')
        @include('shared.errors')
        @yield('content')
@can('export')
        @include('layouts._footer')
@endcan
      </div>
    </div>
      <script src="/js/app.js"></script>
  </body>
</html>
