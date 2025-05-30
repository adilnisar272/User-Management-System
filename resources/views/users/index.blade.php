@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Users</h5>
                @can('create-user')
                    <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary">Create User</a>
                @endcan
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover" id="users-table" style="width:100%">
                    <thead class="table-light">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Unit</th>
                        <th>Department</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                paging: true,
                pageLength: 10,
                searching: true,
                ajax: '{{ route("users.index") }}',
                columns: [
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'role.name', name: 'role.name' },
                    { data: 'unit.name', name: 'unit.name' },
                    { data: 'department.name', name: 'department.name' },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        render: function (data, type, row) {
                            let actions = ``;
                            @can('update-user')
                                actions += `<a href="/users/${row.id}/edit" class="btn btn-sm btn-primary me-1">Edit</a>`;
                            @endcan
                                @can('delete-user')
                                actions += `
                                    <form action="/users/${row.id}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>`;
                            @endcan
                                return actions;
                        }
                    }
                ]
            });
        });
    </script>
@endpush
