@section('title', 'Verify Emails')
@extends('frontend.layout.inner')
@section('content')

<div class="card d-flex  justify-content-center shadow-lg my-sm-0 my-sm-6 mt-8 mb-5">
    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
        <div class="bg-gradient-primary shadow-primary border-radius-lg p-3">
            <h3 class="text-white text-primary mb-0">{{ __('Verify Emails') }}</h3>
        </div>
    </div>

    <div class="card-body">
        <div class="flex-container align-flex-start wrap p-5">
            <form action="{{ route('verify-emails.store') }}" method="post"
                  id="verify_email_form" enctype="multipart/form-data" >
                @csrf
                <input type="hidden" id="type" name="type" value="">
                <div class="row ml-5">
                    <div class="col-md-4">
                        <div class="input-group input-group-static mb-4">
                            <h5>Verify Single Email</h5>
                            <input type="email" id="email" class="form-control" placeholder="Enter email" name="email" required>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <h5>-OR-</h5>
                    </div>
                    <div class="col-md-6">
                        <h5>Upload CSV for bulk verification of emails <small class="download-csv"><a href="{{ asset('assets\csv-samples\emails.csv') }}">( Download
                                    Sample )</a></small></h5>
                        <span class="btn btn-outline-secondary ">
                                    <input type="file" name="csv_file" id="csv_file" accept=".csv"/>
                                </span>
                    </div>
                    <button type="submit" class="btn bg-gradient-primary mt-3 mb-0 w-25">Validate</button>
                </div>
            </form>
        </div>

        
        <div class="col-lg-3">
            <div class="form-group">
                <input type="text" name="serach" id="serach" class="form-control" placeholder="Search"/>
            </div>
        </div>

        <div class="table-responsive p-5" id="verify_email_table">

        </div>
    </div>
</div>
</div>
</div>

@endsection
@section('css')
<style>
    .download-csv {
        font-size: 10px;
    }
</style>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('#verify_email_form').validate();
        $('#email').on('change',function (){
            $('#type').val('single');
            $('#email').attr('required',true);

        });
        $('#csv_file').on('change',function (){
            $('#type').val('csv');
            $('#email').removeAttr('required');
        });
    });
</script>
<script>
    $(document).ready(function() {
        fetchEmails();

        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            var url = $(this).attr('href');
            var page = new URL(url).searchParams.get('page');
            $('#hidden_page').val(page);
            var query = $('#serach').val();
            fetchEmails(page,query);
        });

        $(document).on('keyup', '#serach', function(){
            var query = $('#serach').val();
            var page = $('#hidden_page').val();
            fetchEmails(page,query);
        });


        function fetchEmails(page = 1,query) {
            $.ajax({
                url: "{{ route('verify-emails.index') }}?page=" + page+"&query="+query,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                method: "GET",
                success: function(response) {
                    $('#verify_email_table').html('');
                    $('#verify_email_table').html(response);
                }
            });
        }
    });
</script>
@endsection

