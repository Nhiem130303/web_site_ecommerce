<!DOCTYPE html>
<html lang="en">
<head>
    @include('publisher.layout.head')
</head>
<body class="g-sidenav-show  bg-gray-100">
@include('publisher.layout.sideBar')
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    @include('publisher.layout.menu')
    <div class="container-fluid py-4" style="background: #f8f9fa;">
        <div class="row">
            @yield('content')
        </div>
        <footer class="footer pt-3  ">
            @include('publisher.layout.footer')
            @stack('scripts')
        </footer>
    </div>
</main>

</body>
</html>