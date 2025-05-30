@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Roles</h5>
                @can('create-role')
                    <a href="{{ route('roles.create') }}" class="btn btn-sm btn-success">
                        <i class="fas fa-plus me-1"></i> New Role
                    </a>
                @endcan
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle text-nowrap" id="roles-table">
                        <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Permissions</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            $('#roles-table').DataTable({
                processing: true,
                serverSide: true,
                searching: false,
                ajax: '{{ route('roles.datatable') }}',
                columns: [
                    { data: 'name', name: 'name' },
                    { data: 'description', name: 'description' },
                    { data: 'permissions', name: 'permissions.name', orderable: false },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return `
                        @can('update-role')
                            <a href="/roles/${row.id}/edit" class="btn btn-sm btn-primary">Edit</a>
                        @endcan
                            @can('delete-role')
                            <form action="/roles/${row.id}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                        @endcan
                            `;
                        }
                    }
                ]
            });
        });
    </script>
@endpush
