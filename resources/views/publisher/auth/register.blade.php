<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('publisher/css/theme_2/img/apple-icon.png')}}">
    <link rel="icon" type="image/png" href="{{asset('publisher/css/theme_2/img/favicon.png')}}">
    <title>
        Soft UI Dashboard by Creative Tim
    </title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet"/>
    <link href="{{asset('publisher/css/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('publisher/css/fontawesome.css')}}" rel="stylesheet"/>
    <link href="{{asset('publisher/css/nucleo-icons.css')}}" rel="stylesheet"/>
    <link href="{{asset('publisher/css/nucleo-svg.css')}}" rel="stylesheet"/>
    <link href="{{asset('publisher/css/soft-ui-dashboard.css')}}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{asset('publisher/css/sign_up.css')}}">
</head>
<body class="g-sidenav-show  bg-gray-100">
<main class="main-content mt-0 ps">
    <section>
        <div class="page-header min-vh-100">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                        <div class="card card-plain">
                            <div class="card-header pb-0 text-left">
                                <h4 class="font-weight-bolder">Sign Up</h4>
                                <p class="mb-0">Enter your email and password to register</p>
                            </div>
                            <div class="card-body pb-3">

                                <form action="{{route('publisher.register.create')}}" method="post">
                                    @csrf
                                    <label>Name</label>
                                    <div class="mb-3">
                                        <input type="text" value="{{old('name')}}" name="name" class="form-control"
                                               placeholder="Name" aria-label="Name">
                                        @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <label>Email</label>
                                    <div class="mb-3">
                                        <input type="text" value="{{old('email')}}" name="email" class="form-control"
                                               placeholder="Email" aria-label="Email">
                                        @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <label>Password</label>
                                    <div class="mb-3">
                                        <input type="password" value="{{old('password')}}" name="password"
                                               class="form-control" placeholder="Password"
                                               aria-label="Password">
                                        @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-check form-check-info text-left">
                                        <input class="form-check-input" name="" type="checkbox" value=""
                                               id="flexCheckDefault"
                                               checked="">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            I agree the <a href="../../../pages/privacy.html"
                                                           class="text-dark text-decoration-none font-weight-bolder">Terms
                                                and Conditions</a>
                                        </label>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn bg-gradient-primary w-100 mt-4 mb-0">Sign up
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-center pt-0 px-sm-4 px-1">
                                <p class="mb-4 mx-auto">
                                    Already have an account?
                                    <a href="{{route('publisher.post.login')}}"
                                       class="text-primary text-gradient font-weight-bold">Sign in</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                        <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center">
                            <img src="{{asset('publisher/img/pattern-lines.svg')}}" alt="pattern-lines"
                                 class="position-absolute opacity-4 start-0">
                            <div class="position-relative">
                                <img class="max-width-500 w-100 position-relative z-index-2"
                                     src="{{asset('publisher/img/rocket-white.png')}}" alt="rocket">
                            </div>
                            <h4 class="mt-5 text-white font-weight-bolder">Your journey starts here</h4>
                            <p class="text-white">Just as it takes a company to sustain a product, it takes a community
                                to sustain a protocol.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
        <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
    </div>
    <div class="ps__rail-y" style="top: 0px; right: 0px;">
        <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
    </div>
</main>
<script src="{{asset('publisher/js/core/popper.min.js')}}"></script>
<script src="{{asset('publisher/js/core/bootstrap.min.js')}}"></script>
<script src="{{asset('publisher/js/plugins/perfect-scrollbar.min.js')}}"></script>
<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {damping: '0.5'}
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>
<script async defer src="https://buttons.github.io/buttons.js"></script>
<script src="{{asset('publisher/js/soft-ui-dashboard.js')}}"></script>
</body>
</html>