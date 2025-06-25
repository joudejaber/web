<?php

namespace App\Http\Controllers;

use App\Models\{Appointment, DamageReport, ProductOfService, Service, User};
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Provider;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role_id == 1) {
            $damageReports = DamageReport::where('user_id', $user->id)->latest()->get();
            $personalInfo = DamageReport::with('damages')->where('user_id', $user->id)->first();
$damages = $personalInfo ? $personalInfo->damages : collect(); // Safe fallback

            $report = DamageReport::where('user_id', $user->id)->first();
            return view("dashboard.homeOwner", compact("damageReports","report", "personalInfo","damages"));
        }

        if ($user->role_id == 2) {
    $provider = $user->provider ?? new Provider();
    $services = $user->service()->with('productofservice')->latest()->get();
    $products = $user->productofservice()->with('service')->latest()->get();
    return view("dashboard.serviceProvider", compact("services", "products", "provider"));
}


        if ($user->role_id == 3) {
            // compact Goverment details
            return view("government.dashboard");
        }

        if ($user->role_id == 4) {
            $usersCount = User::count();
            $servicesCount = Service::count();
            $appointmentsCount = Appointment::count();
            $productsCount = ProductOfService::count();

            // Recent Data
            $recentAppointments = Appointment::with(['homeowner', 'service'])
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();

            $recentDamageReports = DamageReport::with(['user'])
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();

            // Chart Data
            $chartData = $this->getChartData();

            return view('admin.dashboard', compact(
                'usersCount',
                'servicesCount',
                'productsCount',
                'appointmentsCount',
                'recentAppointments',
                'recentDamageReports',
                'chartData'
            ));
        }
    }

    protected function getChartData()
    {
        $labels = [];
        $usersData = [];
        $appointmentsData = [];
        $damageReportsData = [];

        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $labels[] = $date->format('M Y');

            $usersData[] = User::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();

            $appointmentsData[] = Appointment::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();

            $damageReportsData[] = DamageReport::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
        }

        return [
            'labels' => $labels,
            'users' => $usersData,
            'appointments' => $appointmentsData,
            'damageReports' => $damageReportsData,
        ];
    }
}
