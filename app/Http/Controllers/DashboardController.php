<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $user = Auth::user();
        if($user->role_id==1){
            $damages = $user->damage_documentation()->with('damage_image')->latest()->get();
            return view("dashboard.homeOwner",compact("damages"));
        }
        if($user->role_id==2){
            $services = $user->service()->with('productofservice')->latest()->get();
            $products = $user->productofservice()->with('service')->latest()->get();
            return view("dashboard.serviceProvider",compact("services","products"));
        }
    }
}
