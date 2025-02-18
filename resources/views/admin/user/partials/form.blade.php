<!-- Main content -->
@php
    use App\Models\Role;
    $roles = Role::where('id', '!=', auth()->user()->roles->first()->id)->pluck('display_name', 'id');
@endphp

<section class="content">
    @if (!empty(Request::segment(4)) && !empty(Request::segment(3)))
        <form action="{{ route('users.update', ['user' => Request::segment(3)]) }}" enctype="multipart/form-data"
            method="post" id="user_form">
            @method('PUT')
        @else
            <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data" id="user_form">
    @endif
    @csrf
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Users') }}</h3>

                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">{{ __('User Name') }}</label>
                                <input type="text" name="name" class="form-control"
                                    value="{{ $user->name ?? (old('name') ?? '') }}" id="name"
                                    placeholder="Enter Name" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">{{ __('Enter Email') }}</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    value="{{ $user->email ?? (old('email') ?? '') }}" placeholder="Enter Email"
                                    required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="role">{{ __('Role') }}</label>
                                @php
                                    $role = !empty($user) ? $user->roles->first()->id : '';
                                @endphp
                                <select name="role" id="role" class="form-control">
                                    <option value="">Select Role</option>
                                    @foreach ($roles as $id => $val)
                                        <option
                                            value="{{ $id }}"{{ $id == (old('role') ?? $role) ? 'selected' : '' }}>
                                            {{ $val }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">{{ __('Enter Password') }}</label>
                                <input type="password" name="password" id="password" class="form-control"
                                    value="{{ old('password') ?? '' }}" placeholder="Enter Password"
                                    {{ empty($user) ? 'required' : '' }} minlength="8">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password_confirmation">{{ __('Enter Confirm Password') }}</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control" value="{{ old('password_confirmation') ?? '' }}"
                                    placeholder="Enter Confirm Password" minlength="8">
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
        $('#user_form').validate();
    </script>
@endsection
