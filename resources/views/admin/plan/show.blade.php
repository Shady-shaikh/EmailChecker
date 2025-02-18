@section('title', __('View Plan'))
@extends('admin.layout.admin')
@section('main')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ __('View Plan') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Plans</a></li>
                            <li class="breadcrumb-item active">{{ __('View Plan') }}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <!-- Main content -->
                        <div class="invoice p-3 mb-3">
                            <!-- title row -->
                            <div class="row">
                                <div class="col-12">
                                    <h4>
                                        {{ $plan->name }}
                                        <small class="float-right">Date Time: {{ $plan->created_at }}</small>
                                    </h4>
                                </div>
                                <!-- /.col -->
                            </div>


                            <!-- Table row -->
                            <div class="row mt-3">
                                <div class="col-12 table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Plan ID</th>
                                                <th>Plan Name</th>
                                                <th>Plan Description</th>
                                                <th>Plan Price</th>
                                                <th>Email Limit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ $plan->id }}</td>
                                                <td>{{ $plan->name }}</td>
                                                <td>{{ $plan->description }}</td>
                                                <td>{{ $plan->price }}</td>
                                                <td>{{ $plan->getFeature->email_limit }}</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->


                            <!-- /.row -->

                            <!-- this row will not appear when printing -->
                            <div class="row no-print">
                                <div class="col-12">
                                    <button onclick="window.print()" class="btn btn-default"><i class="fas fa-print"></i>
                                        Print</button>
                                </div>
                            </div>
                        </div>
                        <!-- /.invoice -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
