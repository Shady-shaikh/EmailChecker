<script>
    toastr.options.positionClass = 'toast-bottom-center';


    @if (Session::has('success'))
    toastr.success("{{ Session::get('success') }}");
    @endif

    @if (Session::has('error'))
    toastr.error("{{ Session::get('error') }}");
    @endif

    @if (Session::has('errors'))
    @foreach (Session::get('errors')->all() as $error)
    toastr.error("{{ $error }}");
    @endforeach
    @endif

</script>
