<?php
namespace App\Services;

use App\Http\Requests\RoleStoreRequest;
use App\Models\Role;
use App\Repositories\RoleRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Yajra\DataTables\Facades\DataTables;

class RoleService
{
    public function __construct(private RoleRepository $repository)
    {
    }

    public function getAllRoles(): Collection
    {
        return $this->repository->getAllRoles();
    }

    public function paginateRoles(int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->getPaginatedRoles($perPage);
    }

    public function createRole(RoleStoreRequest $request): Role
    {
        $data = $request->validated();
        $role = $this->repository->createRole($data);

        if (isset($data['permissions'])) {
            $role->permissions()->sync($data['permissions']);
        }

        return $role;
    }

    public function updateRole(Role $role, RoleStoreRequest $request): Role
    {
        $validated = $request->validated();
        $this->repository->updateRole($role->id, $validated);

        return $role->refresh();
    }

    public function deleteRole(Role $role): bool
    {
        return $this->repository->deleteRole($role);
    }

    public function getRolePermissions(Role $role): array
    {
        return $this->repository->getRolePermissions($role);
    }

    public function getRolesForDatatable()
    {
        $roles = $this->repository->getForDatatable();

        return DataTables::of($roles)
            ->addColumn('permissions', function ($role) {
                return $role->permissions->pluck('name')->implode(', ');
            })
            ->addColumn('actions', function ($role) {
                return view('partials.role-actions', compact('role'))->render();
            })
            ->rawColumns(['actions', 'permissions'])
            ->make(true);
    }

}
