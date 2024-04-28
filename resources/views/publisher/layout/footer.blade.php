<div class="container-fluid">
    <div class="row align-items-center justify-content-lg-between">
        <div class="col-lg-6 mb-lg-0 mb-4">
            <div class="copyright text-center text-sm text-muted text-lg-start">
                ©
                <script>
                    document.write(new Date().getFullYear())
                </script>
                ,
                made with <i class="fa fa-heart"></i> by
                <a href="#" class="font-weight-bold" target="_blank">
                    Creative Tim
                </a>
                for a better publisher.
            </div>
        </div>
        <div class="col-lg-6">
            <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                <li class="nav-item">
                    <a href="#" class="nav-link text-muted" target="_blank">
                        Creative Tim
                    </a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link text-muted"
                       target="_blank">About Us</a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link text-muted" target="_blank">Blog</a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link pe-0 text-muted"
                       target="_blank">License</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<script src="{{asset('publisher/js/plugins/jquery.min.js')}}"></script>
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
<script src="{{asset('publisher/js/soft-ui-dashboard.js')}}"></script>
@stack('script')



