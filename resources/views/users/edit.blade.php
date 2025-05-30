@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5>Edit User: <strong>{{ $user->name }}</strong></h5>
            </div>
            <div class="card-body">
                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf @method('PUT')

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Full Name</label>
                                <input type="text" name="name" class="form-control"
                                       value="{{ old('name', $user->name) }}" required>
                            </div>

                            <div class="form-group mb-3">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control"
                                       value="{{ old('email', $user->email) }}" required>
                            </div>

                            <div class="form-group mb-3">
                                <label>New Password (Leave blank to keep current)</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Role</label>
                                <select name="role_id" class="form-control" required>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}"
                                            {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label>Unit</label>
                                <select name="unit_id" id="unitId" class="form-control unit_id" required>
                                    @foreach($units as $unit)
                                        <option value="{{ $unit->id }}"
                                            {{ $user->unit_id == $unit->id ? 'selected' : '' }}>
                                            {{ $unit->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label>Department</label>
                                <select name="department_id" id="departmentId" class="form-control department_id"
                                        required>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label>Additional Permissions</label>
                        <div class="row">
                            @foreach($allPermissions as $permission)
                                <div class="col-md-3 mb-2">
                                    <div class="form-check">
                                        <input type="checkbox" name="permissions[]"
                                               value="{{ $permission->id }}"
                                               id="perm-{{ $permission->id }}"
                                               class="form-check-input"
                                            {{ $user->role->permissions->contains($permission->id) ? 'checked' : '' }}>
                                        <label for="perm-{{ $permission->id }}" class="form-check-label">
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Update User</button>
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>

                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Dynamic department dropdown
            document.addEventListener('DOMContentLoaded', function () {
                const unitSelect = document.getElementById('unitId');
                const departmentSelect = document.getElementById('departmentId');

                unitSelect.addEventListener('change', function () {
                    const unitId = this.value;
                    departmentSelect.innerHTML = '<option value="">Loading...</option>';

                    fetch(`/units/${unitId}/departments`)
                        .then(response => response.json())
                        .then(departments => {
                            departmentSelect.innerHTML = '';
                            departments.forEach(dept => {
                                const option = new Option(dept.name, dept.id);
                                option.selected = dept.id == {{ $user->department_id }};
                                departmentSelect.add(option);
                            });
                        });
                });

                // Trigger change if unit is preselected
                if (unitSelect.value) {
                    unitSelect.dispatchEvent(new Event('change'));
                }
            });
        </script>
    @endpush
@endsection
