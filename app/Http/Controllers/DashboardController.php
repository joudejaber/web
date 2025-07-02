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
        $damages = $personalInfo ? $personalInfo->damages : collect();
        $report = DamageReport::where('user_id', $user->id)->first();

        // 🔔 Get unread notifications
        $notifications = $user->unreadNotifications;

        return view("dashboard.homeOwner", compact(
            "damageReports",
            "report",
            "personalInfo",
            "damages",
            "notifications"
        ));
    }

    if ($user->role_id == 2) {
        $provider = $user->provider ?? new Provider();
        $services = $user->service()->with('productofservice')->latest()->get();
        $products = $user->productofservice()->with('service')->latest()->get();
        return view("dashboard.serviceProvider", compact("services", "products", "provider"));
    }

    if ($user->role_id == 3) {
        // 👉 Only pending damages for claim stats
        $claimedDamages = Damage::with('report.user')
            ->where('status', 'pending')
            ->get();

        // 👉 All claimed damages (any status) for the bar chart
        $allClaimedDamages = Damage::with('report.user')->get();

        // Bar chart data: Count damages grouped by homeowner name
        $claimedDamageByHomeowner = $allClaimedDamages
            ->filter(fn($damage) => $damage->report && $damage->report->user)
            ->groupBy(fn($damage) => $damage->report->user->name)
            ->map->count();

        // Other data
        $damageReports = DamageReport::with('user')->get();

        $contracts = Contract::with('appointment.homeowner', 'appointment.provider', 'appointment.service')->get();

        $homeowners = User::with(['damageReports.damages'])
            ->whereHas('damageReports')
            ->get();

        // Stats
        $totalClaims = $claimedDamages->count();
        $totalContracts = $contracts->count();
        $totalHomeowners = $homeowners->count();

        // Pie chart data: contract status breakdown
        $contractStatusCounts = $contracts->groupBy('status')->map->count();

        // Doughnut chart: contracts per service
        $serviceCounts = $contracts
            ->filter(fn($contract) => $contract->appointment && $contract->appointment->service)
            ->groupBy(fn($contract) => $contract->appointment->service->name)
            ->map->count();

        return view('government.dashboard', compact(
            'claimedDamages',           // pending only
            'damageReports',
            'contracts',
            'homeowners',
            'totalClaims',
            'totalContracts',
            'totalHomeowners',
            'contractStatusCounts',
            'claimedDamageByHomeowner', // all statuses
            'serviceCounts'
        ));
    }

    if ($user->role_id == 4) {
        $usersCount = User::count();
        $servicesCount = Service::count();
        $appointmentsCount = Appointment::count();
        $productsCount = ProductOfService::count();

        $recentAppointments = Appointment::with(['homeowner', 'service'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $recentDamageReports = DamageReport::with(['user', 'damages'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

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
