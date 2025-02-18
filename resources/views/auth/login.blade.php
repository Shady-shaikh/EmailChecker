@section('title', 'Login')
@extends('frontend.layout.empty')
@section('content')

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 shadow-none my-3  navbar-transparent ">
        <div class="container-fluid px-0">
            <a class="navbar-brand font-weight-bolder ms-sm-3 text-light" href="{{ url('/') }}" rel="tooltip"
                data-placement="bottom">
                Email Checker
            </a>
            <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse"
                data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon mt-2">
                    <span class="navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                </span>
            </button>
            <div class="collapse navbar-collapse pt-3 pb-2 py-lg-0 w-100" id="navigation">

                <ul class="navbar-nav navbar-nav-hover ms-auto">
                    <li class="nav-item dropdown dropdown-hover mx-2">
                        <a class="nav-link ps-2 d-flex cursor-pointer align-items-center" id="dropdownMenuDocs"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Hi, Guest
                        </a>

                    </li>

                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->

    <div class="page-header align-items-start min-vh-100"
        style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');"
        loading="lazy">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container my-auto">
            <div class="row">
                <div class="col-lg-4 col-md-8 col-12 mx-auto">
                    <div class="card z-index-0 fadeIn3 fadeInBottom">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                                <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">{{ __('Log in') }}</h4>

                            </div>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}" role="form" class="text-start">
                                @csrf
                                <div class="input-group input-group-outline my-3">
                                    <x-input-label for="email" :value="__('Email')" class="form-label" />

                                    <x-text-input id="email" class="form-control" type="email" name="email"
                                        :value="old('email')" required autofocus autocomplete="username" />
                                </div>

                                <div class="input-group input-group-outline mb-3">
                                    <x-input-label for="password" :value="__('Password')" class="form-label" />

                                    <x-text-input id="password" class="form-control" type="password" name="password"
                                        required autocomplete="current-password" />
                                </div>

                                <x-input-error :messages="$errors->get('email')" class="mt-2" />

                                <div class="form-check form-switch d-flex align-items-center mb-3">
                                    <input class="form-check-input" type="checkbox" id="rememberMe" checked>
                                    <label class="form-check-label mb-0 ms-3"
                                        for="rememberMe">{{ __('Remember me') }}</label>
                                </div>
                                <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
                                <div class="text-center">
                                    <button class="btn bg-gradient-primary w-100 my-4 mb-2"> {{ __('Log in') }}</button>
                                </div>

                                <p class="mt-4 text-sm text-center">
                                    @if (Route::has('password.request'))
                                        <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                                            href="{{ route('password.request') }}">
                                            {{ __('Forgot your password?') }}
                                        </a>
                                    @endif
                                </p>

                                <a href="{{ url('/register') }}">
                                    <p class="mt-4 text-sm text-center">
                                        Don't have an account?
                                    </p>
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('js')
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endsection
