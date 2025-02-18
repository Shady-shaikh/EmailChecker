@section('title', 'My Plans')
@extends('frontend.layout.inner')
@section('content')



    <div class="col-lg-12">
        <div class="card d-flex  justify-content-center shadow-lg my-sm-0 my-sm-6 mt-8 mb-5">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                <div class="bg-gradient-primary shadow-primary border-radius-lg p-3">
                    <h3 class="text-white text-primary mb-0">{{ __('My Plans') }}</h3>
                </div>
            </div>

            <div class="card-body">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead class="text-center">
                                <tr>
                                    <th>#</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Plan
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Price</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Email Limit</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Email Limit Left</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Subscribed Date</th>

                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status</th>
                                    {{-- <th class="text-secondary opacity-7"></th> --}}
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach ($my_plans as $row)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $row->getPlan->name }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $row->getPlan->price }}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-xs font-weight-bold mb-0">
                                                {{ $row->getPlan->getFeature->email_limit }}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-xs font-weight-bold mb-0">
                                                {{ $row->getPlan->getFeature->email_limit }}</p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $row->start_subscription_date }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">
                                                {{ $current_plan->plan_id == $row->plan_id?'Active':'In-Active' }}
                                            </p>
                                        </td>
                                        {{-- <td class="align-middle">
                                            <a href="javascript:;" class="text-secondary font-weight-normal text-xs"
                                                data-toggle="tooltip" data-original-title="Edit user">
                                                Edit
                                            </a>
                                        </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>


@endsection
