@extends('layout.app')

@section('title', 'Admin Dashboard')

@section('content')
<style>
  canvas {
    width: 100% !important;
    height: 100% !important;
  }
</style>

<div class="max-w-7xl mx-auto p-6">
    <h1 class="text-3xl font-bold mb-8">Dashboard Overview</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <!-- Users Card -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden dark:bg-gray-800">
            <div class="p-4 bg-blue-600 text-white flex justify-between items-center">
                <h3 class="font-semibold">Total Users</h3>
                <i class="fas fa-users text-2xl"></i>
            </div>
            <div class="p-4">
                <p class="text-3xl font-bold dark:text-white">{{ $usersCount }}</p>
                <p class="text-gray-500 text-sm mt-1 dark:text-gray-300">Registered accounts</p>
            </div>
            <div class="px-4 py-2 bg-gray-50 border-t dark:bg-gray-700">
                <a href="{{ route('users.index') }}" class="text-blue-600 hover:underline text-sm flex items-center dark:text-blue-400">
                    <span>View all users</span>
                    <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </div>

        <!-- Services Card -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-4 bg-blue-600 text-white flex justify-between items-center">
                <h3 class="font-semibold">Total Services</h3>
                <i class="fas fa-concierge-bell text-2xl"></i>
            </div>
            <div class="p-4">
                <p class="text-3xl font-bold">{{ $servicesCount }}</p>
                <p class="text-gray-500 text-sm mt-1">Available services</p>
            </div>
            <div class="px-4 py-2 bg-gray-50 border-t">
                <a href="{{ route('providers.index') }}" class="text-blue-600 hover:underline text-sm flex items-center">
                    <span>View all services</span>
                    <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </div>

        <!-- Appointments Card -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden dark:bg-gray-800">
            <div class="p-4 bg-blue-600 text-white flex justify-between items-center">
                <h3 class="font-semibold">Total Appointments</h3>
                <i class="fas fa-calendar-check text-2xl"></i>
            </div>
            <div class="p-4">
                <p class="text-3xl font-bold dark:text-white">{{ $appointmentsCount }}</p>
                <p class="text-gray-500 text-sm mt-1 dark:text-gray-300">Scheduled appointments</p>
            </div>
            <div class="px-4 py-2 bg-gray-50 border-t dark:bg-gray-700">
                <a href="{{ route('appointments.index') }}" class="text-blue-600 hover:underline text-sm flex items-center dark:text-blue-400">
                    <span>View all appointments</span>
                    <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Recent Appointments -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-4 border-b">
                <h3 class="font-semibold text-lg">Recent Appointments</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Homeowner</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Service</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($recentAppointments as $appointment)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $appointment->homeowner->name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $appointment->service->name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $appointment->appointment_time->format('M d, Y H:i') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($appointment->status == 'pending')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                @elseif($appointment->status == 'accepted')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Accepted</span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Declined</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">No recent appointments</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                <a href="{{ route('appointments.index') }}" class="text-blue-600 hover:text-blue-800">View all appointments</a>
            </div>
        </div>

        <!-- Recent Damage Reports -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-4 border-b">
                <h3 class="font-semibold text-lg">Recent Damage Reports</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Damage Name(s)</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Reported By</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($recentDamageReports as $report)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $report->damages->pluck('name')->join(', ') ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $report->user->name ?? 'N/A' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $report->created_at->format('M d, Y') }}</div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500">No recent damage reports</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                <a href="{{ route('damages.index') }}" class="text-blue-600 hover:text-blue-800">View all damage reports</a>
            </div>
        </div>
    </div>

    <!-- Monthly Activity Chart -->
    <div class="grid grid-cols-1 mb-8">
        <div class="bg-white rounded-lg shadow-md overflow-hidden col-span-full">
            <div class="p-4 border-b">
                <h3 class="font-semibold text-lg">Monthly Activity</h3>
            </div>
            <div class="p-4" style="height: 300px;">
                <canvas id="statsChart"></canvas>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- User Role Distribution -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-4 border-b">
                <h3 class="font-semibold text-lg">User Role Distribution</h3>
            </div>
            <div class="p-4" style="height: 300px;">
                <canvas id="pieChart"></canvas>
            </div>
        </div>

        <!-- Appointments Per Service -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-4 border-b">
                <h3 class="font-semibold text-lg">Appointments Per Service</h3>
            </div>
            <div class="p-4" style="height: 300px;">
                <canvas id="barChart"></canvas>
            </div>
        </div>

        <!-- Damage Status Overview -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-4 border-b">
                <h3 class="font-semibold text-lg">Damage Status Overview</h3>
            </div>
            <div class="p-4" style="height: 300px;">
                <canvas id="doughnutChart"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        new Chart(document.getElementById('statsChart').getContext('2d'), {
            type: 'line',
            data: {
                labels: {!! json_encode($chartData['labels']) !!},
                datasets: [
                    {
                        label: 'New Users',
                        data: {!! json_encode($chartData['users']) !!},
                        backgroundColor: 'rgba(37, 99, 235, 0.2)',
                        borderColor: 'rgba(37, 99, 235, 1)',
                        borderWidth: 2,
                        tension: 0.3
                    },
                    {
                        label: 'Appointments',
                        data: {!! json_encode($chartData['appointments']) !!},
                        backgroundColor: 'rgba(59, 130, 246, 0.2)',
                        borderColor: 'rgba(59, 130, 246, 1)',
                        borderWidth: 2,
                        tension: 0.3
                    },
                    {
                        label: 'Damage Reports',
                        data: {!! json_encode($chartData['damageReports']) !!},
                        backgroundColor: 'rgba(96, 165, 250, 0.2)',
                        borderColor: 'rgba(96, 165, 250, 1)',
                        borderWidth: 2,
                        tension: 0.3
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });

        // User Role Distribution Pie Chart
        new Chart(document.getElementById('pieChart').getContext('2d'), {
            type: 'pie',
            data: {
                labels: ['Homeowners', 'Service Providers', 'Government'],
                datasets: [{
                    data: [
                        {{ $chartData['roles']['homeowners'] ?? 0 }},
                        {{ $chartData['roles']['providers'] ?? 0 }},
                        {{ $chartData['roles']['gov'] ?? 0 }}
                    ],
                    backgroundColor: ['#3b82f6', '#10b981', '#f59e0b']
                }]
            }
        });

        // Appointments Per Service Bar Chart
        new Chart(document.getElementById('barChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: {!! json_encode($chartData['services'] ?? []) !!},
                datasets: [{
                    label: 'Appointments',
                    data: {!! json_encode($chartData['appointmentsPerService'] ?? []) !!},
                    backgroundColor: '#6366f1'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });

        // Damage Status Doughnut Chart
        new Chart(document.getElementById('doughnutChart').getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: ['Accepted', 'Declined', 'Pending'],
                datasets: [{
                    data: [
                        {{ $chartData['damageStatus']['accepted'] ?? 0 }},
                        {{ $chartData['damageStatus']['declined'] ?? 0 }},
                        {{ $chartData['damageStatus']['pending'] ?? 0 }}
                    ],
                    backgroundColor: ['#22c55e', '#ef4444', '#fbbf24']
                }]
            }
        });
    });
</script>
@endpush
