<!doctype html>
<html lang="{{ $locale = str_replace('_', '-', app()->getLocale()) }}">
@include('head')
<body class="d-flex flex-column min-vh-100">
@include('preloader')
@include('header')
@if (session('flash'))
{{-- @todo move to componet --}}
<div class="container">
    <div
        class="alert alert-{{ session('flash.type') }} alert-dismissible fade show position-absolute w-100 rounded-4 m-0"
        style="z-index: 999; max-width: 1296px; top: 25px;"
        role="alert"
    >
        {{ session('flash.message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
@endif
{{ $slot }}
@include('footer')
<!-- Scripts -->
<!-- Bootstrap core JavaScript -->
<script src="/build/vendor/jquery/jquery.min.js"></script>
<script src="/build/vendor/bootstrap/js/bootstrap.min.js"></script>

<script src="/build/assets/js/isotope.min.js"></script>
<script src="/build/assets/js/owl-carousel.js"></script>
<script src="/build/assets/js/tabs.js"></script>
<script src="/build/assets/js/popup.js"></script>
<script src="/build/assets/js/custom.js"></script>

@stack('body-script')
</body>
</html>
