<?php
namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class UserRepository implements UserRepositoryInterface
{
    public function getAllUsers(int $perPage = 15) {
        return User::with(['role', 'unit', 'department'])->paginate($perPage);
    }

    public function getUserById($userId) {
        return User::findOrFail($userId);
    }

    public function createUser(array $userDetails) {
        return User::create($userDetails);
    }

    public function updateUser($userId, array $newDetails) {
        return User::whereId($userId)->update($newDetails);
    }

    public function deleteUser($userId) {
        return User::destroy($userId);
    }

    public function getAllUsersForDatatable()
    {
        return User::with(['role', 'unit', 'department'])->select('users.*');
    }
}
