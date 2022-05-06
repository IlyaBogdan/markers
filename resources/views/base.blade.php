<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    @yield('static')
    <title>@yield('title')</title>
</head>
<body>
    @yield('public')
    @yield('private')
</body>
</html>