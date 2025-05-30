<?php
namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllUsers() {
        return $this->userRepository->getAllUsers();
    }

    public function createUser(array $data) {

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role_id' => $data['role_id'],
            'unit_id' => $data['unit_id'],
            'department_id' => $data['department_id']
        ]);

        if (isset($data['permissions'])) {
            $user->permissions()->sync($data['permissions']);
        }

        return $user->load('permissions');
    }

    public function updateUser(User $user, array $data): User
    {
        $updateData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'role_id' => $data['role_id'],
            'unit_id' => $data['unit_id'],
            'department_id' => $data['department_id']
        ];

        if (!empty($data['password'])) {
            $updateData['password'] = bcrypt($data['password']);
        }

        $user->update($updateData);

        if (isset($data['permissions'])) {
            $user->permissions()->sync($data['permissions']);
        }

        return $user->refresh();
    }

    public function deleteUser(User $user): bool
    {
        return $user->delete();
    }

    public function getUsersForDatatable()
    {
        $users = $this->userRepository->getAllUsersForDatatable();

        return $this->dataTables->of($users)
            ->addColumn('role', function ($user) {
                return $user->role->name;
            })
            ->addColumn('unit_dept', function ($user) {
                return "{$user->unit->name} / {$user->department->name}";
            })
            ->addColumn('actions', function ($user) {
                return view('partials.user-actions', compact('user'))->render();
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
}
