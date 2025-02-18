<!-- Preloader -->
<div class="preloader flex-column justify-content-center align-items-center">

</div>

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-dark">

  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>

  </ul>
  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Navbar Search -->


    <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt"></i>
      </a>
    </li>
    <li class="nav-item">
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                this.closest('form').submit();" class="py-2 ps-3 border-radius-md nav-link">

          <h6 class="">
            {{ __('Log Out') }}

          </h6>
        </x-dropdown-link>

      </form>
    </li>
  </ul>
</nav>
<!-- /.navbar -->