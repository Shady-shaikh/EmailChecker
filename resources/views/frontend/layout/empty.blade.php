<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title')</title>
    @include('frontend.include.head')
</head>

<body class="hold-transition login-page">


    @yield('content')


    <script src="{{ asset('assets/js/material-kit.min.js?v=3.0.4') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
    @include('frontend.include.alerts')

    @yield('js')

</body>

</html>
