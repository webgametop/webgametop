<!doctype html>
<html lang="{{ $locale = str_replace('_', '-', app()->getLocale()) }}">
@include('head')
<body>
@include('preloader')
@include('header')
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
