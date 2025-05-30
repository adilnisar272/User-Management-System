<?php

namespace App\Http\Controllers;

use App\Services\RoleService;
use App\Http\Requests\RoleStoreRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct(private RoleService $service)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Role::class);

        $roles = $this->service->paginateRoles(10);

        if ($request->wantsJson()) {
            return response()->json($roles);
        }

        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Role::class);

        $permissions = Permission::all();
        return view('roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleStoreRequest $request)
    {
        $role = $this->service->createRole($request);

        return redirect()->route('roles.index')->with('success', 'Role created successfully');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        $rolePermissions = $this->service->getRolePermissions($role);
        return view('roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleStoreRequest $request, Role $role)
    {
        $this->authorize('update', $role);

        $this->service->updateRole($role, $request);

        return redirect()->route('roles.index')->with('success', 'Role updated successfully');
    }

    public function datatable()
    {
        return $this->service->getRolesForDatatable();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $this->service->deleteRole($role);

        return redirect()->route('roles.index')->with('success', 'Role deleted successfully');
    }}
