<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('publisher/css/theme_2/img/apple-icon.png')}}">
    <link rel="icon" type="image/png" href="{{asset('publisher/css/theme_2/img/favicon.png')}}">
    <title>SIGIAY.VN - Chuyên hàng nữ hot trend</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet"/>
    <link href="{{asset('publisher/css/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('publisher/css/fontawesome.css')}}" rel="stylesheet"/>
    <link href="{{asset('publisher/css/common.css')}}?v={{time()}}" rel="stylesheet"/>
    <link href="{{asset('publisher/css/sidenav.css')}}?v={{time()}}" rel="stylesheet"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        const cdn_static_file = "{{config("app.cdn_static_file")}}";
    </script>
    @stack('css')
</head>
