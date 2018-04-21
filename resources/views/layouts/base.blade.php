<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME') }} - @yield('title')</title>
    <link href="{{ asset('bootstrap/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('customer/admin_style.css?v=2') }}" rel="stylesheet">
    @section('othercss')@show
</head>
<body>

@yield('content')

<script src="{{ asset('js/jquery-1.9.1.min.js') }}"></script>
<script src="{{ asset('bootstrap/js/bootstrap.js') }}"></script>
<script src="{{ asset('artDialog/artDialog.js?skin=black') }}"></script>
@section('otherjs')@show
<script src="{{ asset('customer/admin_script.js?v=79') }}"></script>
</body>
</html>