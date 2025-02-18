@section('title', __('Create Plan'))
@extends('admin.layout.admin')
@section('main')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ __('Create Plan') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">{{ __('Plans') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('Create Plan') }}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        @include('admin.plan.partials.form')
    </div>
    @endsection
