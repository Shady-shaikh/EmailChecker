<div class="d-flex">

    @if(auth()->user()->isAbleto('role_read'))
    <a href="{{ route('roles.show', ['role' => $id]) }}" class="btn btn-info btn-sm mx-1"><i
            class="fas fa-eye "></i></a>
    @endif

    @if(auth()->user()->isAbleto('role_update'))
    <a href="{{ route('roles.edit', ['role' => $id]) }}" class="btn btn-warning btn-sm mx-1"><i
            class="fas fa-pencil-alt "></i></a>
    @endif

    @if(auth()->user()->isAbleto('role_delete'))
    <form action="{{ route('roles.destroy', ['role' => $id]) }}" method="post">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger mx-1"
            onclick="confirm('Are you sure you want to delete this entry?')"><i class="fas fa-trash"></i></button>
    </form>
    @endif

</div>