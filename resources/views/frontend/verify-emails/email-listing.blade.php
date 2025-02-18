
@if(!empty($emails))
<table class="table align-items-center mb-0">
    <thead>
    <tr>
        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">S. No.</th>
        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
    </tr>
    </thead>
    <tbody id="email-tbody">
    @php
    $srNo = (($emails->currentPage()-1) * $emails->perPage()) + 1;
    @endphp
    @foreach($emails as $email)
        <tr>
            <td> {{ $srNo++ }}</td>
            <td> {{ $email->email }}</td>
            <td>
                @if($email->status == 1)
                    <span class="badge bg-gradient-success">Valid</span>
                @elseif($email->status == 2)
                    <span class="badge bg-gradient-danger">Invalid</span>
                @else
                <span class="badge bg-gradient-warning">Not Validated</span>
                @endif

            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<input type="hidden" name="hidden_page" id="hidden_page" value="1" />
{{ $emails->links('pagination::bootstrap-5') }}


@endif
