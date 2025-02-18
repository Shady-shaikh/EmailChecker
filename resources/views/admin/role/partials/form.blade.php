<!-- Main content -->

@php
    use App\Models\Permission;

    $permissions = Permission::get();

    $groupedPermissions = [];
    foreach ($permissions as $permission) {
        $groupedPermissions[$permission->module_name][$permission->id] = $permission->display_name;
    }
    // dd($groupedPermissions);
@endphp
<section class="content">
    @if (!empty(Request::segment(4)) && !empty(Request::segment(3)))
        <form action="{{ route('roles.update', ['role' => Request::segment(3)]) }}" enctype="multipart/form-data"
            method="post" id="role_form">
            @method('PUT')
        @else
            <form action="{{ route('roles.store') }}" method="post" enctype="multipart/form-data" id="role_form">
    @endif
    @csrf
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Roles') }}</h3>

                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Role Name</label>
                                <input type="text" name="name" class="form-control"
                                    value="{{ $role->name ?? (old('name') ?? '') }}" id="name"
                                    placeholder="Enter Name" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="display_name">Role Display Name</label>
                                <input type="display_name" name="display_name" id="display_name" class="form-control"
                                    value="{{ $role->display_name ?? (old('display_name') ?? '') }}"
                                    placeholder="Enter Display Name">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description">Role Description</label>
                                <input type="text" name="description" class="form-control"
                                    value="{{ $role->description ?? (old('description') ?? '') }}" id="name"
                                    placeholder="Enter Description" required>
                            </div>
                        </div>



                    </div>

                    <hr>
                    {{-- permissions --}}
                    <h4>Permissions</h4>
                    <hr>

                    <div class="row d-flex justify-content-between">
                        @foreach ($groupedPermissions as $menu => $permissions)
                            <div class="cold-md-5">
                                <div class="card">
                                    <div class="card-title">
                                        <div class="card-header">
                                            @php
                                                $moduleNames = [];
                                                if (!empty(isset($role) && $role->permissions->toArray())) {
                                                    $moduleNames = collect($role->permissions->toArray())
                                                        ->pluck('module_name')
                                                        ->unique()
                                                        ->all();
                                                }

                                            @endphp
                                            <input type="checkbox" name="menu[]" id="menu_{{ $menu }}"
                                                value="{{ $menu }}"
                                                {{ in_array($menu, $moduleNames) ? 'checked' : '' }} class="menu-checkbox">
                                            <label for="menu_{{ $menu }}">{{ $menu }}</label>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            @foreach ($permissions as $permission_id => $permission)
                                                <div class="col-md-6">
                                                    @php
                                                        $permissionIds = [];
                                                        if (!empty(isset($role) && $role->permissions->toArray())) {
                                                            $permissionIds = collect($role->permissions->toArray())
                                                                ->pluck('id')
                                                                ->all();
                                                        }
                                                    @endphp
                                                    <input type="checkbox" name="permission[]"
                                                        id="permission_{{ $permission_id }}"
                                                        value="{{ $permission_id }}"
                                                        {{ in_array($permission_id, $permissionIds) ? 'checked' : '' }}
                                                        class="permission-checkbox menu_{{ $menu }}">
                                                    <label
                                                        for="permission_{{ $permission_id }}">{{ $permission }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>


                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>

    </div>
    <div class="row">
        <div class="col-12 mb-2">
            <button class="btn-sm btn btn-info">Submit</button>

        </div>
    </div>
    </form>

</section>

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuCheckboxes = document.querySelectorAll('.menu-checkbox');
            menuCheckboxes.forEach(menuCheckbox => {
                menuCheckbox.addEventListener('change', function() {
                    const menu = this.id.replace('menu_', '');
                    const permissionCheckboxes = document.querySelectorAll('.menu_' + menu);
                    permissionCheckboxes.forEach(permissionCheckbox => {
                        permissionCheckbox.checked = this.checked;
                    });
                });
            });

            const permissionCheckboxes = document.querySelectorAll('.permission-checkbox');
            permissionCheckboxes.forEach(permissionCheckbox => {
                permissionCheckbox.addEventListener('change', function() {
                    const classes = Array.from(this.classList);
                    const menuClass = classes.find(className => className.startsWith('menu_'));
                    const menu = menuClass.replace('menu_', '');
                    const menuCheckbox = document.getElementById('menu_' + menu);
                    const anyChecked = document.querySelectorAll('.menu_' + menu + ':checked')
                        .length > 0;
                    menuCheckbox.checked = anyChecked;
                });
            });
        });

        $('#role_form').validate();
    </script>
@endsection
