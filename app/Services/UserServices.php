<?php

namespace App\Services;

namespace App\Services;

use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Hash;

class UserServices
{
    // Store a new user
    public function storeUser($validatedData)
    {
        // Encrypt the password before saving
        $validatedData['password'] = Hash::make($validatedData['password']);

        // Create the user
        return User::create($validatedData);
    }

    // Update an existing user's details
    public function updateUser($validatedData, User $user)
    {
        // If password is being updated, hash it
        if (isset($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        }

        // Update the user with the validated data
        $user->update($validatedData);

        return $user;
    }

    // Delete a user
    public function deleteUser(User $user)
    {
        // Delete the user from the database
        $user->delete();
        return true;
    }

    // Get users data for DataTables
    public function getData()
    {
        // Query all users
        $users = User::query();

        return DataTables::of($users)
            ->editColumn('id', function ($user) {
                return $user->id;
            })
            ->editColumn('username', function ($user) {
                return $user->username;
            })
            ->editColumn('email', function ($user) {
                return $user->email;
            })
            ->addColumn('active_status', function ($user) {
                return $user->is_active ? 'Active' : 'Inactive';
            })
            ->addColumn('actions', function ($user) {
                return view('admin.users.components.actions', compact('user'))->render();
            })
            ->rawColumns(['id', 'username', 'email', 'active_status', 'actions'])
            ->make(true);  // Ensure that you're calling `make(true)` to return JSON
    }

}

