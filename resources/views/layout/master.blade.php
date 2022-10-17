<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    
    @yield('jscss-urls')
</head>
<body>
@include('sweetalert::alert')
@yield('content')  
   
@yield('js')
  
</body>
</html>
