<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>@yield('title')</title>
    @include('frontend.include.head')
</head>

<body class="presentation-page bg-gray-200">

    @include('frontend.include.header')
    @yield('content')

    
    @include('frontend.include.footer')
    @yield('js')


</body>

</html>
