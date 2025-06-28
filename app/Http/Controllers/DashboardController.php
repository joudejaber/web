<?php

namespace App\Http\Controllers;

use App\Models\{Appointment, DamageReport, ProductOfService, Service, User};
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Provider;
use App\Models\Damage;
use App\Models\Contract;
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
    // Fetch data
    $claimedDamages = Damage::with('report.user')
        ->where('status', 'pending')
        ->get();

    $damageReports = DamageReport::with('user')->get();

    $contracts = Contract::with('appointment.homeowner', 'appointment.provider', 'appointment.service')->get();

    $homeowners = User::with(['damageReports.damages'])
        ->whereHas('damageReports')
        ->get();

    // Prepare statistics
    $totalClaims = $claimedDamages->count();
    $totalContracts = $contracts->count();
    $totalHomeowners = $homeowners->count();

    // Contract status distribution (for pie chart)
    $contractStatusCounts = $contracts->groupBy('status')->map->count();

    // Claimed damages grouped by homeowner name (for bar chart)
$claimedDamageByHomeowner = $claimedDamages
    ->groupBy(fn($damage) => $damage->report->user->name ?? 'Unknown')
    ->map->count();


    // Contracts per service (for doughnut chart)
    $serviceCounts = $contracts
        ->filter(fn($contract) => $contract->appointment && $contract->appointment->service)
        ->groupBy(fn($contract) => $contract->appointment->service->name)
        ->map->count();

    return view('government.dashboard', compact(
        'claimedDamages',
        'damageReports',
        'contracts',
        'homeowners',
        'totalClaims',
        'totalContracts',
        'totalHomeowners',
        'contractStatusCounts',
        'claimedDamageByHomeowner',
        'serviceCounts'
    ));
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

            $recentDamageReports = DamageReport::with(['user', 'damages'])
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

   public function getChartData()
{
    // Monthly user registration
    $labels = [];
    $users = [];
    $appointments = [];
    $damageReports = [];

    for ($i = 5; $i >= 0; $i--) {
        $month = now()->subMonths($i)->format('M Y');
        $labels[] = $month;

        $users[] = User::whereMonth('created_at', now()->subMonths($i)->month)
            ->whereYear('created_at', now()->subMonths($i)->year)
            ->count();

        $appointments[] = Appointment::whereMonth('created_at', now()->subMonths($i)->month)
            ->whereYear('created_at', now()->subMonths($i)->year)
            ->count();

        $damageReports[] = DamageReport::whereMonth('created_at', now()->subMonths($i)->month)
            ->whereYear('created_at', now()->subMonths($i)->year)
            ->count();
    }

    // Roles breakdown (for Pie chart) — keys lowercase
    $roles = [
        'homeowners' => User::where('role_id', 1)->count(),
        'providers' => User::where('role_id', 2)->count(),
        'gov' => User::where('role_id', 4)->count(),
    ];

    // Appointments per service (for Bar chart)
    $appointmentsPerService = Service::withCount('appointments')->get()->pluck('appointments_count', 'name')->toArray();

    // Damage report status breakdown (for Doughnut chart) — keys lowercase
    $damageStatus = [
        'pending' => Damage::where('status', 'pending')->count(),
        'accepted' => Damage::where('status', 'accepted')->count(),
        'declined' => Damage::where('status', 'declined')->count(),
    ];

    return [
        'labels' => $labels,
        'users' => $users,
        'appointments' => $appointments,
        'damageReports' => $damageReports,
        'roles' => $roles,
        'appointmentsPerService' => $appointmentsPerService,
        'damageStatus' => $damageStatus,
    ];
}



}
