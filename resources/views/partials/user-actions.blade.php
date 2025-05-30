@can('update-user')
    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning">
        <i class="fas fa-edit"></i>
    </a>
@endcan

@can('delete-user')
    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
        @csrf @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
            <i class="fas fa-trash"></i>
        </button>
    </form>
@endcan
