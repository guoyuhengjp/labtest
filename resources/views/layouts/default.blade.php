<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'Weibo App') 个人主页</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>
@include('layouts._header')

<div class="container" id="app">
    <div class="offset-md-1 col-md-10">
        @yield('content')
    </div>
</div>

<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
