<?php

namespace App\Http\Controllers;
use App\Models\Damage;
use App\Models\DamageReport;
use App\Models\Contract;
use App\Models\User;

use Illuminate\Http\Request;

class GovernmentController extends Controller
{
   public function dashboard()
{
    // Homeowners with their damage reports and related damages
    $homeowners = User::with(['damageReports.damages'])
        ->whereHas('damageReports')
        ->get();

    // Claimed damages (pending ones)
    $claimedDamages = Damage::with('report.user')
        ->where('status', 'pending')
        ->get();

    // All contracts with relevant appointment relationships
    $contracts = Contract::with('appointment.homeowner', 'appointment.provider', 'appointment.service')->get();

    // Basic totals
    $totalClaims = $claimedDamages->count();
    $totalContracts = $contracts->count();
    $totalHomeowners = $homeowners->count();

    // --- Chart Data ---

    // Pie Chart: Contract statuses (e.g. pending, completed)
    $contractStatusCounts = $contracts->groupBy('status')->map->count();

    // Bar Chart: Damage types from claimed damages
    $damageTypeCounts = $claimedDamages->groupBy('name')->map->count();

    // Doughnut Chart: Number of contracts per service
    $serviceCounts = $contracts
        ->filter(fn($contract) => $contract->appointment && $contract->appointment->service)
        ->groupBy(fn($contract) => $contract->appointment->service->name)
        ->map->count();
    // Group claimed damages by homeowner name and count them
    $claimedDamageByHomeowner = Damage::with('report.user')
        ->where('status', 'pending')
        ->get()
        ->groupBy(fn($damage) => $damage->report->user->name ?? 'Unknown')
        ->map->count();


    return view('government.dashboard', compact(
        'claimedDamages',
        'contracts',
        'homeowners',
        'totalClaims',
        'totalContracts',
        'totalHomeowners',
        'contractStatusCounts',
        'damageTypeCounts',
        'serviceCounts',
        'claimedDamageByHomeowner'
    ));
}

public function showDamageReports(User $user)
{
    $damageReports = $user->damageReports()->with('damages')->get();

    return view('government.damageReports.show', compact('user', 'damageReports'));
}

public function showContract(Contract $contract)
{
    // Eager load existing relations plus works
    $contract->load('appointment.homeowner', 'appointment.provider', 'appointment.service', 'works');

    // Calculate total cost of all works
    $totalCost = $contract->works->sum('cost');

    // Pass the totalCost variable to the view alongside the contract
    return view('government.contracts.show', compact('contract', 'totalCost'));
}

}
