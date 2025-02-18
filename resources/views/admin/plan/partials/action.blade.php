<div class="d-flex">

    @if(auth()->user()->isAbleto('plan_read'))
    <a href="{{ route('plans.show', ['plan' => $id]) }}" class="btn btn-info btn-sm mx-1"><i
            class="fas fa-eye "></i></a>
    @endif

    @if(auth()->user()->isAbleto('plan_update'))
    <a href="{{ route('plans.edit', ['plan' => $id]) }}" class="btn btn-warning btn-sm mx-1"><i
            class="fas fa-pencil-alt "></i></a>
    @endif

    @if(auth()->user()->isAbleto('plan_delete'))
    <form action="{{ route('plans.destroy', ['plan' => $id]) }}" method="post">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger mx-1"
            onclick="confirm('Are you sure you want to delete this entry?')"><i class="fas fa-trash"></i></button>
    </form>
    @endif

</div>