<!DOCTYPE html>
<html>
  <head>
      @include('includes.head')
      @yield('head_page')
  </head>
  <body class="app">

      @yield('content')


      @include('includes.footer')
      @yield('footer_page')

  </body>
</html>
