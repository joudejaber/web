@extends('layout.app')

@section('title', 'View Contract')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100">
    <!-- Back Navigation -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pt-8">
        <a href="{{ route('appointments.create') }}" 
           class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium transition-colors group">
            <svg class="w-5 h-5 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Appointments
        </a>
    </div>

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden">
            <!-- Header Section -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-8 py-10">
                <div class="text-center">
                    <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">Contract Details</h1>
                    <p class="text-blue-100 text-lg">Review your service contract agreement and work details</p>
                </div>
            </div>

            <!-- Contract Info Section -->
            <div class="p-8">
                <div class="space-y-8">
                    <!-- Contract Information -->
                    <div class="space-y-6">
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">Contract Information</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">Homeowner</label>
                                <div class="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50 text-gray-900">
                                    {{ $contract->appointment->homeowner->name ?? 'N/A' }}
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">Service Provider</label>
                                <div class="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50 text-gray-900">
                                    {{ $contract->appointment->provider->name ?? 'N/A' }}
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">Service</label>
                                <div class="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50 text-gray-900">
                                    {{ $contract->appointment->service->name ?? 'N/A' }}
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">Status</label>
                                <div class="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50">
                                    @php
                                        $status = $contract->status ?? 'pending';
                                        $statusColors = [
                                            'pending' => 'bg-yellow-100 text-yellow-800',
                                            'approved' => 'bg-green-100 text-green-800',
                                            'accepted' => 'bg-green-100 text-green-800',
                                            'rejected' => 'bg-red-100 text-red-800',
                                            'completed' => 'bg-blue-100 text-blue-800'
                                        ];
                                    @endphp
                                    <span class="inline-flex px-3 py-1 rounded-full text-sm font-medium {{ $statusColors[$status] ?? $statusColors['pending'] }}">
                                        {{ ucfirst($status) }}
                                    </span>
                                </div>
                            </div>

                            <div class="space-y-2 md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700">Contract Details</label>
                                <div class="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50 text-gray-900 whitespace-pre-line min-h-[120px]">
                                    {{ $contract->contract_details ?? $contract->details ?? 'No details available.' }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Works Done Section -->
                    <div class="space-y-6">
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-green-600 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">Work Performed</h3>
                        </div>

                        @if($contract->works->isEmpty())
                            <div class="text-center py-12">
                                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                <p class="text-gray-500 text-lg">No work details have been added to this contract yet</p>
                            </div>
                        @else
                            <div class="space-y-4">
                                @foreach($contract->works as $work)
                                    <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                                            <div class="lg:col-span-2 space-y-4">
                                                <div>
                                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Work Description</label>
                                                    <p class="text-gray-900">{{ $work->description ?? '—' }}</p>
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Cost</label>
                                                    <p class="text-2xl font-bold text-green-600">${{ number_format($work->cost, 2) }}</p>
                                                </div>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-semibold text-gray-700 mb-2">Images</label>
                                                @if($work->images && $work->images->count() > 0)
                                                    <div class="grid grid-cols-2 gap-2">
                                                        @foreach($work->images as $image)
                                                            <a href="{{ asset('storage/' . $image->image_path) }}" target="_blank" rel="noopener noreferrer" class="block">
                                                                <img src="{{ asset('storage/' . $image->image_path) }}" alt="Work Image" class="w-full h-20 object-cover rounded-lg border border-gray-200 hover:border-blue-400 transition-colors" />
                                                            </a>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <div class="flex items-center justify-center h-20 bg-gray-100 rounded-lg border-2 border-dashed border-gray-300">
                                                        <span class="text-gray-500 text-sm">No images</span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Total Cost -->
                            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-6 border border-blue-200">
                                <div class="flex items-center justify-between">
                                    <span class="text-lg font-semibold text-gray-900">Total Cost:</span>
                                    <span class="text-3xl font-bold text-blue-600">${{ number_format($contract->works->sum('cost'), 2) }}</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection