@extends('layout.app')

@section('title', 'Government Dashboard')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header Section -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent mb-4">
                Government Dashboard
            </h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Monitor and manage damage claims, reports, and contracts
            </p>
        </div>

        {{-- Statistics Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-2xl shadow-lg p-6 text-center hover:shadow-xl transition-shadow">
                <h3 class="text-xl font-semibold text-gray-700">Total Claimed Damages</h3>
                <p class="mt-2 text-3xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">{{ $totalClaims }}</p>
            </div>
            <div class="bg-white rounded-2xl shadow-lg p-6 text-center hover:shadow-xl transition-shadow">
                <h3 class="text-xl font-semibold text-gray-700">Total Contracts</h3>
                <p class="mt-2 text-3xl font-bold bg-gradient-to-r from-green-600 to-teal-600 bg-clip-text text-transparent">{{ $totalContracts }}</p>
            </div>
            <div class="bg-white rounded-2xl shadow-lg p-6 text-center hover:shadow-xl transition-shadow">
                <h3 class="text-xl font-semibold text-gray-700">Homeowners with Reports</h3>
                <p class="mt-2 text-3xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">{{ $totalHomeowners }}</p>
            </div>
        </div>

        {{-- Claimed Damages Section --}}
        <div class="bg-white rounded-3xl shadow-xl mb-8">
            <div class="bg-gradient-to-r from-gray-50 to-blue-50 px-8 py-6 border-b border-gray-100 rounded-t-3xl">
                <h2 class="text-2xl font-bold text-gray-900">📋 Claimed Damages</h2>
                <p class="text-gray-600 mt-1">Pending damage claims requiring review</p>
            </div>

            <div class="p-8">
                @if($claimedDamages->isEmpty())
                    <div class="text-center py-8">
                        <div class="mx-auto h-20 w-20 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                            <svg class="h-10 w-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">No Pending Claims</h3>
                        <p class="text-gray-500">All damage claims have been processed</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Homeowner</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Damage Type</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Images</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($claimedDamages as $damage)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ $damage->report->user->name ?? 'N/A' }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $damage->name }}</div>
                                        </td>
                                        <td class="px-6 py-4">
    @php
        $maxLength = 50;
        $desc = $damage->description;
        $isTruncated = strlen($desc) > $maxLength;
    @endphp

    <div class="text-sm text-gray-900 max-w-xs truncate" @if($isTruncated) title="{{ $desc }}" @endif>
        {{ $isTruncated ? Str::limit($desc, $maxLength) : $desc }}
    </div>
</td>


                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($damage->image_path)
                                                <a href="{{ route('government.damages.images', $damage->id) }}" class="text-blue-600 hover:text-blue-800 inline-flex items-center">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                    </svg>
                                                    View
                                                </a>
                                            @else
                                                <span class="text-gray-500">No Image</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex space-x-2">
                                                <form action="{{ route('government.damages.accept', $damage->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="inline-flex items-center px-3 py-1 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                        </svg>
                                                        Accept
                                                    </button>
                                                </form>
                                                <form action="{{ route('government.damages.decline', $damage->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="inline-flex items-center px-3 py-1 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                        </svg>
                                                        Decline
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        {{-- Damage Reports Section --}}
        <div class="bg-white rounded-3xl shadow-xl mb-8">
            <div class="bg-gradient-to-r from-gray-50 to-blue-50 px-8 py-6 border-b border-gray-100 rounded-t-3xl">
                <h2 class="text-2xl font-bold text-gray-900">📝 Damage Reports</h2>
                <p class="text-gray-600 mt-1">Damage reports submitted by homeowners</p>
            </div>

            <div class="p-8">
                @if($homeowners->isEmpty())
                    <div class="text-center py-8">
                        <div class="mx-auto h-20 w-20 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                            <svg class="h-10 w-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">No Damage Reports</h3>
                        <p class="text-gray-500">No homeowners have submitted damage reports yet</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Homeowner</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Address</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($homeowners as $homeowner)
                                    @php $report = $homeowner->damageReports->first(); @endphp
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ $homeowner->name }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $report->city ?? 'N/A' }}, {{ $report->street ?? 'N/A' }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <a href="{{ route('government.damageReports.show', $homeowner->id) }}" 
                                               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                                View Reports
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        {{-- Contracts Section --}}
        <div class="bg-white rounded-3xl shadow-xl mb-8">
            <div class="bg-gradient-to-r from-gray-50 to-blue-50 px-8 py-6 border-b border-gray-100 rounded-t-3xl">
                <h2 class="text-2xl font-bold text-gray-900">📜 Contracts</h2>
                <p class="text-gray-600 mt-1">Approved contracts between homeowners and providers</p>
            </div>

            <div class="p-8">
                @if($contracts->isEmpty())
                    <div class="text-center py-8">
                        <div class="mx-auto h-20 w-20 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                            <svg class="h-10 w-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">No Contracts</h3>
                        <p class="text-gray-500">No contracts have been created yet</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Homeowner</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Service Provider</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Service</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Details</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($contracts as $contract)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ $contract->appointment->homeowner->name ?? 'N/A' }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $contract->appointment->provider->name ?? 'N/A' }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $contract->appointment->service->name ?? 'N/A' }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-900 max-w-xs truncate">{{ $contract->contract_details ?? $contract->details ?? '—' }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <a href="{{ route('government.contracts.show', $contract->id) }}"
                                               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                                </svg>
                                                View Contract
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        {{-- Analytics Section --}}
        <div class="bg-white rounded-3xl shadow-xl">
            <div class="bg-gradient-to-r from-gray-50 to-blue-50 px-8 py-6 border-b border-gray-100 rounded-t-3xl">
                <h2 class="text-2xl font-bold text-gray-900">📊 Analytics</h2>
                <p class="text-gray-600 mt-1">Visual representation of system data</p>
            </div>

            <div class="p-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Contract Status Chart -->
                <div class="bg-white p-6 rounded-xl border border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Contract Statuses</h3>
                    <canvas id="contractStatusChart" class="w-full h-64"></canvas>
                </div>

                <!-- Damage Types Chart -->
                <div class="bg-white p-6 rounded-xl border border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Claimed Damages by Homeowner</h3>
                    <canvas id="damageTypeChart" class="w-full h-64"></canvas>
                </div>

                <!-- Services Chart -->
                <div class="bg-white p-6 rounded-xl border border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Contracts per Service</h3>
                    <canvas id="serviceChart" class="w-full h-64"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Pie Chart: Contract Status
    const contractStatusCtx = document.getElementById('contractStatusChart').getContext('2d');
    new Chart(contractStatusCtx, {
        type: 'pie',
        data: {
            labels: {!! json_encode(array_keys($contractStatusCounts->toArray())) !!},
            datasets: [{
                data: {!! json_encode(array_values($contractStatusCounts->toArray())) !!},
                backgroundColor: ['#60A5FA', '#34D399', '#F87171', '#FBBF24'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                }
            }
        }
    });

    // Bar Chart: Claimed Damages by Homeowner
    const damageTypeCtx = document.getElementById('damageTypeChart').getContext('2d');
    new Chart(damageTypeCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode(array_keys($claimedDamageByHomeowner->toArray())) !!},
            datasets: [{
                label: 'Claimed Damages',
                data: {!! json_encode(array_values($claimedDamageByHomeowner->toArray())) !!},
                backgroundColor: '#93C5FD',
                borderColor: '#3B82F6',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { 
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    // Doughnut Chart: Contracts per Service
    const serviceChartCtx = document.getElementById('serviceChart').getContext('2d');
    new Chart(serviceChartCtx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode(array_keys($serviceCounts->toArray())) !!},
            datasets: [{
                data: {!! json_encode(array_values($serviceCounts->toArray())) !!},
                backgroundColor: ['#34D399', '#F59E0B', '#60A5FA', '#EF4444', '#A78BFA'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                }
            }
        }
    });
</script>
@endsection