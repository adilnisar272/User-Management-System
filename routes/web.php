<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Models\Unit;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Testing user policy
//Route::get('/test-permissions', function() {
//    $user = auth()->user();
//    return [
//        'create-user' => $user->can('create-users'),
//        'update-user' => $user->can('update-users'),
//        'direct_permissions' => $user->permissions->pluck('slug'),
//        'role_permissions' => $user->role->permissions->pluck('slug')
//    ];
//})->middleware('auth');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function() {
    // routes/web.php
    Route::resource('users', UserController::class);
    Route::get('users/datatable', [UserController::class, 'datatable'])->name('users.datatable');

    Route::resource('roles', RoleController::class)->except(['show']);
    Route::get('roles/data', [RoleController::class, 'datatable'])->name('roles.datatable');

    //get departments list
    Route::get('/units/{unit}/departments', function (Unit $unit) {
        return response()->json($unit->departments);
    });
});
require __DIR__.'/auth.php';
