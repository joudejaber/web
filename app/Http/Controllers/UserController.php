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
}
