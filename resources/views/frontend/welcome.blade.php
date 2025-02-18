@section('title', 'Home')
@extends('frontend.layout.main')
@section('content')


    @php
        use App\Models\Plan;
        use App\Models\MemberShip;
        $plans = Plan::take(6)->get();
        $membership = MemberShip::where('user_id', auth()->id())->latest()->first();
    @endphp


    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="row text-center my-sm-5 mt-5">
                    <div class="col-lg-6 mx-auto">
                        <span class="badge bg-primary mb-3">Latest Plans</span>
                        <h2 class="">Variety Of Plans</h2>
                        <p class="lead">The easiest way to get started is to use one of our <br />below
                            plans. </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                @foreach ($plans as $plan)
                    @php
                        $div_class = 'bg-gradient-primary';
                        $text_class = 'text-white';
                        if (!empty($membership) && $membership->plan_id == $plan->id) {
                            $div_class = 'bg-gray-100';
                            $text_class = '';
                        }
                    @endphp
                    <div class="col-lg-4 mb-2">
                        <div class="info-horizontal {{ $div_class }} border-radius-xl d-block d-md-flex p-4">
                            <i class="material-icons text-white text-3xl">sell</i>
                            <div class="ps-0 ps-md-3 mt-3 mt-md-0">
                                <h5 class="{{ $text_class }}">{{ $plan->name }}</h5>
                                <p class="{{ $text_class }}">{{ $plan->description }}</p>
                                <p class="{{ $text_class }}"><b>Price: </b> {{ $plan->price }} / Year</p>
                                @php
                                    $subscribe_url = auth()->user() != null ? '#' : url('/register');
                                @endphp

                                @if (empty($text_class))
                                    <span class="btn btn-outline-dark text-secondary">Current Plan</span>
                                @else
                                    <a href="{{ $subscribe_url }}" class="btn btn-dark {{ $text_class }} icon-move-right"
                                        id="plan_{{ $plan->id }}">
                                        Subscribe
                                        <i class="fas fa-arrow-right text-sm ms-1"></i>
                                    </a>
                                @endif

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection
@section('js')

    {{-- <script>
        let plans = @json($plans);
        let user_id = "{{ auth()->user()->id??'' }}";
        plans.forEach(element => {
            const subcribe_btn = $('#plan_' + element.id);
            subcribe_btn.on('click', function() {
                alert('clicked');
                $.ajax({
                    url: "{{ route('master.updateMemeberShip') }}",
                    type: 'post',
                    data: {
                        plan_id: element.id,
                        user_id: user_id,
                    },
                    success: function(response) {
                        if (response.status == 'success') {
                            alert('Subscribed successfully!');
                            location.reload();
                        } else {
                            alert('Failed to subscribe. Please try again later.');
                        }
                    }
                });
            });
        });
        // const plan = document.getElementById();
    </script> --}}

@endsection
