<!-- Main content -->

<section class="content">
    @if (!empty(Request::segment(4)) && !empty(Request::segment(3)))
    <form action="{{ route('plans.update', ['plan' => Request::segment(3)]) }}" enctype="multipart/form-data"
        method="post" id="plan_form">
        @method('PUT')
        @else
        <form action="{{ route('plans.store') }}" method="post" enctype="multipart/form-data" id="plan_form">
            @endif
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('Plans') }}</h3>

                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">{{ __('Plan Name') }}</label>
                                        <input type="text" name="name" class="form-control"
                                            value="{{ $plan->name ?? (old('name') ?? '') }}" id="name"
                                            placeholder="Enter Name" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email_limit">{{ __('Email Limit') }}</label>
                                        <input type="number" name="email_limit" id="email_limit" class="form-control"
                                            value="{{ $plan->getFeature->email_limit ?? (old('email_limit') ?? '') }}"
                                            placeholder="Enter Email Limit" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="price">{{ __('Plan Price') }}</label>
                                        <input type="number" name="price" id="price" class="form-control"
                                            value="{{ $plan->price ?? (old('price') ?? '') }}"
                                            placeholder="Enter Price" required>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description">{{ __('Plan Description') }}</label>
                                        <input type="text" name="description" class="form-control"
                                            value="{{ $plan->description ?? (old('description') ?? '') }}"
                                            id="description" placeholder="Enter Description" >

                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>

            </div>
            <div class="row">
                <div class="col-12">
                    <button class="btn-sm btn btn-info">{{ __('Submit') }}</button>

                </div>
            </div>
        </form>

</section>

@section('js')
<script>
    $('#plan_form').validate();
</script>
@endsection