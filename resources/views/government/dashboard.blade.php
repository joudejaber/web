@extends('layout.app')

@section('title', 'Dashboard')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- Section 0: Claimed Damages --}}
    <div class="mb-12">
        <h2 class="text-2xl font-semibold text-blue-700 mb-4">Claimed Damages</h2>
        <div class="bg-white shadow rounded-lg overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-100 text-gray-700 text-sm font-semibold">
                    <tr>
                        <th class="px-6 py-3 text-left">Homeowner</th>
                        <th class="px-6 py-3 text-left">Damage Type</th>
                        <th class="px-6 py-3 text-left">Description</th>
                        <th class="px-6 py-3 text-left">Images</th>
                        <th class="px-6 py-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-600 divide-y divide-gray-200">
                    @forelse($claimedDamages as $damage)
                        <tr>
                            <td class="px-6 py-4">{{ $damage->report->user->name ?? 'N/A' }}</td>
                            <td class="px-6 py-4">{{ $damage->name }}</td>
                            <td class="px-6 py-4">{{ $damage->description }}</td>
                            <td class="px-6 py-4">
                                @if($damage->image_path)
                                    <a href="{{ route('government.damages.images', $damage->id) }}" class="text-blue-600 hover:underline">View Images</a>
                                @else
                                    <span>No Image</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 space-x-2">
                                <form action="{{ route('government.damages.accept', $damage->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700 text-sm">Accept</button>
                                </form>
                                <form action="{{ route('government.damages.decline', $damage->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 text-sm">Decline</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-gray-500 px-6 py-4">No pending damage claims.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Section 1: Damage Reports by Homeowner --}}
    <div class="mb-12">
        <h2 class="text-2xl font-semibold text-blue-700 mb-4">Damage Reports by Homeowner</h2>
        <div class="bg-white shadow rounded-lg overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-100 text-gray-700 text-sm font-semibold">
                    <tr>
                        <th class="px-6 py-3 text-left">Homeowner</th>
                        <th class="px-6 py-3 text-left">Address</th>
                        <th class="px-6 py-3 text-left">View Reports</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-600 divide-y divide-gray-200">
                    @forelse($homeowners as $homeowner)
                        @php $report = $homeowner->damageReports->first(); @endphp
                        <tr>
                            <td class="px-6 py-4">{{ $homeowner->name }}</td>
                            <td class="px-6 py-4">{{ $report->city ?? 'N/A' }}, {{ $report->street ?? 'N/A' }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('government.damageReports.show', $homeowner->id) }}" class="text-blue-600 hover:underline">View Reports</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-gray-500 px-6 py-4">No damage reports found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Section 2: Contracts --}}
    <div>
        <h2 class="text-2xl font-semibold text-blue-700 mb-4">Contracts</h2>
        <div class="bg-white shadow rounded-lg overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-100 text-gray-700 text-sm font-semibold">
                    <tr>
                        <th class="px-6 py-3 text-left">Homeowner</th>
                        <th class="px-6 py-3 text-left">Service Provider</th>
                        <th class="px-6 py-3 text-left">Service</th>
                        <th class="px-6 py-3 text-left">Details</th>
                        <th class="px-6 py-3 text-left">View Contract</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-600 divide-y divide-gray-200">
                    @forelse($contracts as $contract)
                        <tr>
                            <td class="px-6 py-4">{{ $contract->appointment->homeowner->name ?? 'N/A' }}</td>
                            <td class="px-6 py-4">{{ $contract->appointment->provider->name ?? 'N/A' }}</td>
                            <td class="px-6 py-4">{{ $contract->appointment->service->name ?? 'N/A' }}</td>
                            <td class="px-6 py-4">{{ $contract->contract_details ?? $contract->details ?? '—' }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('government.contracts.show', $contract->id) }}"
                                   class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 font-medium">
                                    View Contract
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-gray-500 px-6 py-4">No contracts found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Section 3: Statistics --}}
    <div class="mt-12">
        <h2 class="text-2xl font-semibold text-blue-700 mb-4">Statistics Overview</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white shadow rounded-lg p-6 text-center">
                <h3 class="text-xl font-semibold text-gray-700">Total Claimed Damages</h3>
                <p class="mt-2 text-3xl text-blue-600 font-bold">{{ $totalClaims }}</p>
            </div>
            <div class="bg-white shadow rounded-lg p-6 text-center">
                <h3 class="text-xl font-semibold text-gray-700">Total Contracts</h3>
                <p class="mt-2 text-3xl text-green-600 font-bold">{{ $totalContracts }}</p>
            </div>
            <div class="bg-white shadow rounded-lg p-6 text-center">
                <h3 class="text-xl font-semibold text-gray-700">Homeowners with Reports</h3>
                <p class="mt-2 text-3xl text-purple-600 font-bold">{{ $totalHomeowners }}</p>
            </div>
        </div>
    </div>

    {{-- Section 4: Graphs --}}
    <div class="mt-16">
        <h2 class="text-2xl font-semibold text-blue-700 mb-6">Visual Statistics</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Pie Chart: Contract Status -->
            <div class="bg-white shadow rounded-lg p-4">
                <h3 class="text-lg font-medium mb-2">Contract Statuses</h3>
                <canvas id="contractStatusChart"></canvas>
            </div>

            <!-- Bar Chart: Damage Types -->
            <div class="bg-white shadow rounded-lg p-4">
                <h3 class="text-lg font-medium mb-2">Claimed Damages by Homeowner</h3>
                <canvas id="damageTypeChart"></canvas>
            </div>

            <!-- Doughnut Chart: Contracts per Service -->
            <div class="bg-white shadow rounded-lg p-4">
                <h3 class="text-lg font-medium mb-2">Contracts per Service</h3>
                <canvas id="serviceChart"></canvas>
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
                label: 'Contract Statuses',
                data: {!! json_encode(array_values($contractStatusCounts->toArray())) !!},
                backgroundColor: ['#60A5FA', '#34D399', '#F87171', '#FBBF24'],
            }]
        }
    });

    // Bar Chart: Claimed Damages by Homeowner
const damageTypeCtx = document.getElementById('damageTypeChart').getContext('2d');
new Chart(damageTypeCtx, {
    type: 'bar',
    data: {
        labels: {!! json_encode(array_keys($claimedDamageByHomeowner->toArray())) !!},
        datasets: [{
            label: 'Claimed Damages by Homeowner',
            data: {!! json_encode(array_values($claimedDamageByHomeowner->toArray())) !!},
            backgroundColor: '#93C5FD',
            borderColor: '#3B82F6',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: { beginAtZero: true }
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
                label: 'Contracts per Service',
                data: {!! json_encode(array_values($serviceCounts->toArray())) !!},
                backgroundColor: ['#34D399', '#F59E0B', '#60A5FA', '#EF4444', '#A78BFA'],
            }]
        }
    });
</script>

@endsection
