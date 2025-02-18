<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>@yield('title')</title>
    @include('admin.include.head')
</head>

<body class="hold-transition layout-fixed layout-footer-fixed">
    <div class="wrapper">

        @include('admin.include.header')
        @include('admin.include.leftmenu')


        @yield('main')

        <footer class="main-footer">
            <strong>Copyright &copy; 2024 <a href="{{ url('/') }}">Email Checker</a>.</strong>
            All rights reserved.

        </footer>

    </div>

    @include('admin.include.footer')

    @include('admin.include.alerts')
    @yield('js')


</body>

</html>
