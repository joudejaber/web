@extends('layout.app')

@section('title', 'Contract Details')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header Section -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent mb-2">
                Contract Details
            </h1>
            <p class="text-lg text-gray-600">Contract #{{ $contract->id }}</p>
        </div>

        <!-- Contract Information Card -->
        <div class="bg-white rounded-3xl shadow-xl p-8 mb-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="space-y-1">
                    <h3 class="text-sm font-medium text-gray-500">Homeowner</h3>
                    <p class="text-lg font-semibold text-gray-900">{{ $contract->appointment->homeowner->name ?? 'N/A' }}</p>
                </div>
                <div class="space-y-1">
                    <h3 class="text-sm font-medium text-gray-500">Service Provider</h3>
                    <p class="text-lg font-semibold text-gray-900">{{ $contract->appointment->provider->name ?? 'N/A' }}</p>
                </div>
                <div class="space-y-1">
                    <h3 class="text-sm font-medium text-gray-500">Service</h3>
                    <p class="text-lg font-semibold text-gray-900">{{ $contract->appointment->service->name ?? 'N/A' }}</p>
                </div>
                <div class="space-y-1">
                    <h3 class="text-sm font-medium text-gray-500">Status</h3>
                    <p class="text-lg font-semibold text-gray-900 capitalize">{{ $contract->status ?? 'N/A' }}</p>
                </div>
            </div>

            <div class="space-y-1">
                <h3 class="text-sm font-medium text-gray-500">Contract Details</h3>
                <div class="bg-gray-50 p-4 rounded-xl border border-gray-200">
                    <p class="whitespace-pre-line text-gray-900">{{ $contract->contract_details ?? $contract->details ?? 'No details available.' }}</p>
                </div>
            </div>
        </div>

        <!-- Works Done Section -->
        <div class="bg-white rounded-3xl shadow-xl p-8 mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Works Done</h2>

            @if($contract->works->isEmpty())
                <div class="text-center py-8">
                    <div class="mx-auto h-20 w-20 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                        <svg class="h-10 w-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">No Works Recorded</h3>
                    <p class="text-gray-500">No works have been added to this contract yet</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cost</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Images</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($contract->works as $work)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-normal">
                                        <div class="text-sm text-gray-900">{{ $work->description ?? '—' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">${{ number_format($work->cost, 2) }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-wrap gap-2">
                                            @if($work->images && $work->images->count() > 0)
                                                @foreach($work->images as $image)
                                                    <a href="{{ asset('storage/' . $image->image_path) }}" target="_blank" rel="noopener noreferrer" class="group">
                                                        <img src="{{ asset('storage/' . $image->image_path) }}" 
                                                             alt="Work Image" 
                                                             class="h-16 w-auto rounded-lg border border-gray-200 group-hover:shadow-md transition-shadow">
                                                    </a>
                                                @endforeach
                                            @else
                                                <span class="text-sm text-gray-500">No images</span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-6 p-4 bg-blue-50 rounded-xl border border-blue-200">
                    <p class="text-lg font-semibold text-blue-800">Total Cost: ${{ number_format($contract->works->sum('cost'), 2) }}</p>
                </div>
            @endif
        </div>

        <!-- Back Button -->
        <a href="{{ route('government.dashboard') }}" 
           class="inline-flex items-center px-6 py-3 bg-white text-gray-700 font-medium rounded-xl shadow hover:bg-gray-50 transition-colors border border-gray-200">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Dashboard
        </a>
    </div>
</div>
@endsection