@can('update-role')
    <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-warning">
        <i class="fas fa-edit"></i>
    </a>
@endcan

@can('delete-role')
    <form action="{{ route('roles.destroy', $role->id) }}" method="POST" class="d-inline">
        @csrf @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this role?')">
            <i class="fas fa-trash"></i>
        </button>
    </form>
@endcan
