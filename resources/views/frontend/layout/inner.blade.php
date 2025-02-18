<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title')</title>
    @include('frontend.include.head')
    @yield('css')
</head>

<body class="hold-transition login-page">

    @include('frontend.include.inner_header')

    <section>
        <div class="container">
            <div class="row">
                @yield('content')
            </div>
        </div>
    </section>
    @include('frontend.include.footer')
    @include('frontend.include.alerts')
    @yield('js')
</body>

</html>
