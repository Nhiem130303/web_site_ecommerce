<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{asset('publisher/css/bootstrap/css/bootstrap.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('publisher/theme_1/css/layout.css')}}">
    <link rel="stylesheet" href="{{asset('publisher/theme_1/css/home.css')}}">
    </head>
<body class="g-sidenav-show  bg-gray-100">
<div class="page-header bg-gradient-primary  position-relative m-3 border-radius-xl">
    <img src="{{asset('publisher/theme_1/images/waves-white.svg')}}" alt="pattern-lines"
         class="position-absolute opacity-6 start-0 top-0 w-100">
    <div class="container pb-5 pb-7 pt-5 position-relative z-index-3">
        <div class="row mb-5">
            <div class="col-md-4 color-white">Soft UI Dashboard PRO</div>
            <div class="col-md-4 ms-auto text-end color-white">
                <a class="btn  color-white cursor-pointer" href="{{route('publisher.login.show')}}">Đăng nhập</a>/<a
                        class="btn  color-white cursor-pointer" href="{{route('publisher.register.show')}}">Đăng ký</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mx-auto text-center">
                <h3 class="text-white">My Store</h3>
                <p class="text-white">Nền tảng giúp bạn xây dựng publishersite bán hàng của cho riêng mình.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 col-7 mb-5 mx-auto text-center">
                <div class="nav-wrapper mt-5 position-relative z-index-2">
                    <ul class="nav nav-pills nav-fill flex-row p-1" id="tabs-pricing" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="btn btn-outline-light  btn-lg" href="">
                                Đăng ký dùng thử miễn phí
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container my-6">
    <div class="row mt-8">
        <div class="col-md-6 mx-auto text-center">
            <h2>Frequently Asked Questions</h2>
            <p>A lot of people don't appreciate the moment until it’s passed. I'm not trying my hardest, and I'm not
                trying to do </p>
        </div>
    </div>
</div>

<footer class="footer py-5">
    <div class="container">
        <div class="row">
            <div class="col-8 mx-auto text-center mt-1">
                <p class="mb-0 text-secondary">
                    Copyright ©
                    <script>
                        document.write(new Date().getFullYear())
                    </script>
                    2023 Soft by Phở Team.
                </p>
            </div>
        </div>
    </div>
</footer>
<script src="{{asset('publisher/css/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
</body>
</html>