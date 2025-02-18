@php
$menus = collect(auth()->user()->allPermissions()->toArray())->pluck('module_name')->unique()->all();
@endphp

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <span class="brand-text font-weight-light">Email Checker</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">

                    <a href="{{ url('/admin') }}"
                        class="nav-link {{ strpos(Route::current()->action['as'], 'dashboard') !== false ? 'active' : '' }}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                @if(in_array('Roles',$menus))
                <li class="nav-item">
                    <a href="{{ route('roles.index') }}"
                        class="nav-link {{ strpos(Route::current()->action['as'], 'roles') !== false ? 'active' : '' }}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>Roles & Permissions</p>
                    </a>
                </li>
                @endif

                @if(in_array('Users',$menus))
                <li class="nav-item">
                    <a href="{{ route('users.index') }}"
                        class="nav-link {{ strpos(Route::current()->action['as'], 'users') !== false ? 'active' : '' }}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>User Management</p>
                    </a>
                </li>
                @endif


                @if(in_array('Plans',$menus))
                <li class="nav-item">
                    <a href="{{ route('plans.index') }}"
                        class="nav-link {{ strpos(Route::current()->action['as'], 'plans') !== false ? 'active' : '' }}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>Plans</p>
                    </a>
                </li>
                @endif

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
