<!DOCTYPE html>
<html lang="{{ $locale = str_replace('_', '-', app()->getLocale()) }}">
@include('head')
<body data-bs-theme="light">
<div class="page">
    @include('header')
    <div class="page-wrapper">
        <div class="page-body">
            {{ $slot }}
        </div>
        @include('footer')
    </div>
</div>
@stack('body-script')
</body>
</html>
