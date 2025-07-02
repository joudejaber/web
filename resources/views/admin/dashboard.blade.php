@extends('layout.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header Section -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent mb-4">
                Admin Dashboard
            </h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Comprehensive overview of system activities and statistics
            </p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <!-- Users Card -->
            <div class="bg-white rounded-xl shadow-lg p-4 text-center hover:shadow-xl transition-shadow"> 
                <div class="mx-auto h-14 w-14 bg-blue-100 rounded-full flex items-center justify-center mb-3"> 
                    <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-700">Total Users</h3> 
                <p class="mt-1 text-2xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">{{ $usersCount }}</p> <!-- Smaller text -->
                <p class="text-xs text-gray-500 mt-1">Registered accounts</p>
                <a href="{{ route('users.index') }}" class="mt-2 inline-flex items-center text-blue-600 hover:text-blue-800 text-xs"> <!-- Smaller text -->
                    View all users
                    <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"> 
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>

            <!-- Services Card -->
            <div class="bg-white rounded-xl shadow-lg p-4 text-center hover:shadow-xl transition-shadow">
                <div class="mx-auto h-14 w-14 bg-green-100 rounded-full flex items-center justify-center mb-3">
                    <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-700">Total Services</h3>
                <p class="mt-1 text-2xl font-bold bg-gradient-to-r from-green-600 to-teal-600 bg-clip-text text-transparent">{{ $servicesCount }}</p>
                <p class="text-xs text-gray-500 mt-1">Available services</p>
                <a href="{{ route('providers.index') }}" class="mt-2 inline-flex items-center text-blue-600 hover:text-blue-800 text-xs">
                    View all services
                    <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>

            <!-- Appointments Card -->
            <div class="bg-white rounded-xl shadow-lg p-4 text-center hover:shadow-xl transition-shadow">
                <div class="mx-auto h-14 w-14 bg-purple-100 rounded-full flex items-center justify-center mb-3">
                    <svg class="h-6 w-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-700">Total Appointments</h3>
                <p class="mt-1 text-2xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">{{ $appointmentsCount }}</p>
                <p class="text-xs text-gray-500 mt-1">Scheduled appointments</p>
                <a href="{{ route('appointments.index') }}" class="mt-2 inline-flex items-center text-blue-600 hover:text-blue-800 text-xs">
                    View all appointments
                    <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Recent Damage Reports - Made more compact -->
        <div class="mb-6"> <!-- Reduced margin -->
            <div class="bg-white rounded-2xl shadow-xl"> <!-- Reduced rounded corners -->
                <div class="bg-gradient-to-r from-gray-50 to-blue-50 px-6 py-4 border-b border-gray-100 rounded-t-2xl"> <!-- Reduced padding -->
                    <h2 class="text-xl font-bold text-gray-900">⚠️ Recent Damage Reports</h2> <!-- Smaller text -->
                    <p class="text-sm text-gray-600 mt-1">Latest reported damages in the system</p> <!-- Smaller text -->
                </div>
                <div class="p-4"> <!-- Reduced padding -->
                    @if($recentDamageReports->isEmpty())
                        <div class="text-center py-6"> <!-- Reduced padding -->
                            <div class="mx-auto h-16 w-16 bg-gray-100 rounded-full flex items-center justify-center mb-3"> <!-- Smaller icon -->
                                <svg class="h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-md font-semibold text-gray-900 mb-1">No Recent Damage Reports</h3> <!-- Smaller text -->
                            <p class="text-sm text-gray-500">No damage reports have been submitted recently</p> <!-- Smaller text -->
                        </div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4"> <!-- Reduced gap -->
                            @foreach($recentDamageReports as $report)
                            <div class="border border-gray-200 rounded-lg hover:shadow-md transition-shadow"> <!-- Reduced rounded corners -->
                                <div class="p-3"> <!-- Reduced padding -->
                                    <h3 class="font-medium text-gray-900 text-sm mb-1">Report #{{ $report->id }}</h3> <!-- Smaller text -->
                                    <p class="text-xs text-gray-600 mb-1"> <!-- Smaller text -->
                                        <span class="font-medium">Damages:</span> 
                                        {{ $report->damages->pluck('name')->join(', ') ?? 'N/A' }}
                                    </p>
                                    <div class="flex items-center text-xs text-gray-500"> <!-- Smaller text -->
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        {{ $report->user->name ?? 'N/A' }}
                                    </div>
                                    <div class="flex items-center text-xs text-gray-500 mt-1"> <!-- Smaller text -->
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        {{ $report->created_at->format('M d, Y') }}
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="px-4 py-3 bg-gray-50 rounded-b-2xl text-right"> <!-- Reduced padding and rounded corners -->
                    <a href="{{ route('damages.index') }}" class="text-blue-600 hover:text-blue-800 text-xs font-medium inline-flex items-center"> <!-- Smaller text -->
                        View all damage reports
                        <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"> <!-- Smaller icon -->
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- Recent Appointments Section - Made more compact -->
        <div class="bg-white rounded-2xl shadow-xl mb-6"> <!-- Reduced margin and rounded corners -->
            <div class="bg-gradient-to-r from-gray-50 to-blue-50 px-6 py-4 border-b border-gray-100 rounded-t-2xl"> <!-- Reduced padding -->
                <h2 class="text-xl font-bold text-gray-900">📅 Recent Appointments</h2> <!-- Smaller text -->
                <p class="text-sm text-gray-600 mt-1">Latest scheduled appointments in the system</p> <!-- Smaller text -->
            </div>
            <div class="p-4 overflow-x-auto"> <!-- Reduced padding -->
                <table class="min-w-full divide-y divide-gray-200 text-sm"> <!-- Smaller text -->
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Homeowner</th> <!-- Reduced padding -->
                            <th scope="col" class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Service</th>
                            <th scope="col" class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th scope="col" class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($recentAppointments as $appointment)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-4 py-3 whitespace-nowrap"> <!-- Reduced padding -->
                                <div class="text-sm font-medium text-gray-900">{{ $appointment->homeowner->name }}</div>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $appointment->service->name }}</div>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $appointment->appointment_time->format('M d, Y H:i') }}</div>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
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
                            <td colspan="4" class="px-4 py-3 text-center text-sm text-gray-500">No recent appointments</td> <!-- Reduced padding -->
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-4 py-3 bg-gray-50 rounded-b-2xl text-right"> <!-- Reduced padding and rounded corners -->
                <a href="{{ route('appointments.index') }}" class="text-blue-600 hover:text-blue-800 text-xs font-medium inline-flex items-center"> <!-- Smaller text -->
                    View all appointments
                    <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"> <!-- Smaller icon -->
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Analytics Section - Made more compact -->
        <div class="bg-white rounded-2xl shadow-xl mb-6"> <!-- Reduced margin and rounded corners -->
            <div class="bg-gradient-to-r from-gray-50 to-blue-50 px-6 py-4 border-b border-gray-100 rounded-t-2xl"> <!-- Reduced padding -->
                <h2 class="text-xl font-bold text-gray-900">📊 Monthly Activity</h2> <!-- Smaller text -->
                <p class="text-sm text-gray-600 mt-1">System activity over time</p> <!-- Smaller text -->
            </div>
            <div class="p-4" style="height: 250px;"> <!-- Reduced height and padding -->
                <canvas id="statsChart"></canvas>
            </div>
        </div>

        <!-- Charts Section - Made more compact -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4"> <!-- Reduced gap -->
            <!-- User Role Distribution -->
            <div class="bg-white rounded-2xl shadow-xl"> <!-- Reduced rounded corners -->
                <div class="bg-gradient-to-r from-gray-50 to-blue-50 px-6 py-4 border-b border-gray-100 rounded-t-2xl"> <!-- Reduced padding -->
                    <h2 class="text-xl font-bold text-gray-900">👥 User Roles</h2> <!-- Smaller text -->
                    <p class="text-sm text-gray-600 mt-1">Distribution of user types</p> <!-- Smaller text -->
                </div>
                <div class="p-4" style="height: 250px;"> <!-- Reduced height and padding -->
                    <canvas id="pieChart"></canvas>
                </div>
            </div>

            <!-- Appointments Per Service -->
            <div class="bg-white rounded-2xl shadow-xl">
                <div class="bg-gradient-to-r from-gray-50 to-blue-50 px-6 py-4 border-b border-gray-100 rounded-t-2xl">
                    <h2 class="text-xl font-bold text-gray-900">🔧 Services</h2>
                    <p class="text-sm text-gray-600 mt-1">Appointments per service</p>
                </div>
                <div class="p-4" style="height: 250px;">
                    <canvas id="barChart"></canvas>
                </div>
            </div>

            <!-- Damage Status Overview -->
            <div class="bg-white rounded-2xl shadow-xl">
                <div class="bg-gradient-to-r from-gray-50 to-blue-50 px-6 py-4 border-b border-gray-100 rounded-t-2xl">
                    <h2 class="text-xl font-bold text-gray-900">⚠️ Damage Status</h2>
                    <p class="text-sm text-gray-600 mt-1">Overview of damage reports</p>
                </div>
                <div class="p-4" style="height: 250px;">
                    <canvas id="doughnutChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Monthly Activity Line Chart
        new Chart(document.getElementById('statsChart').getContext('2d'), {
            type: 'line',
            data: {
                labels: {!! json_encode($chartData['labels']) !!},
                datasets: [
                    {
                        label: 'New Users',
                        data: {!! json_encode($chartData['users']) !!},
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        borderColor: 'rgba(59, 130, 246, 1)',
                        borderWidth: 2,
                        tension: 0.3,
                        fill: true
                    },
                    {
                        label: 'Appointments',
                        data: {!! json_encode($chartData['appointments']) !!},
                        backgroundColor: 'rgba(16, 185, 129, 0.1)',
                        borderColor: 'rgba(16, 185, 129, 1)',
                        borderWidth: 2,
                        tension: 0.3,
                        fill: true
                    },
                    {
                        label: 'Damage Reports',
                        data: {!! json_encode($chartData['damageReports']) !!},
                        backgroundColor: 'rgba(245, 158, 11, 0.1)',
                        borderColor: 'rgba(245, 158, 11, 1)',
                        borderWidth: 2,
                        tension: 0.3,
                        fill: true
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: {
                                size: 10 
                            }
                        }
                    }
                },
                scales: {
                    y: { 
                        beginAtZero: true,
                        grid: {
                            drawBorder: false
                        },
                        ticks: {
                            font: {
                                size: 10
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                size: 10 // Smaller x-axis text
                            }
                        }
                    }
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
                    backgroundColor: ['#3b82f6', '#10b981', '#f59e0b'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: {
                                size: 10 // Smaller legend text
                            }
                        }
                    }
                }
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
                    backgroundColor: '#6366f1',
                    borderRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: { 
                        beginAtZero: true,
                        grid: {
                            drawBorder: false
                        },
                        ticks: {
                            font: {
                                size: 10 // Smaller y-axis text
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                size: 10 // Smaller x-axis text
                            }
                        }
                    }
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
                    backgroundColor: ['#22c55e', '#ef4444', '#fbbf24'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: {
                                size: 10 // Smaller legend text
                            }
                        }
                    }
                },
                cutout: '70%'
            }
        });
    });
</script>
@endpush
@endsection