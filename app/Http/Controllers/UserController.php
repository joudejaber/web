<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        // Fetch all users, you can paginate if you want
        $users = User::all();

        // Return a view, passing users
        return view('admin.users.index', compact('users'));
    }

    public function destroy(User $user)
{
    // Optional: prevent deleting yourself or admins
    if (auth()->id() === $user->id) {
        return redirect()->back()->with('error', 'You cannot delete your own account.');
    }

    // Delete user
    $user->delete();

    return redirect()->route('users.index')->with('success', 'User deleted successfully.');
}

}
