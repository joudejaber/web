<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function ShowRegisterForm(){
        return view("auth.register");
    }

    public function ShowLoginForm(){
        return view("auth.login");
    }

    //api to register user
    public function register(Request $request){
        try {
            $validating = Validator::make($request->all(), [
                'name' => 'required|string|max:56',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
                'role_id' => 'required|string',
            ]);
            if ($validating->fails()) {
                return redirect()->back()->withErrors($validating)->withInput();
            }
            $user = User::create([
                'name'=> $request->name,
                'email'=> $request->email,
                'password'=> bcrypt($request->password),
                'role_id'=> $request->role_id,
            ]);
            if (!$user) {
                return redirect()->back()->with('error','failed to create user');
            }
            Auth::login($user);
            return redirect()->route('home')->with('success','user registered successfully!');
        }
        catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    //api to login
    public function login(Request $request){
        try {
            if (!$request->email || !$request->password) {
                return redirect()->back()->with("error","All fields are required");
            }
            $user = User::where("email", $request->email)->first();
            if (!$user) {
                return redirect()->back()->with("error","User not found!");
            }
            // checking the password
            if (!Hash::check($request->password, $user->password)) {
                return redirect()->back()->with("error", "Invalid password!");
            }
            Auth::login($user);
            return redirect()->route('home')->with("success", "User logged in successfully!");
        } 
        catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
    //api to logout
    public function logout(){
        Auth::logout();
        return redirect()->route('login')->with('success','User logged out successfuly!');
    }

}
