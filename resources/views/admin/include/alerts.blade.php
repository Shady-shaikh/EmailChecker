<script>
    @if (Session::has('success'))
        toastr.success("{{ Session::get('success') }}")
    @endif
    @if (Session::has('info'))
        toastr.info("{{ Session::get('info') }}")
    @endif
    @if (Session::has('message'))
        toastr.info("{{ Session::get('message') }}")
    @endif
    @if (Session::has('warning'))
        toastr.warning("{{ Session::get('warning') }}")
    @endif
    @if (Session::has('error'))
        toastr.error("{{ Session::get('error') }}")
    @endif


    @if (Session::has('errors'))
        @foreach (Session::get('errors')->all() as $error)
            toastr.error("{{ $error }}");
        @endforeach
    @endif
</script>
