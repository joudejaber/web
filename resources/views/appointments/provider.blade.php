@extends('layout.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header Section -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent mb-4">
                Manage Appointments
            </h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Review, accept, or reject your upcoming service appointments
            </p>
        </div>

        @php
            $acceptedAppointments = $appointments
                ->where('status', 'accepted')
                ->sortBy(function($appointment) {
                    return $appointment->appointment_time ? strtotime($appointment->appointment_time) : PHP_INT_MAX;
                });

            $pendingAppointments = $appointments
                ->where('status', 'pending')
                ->sortBy(function($appointment) {
                    return $appointment->appointment_time ? strtotime($appointment->appointment_time) : PHP_INT_MAX;
                });
        @endphp

        {{-- Pending Appointments --}}
        <div class="mb-12">
            <div class="bg-white rounded-3xl shadow-xl overflow-hidden">
                <div class="bg-gradient-to-r from-gray-50 to-blue-50 px-8 py-6 border-b border-gray-100">
                    <h2 class="text-2xl font-bold text-gray-900">Pending Appointments</h2>
                    <p class="text-gray-600 mt-1">Appointments awaiting your response</p>
                </div>

                {{-- Inside Pending Appointments --}}
<div class="p-8">
    @if($pendingAppointments->isEmpty())
        <div class="text-center py-12">
            <div class="mx-auto h-20 w-20 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                <svg class="h-10 w-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">No Pending Appointments</h3>
            <p class="text-gray-500">You currently have no appointments awaiting approval</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($pendingAppointments as $appointment)
                <div class="bg-white rounded-2xl shadow-lg border border-gray-200 hover:shadow-xl transition-shadow">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900">
                                {{ $appointment->service->name ?? 'Service not found' }}
                            </h3>
                        </div>

                        <div class="space-y-3 text-sm text-gray-700 mb-4">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-gray-400 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <span>{{ $appointment->homeowner->name ?? 'Unknown' }}</span>
                            </div>
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-gray-400 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span>{{ $appointment->appointment_time ? Carbon\Carbon::parse($appointment->appointment_time)->format('M d, Y h:i A') : 'Not set' }}</span>
                            </div>
                            @if($appointment->notes)
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-gray-400 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <span>{{ $appointment->notes }}</span>
                            </div>
                            @endif

                            <a href="{{ route('appointments.damage-report', $appointment->id) }}"
                               class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-indigo-600 bg-indigo-50 hover:bg-indigo-100 rounded-xl transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                                Damage Details
                            </a>
                        </div>

                        <div class="mt-6 flex flex-col sm:flex-row gap-3">
                            <form action="{{ route('appointment.accept', $appointment->id) }}" method="POST" class="flex-1">
                                @csrf
                                @method('POST')
                                <button type="submit" class="w-full bg-green-50 hover:bg-green-100 text-green-700 font-medium py-2 px-4 rounded-xl border border-green-200 hover:border-green-300 transition-all duration-200">
                                    Accept
                                </button>
                            </form>

                            <form action="{{ route('appointment.decline', $appointment->id) }}" method="POST" class="flex-1">
                                @csrf
                                @method('POST')
                                <button type="submit" class="w-full bg-red-50 hover:bg-red-100 text-red-700 font-medium py-2 px-4 rounded-xl border border-red-200 hover:border-red-300 transition-all duration-200">
                                    Reject
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>


            </div>
        </div>

        {{-- Accepted Appointments --}}
        <div>
            <div class="bg-white rounded-3xl shadow-xl overflow-hidden">
                <div class="bg-gradient-to-r from-gray-50 to-blue-50 px-8 py-6 border-b border-gray-100">
                    <h2 class="text-2xl font-bold text-gray-900">Accepted Appointments</h2>
                    <p class="text-gray-600 mt-1">Your confirmed service appointments</p>
                </div>

                <div class="p-8">
                    @if($acceptedAppointments->isEmpty())
                        <div class="text-center py-12">
                            <div class="mx-auto h-20 w-20 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                <svg class="h-10 w-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">No Accepted Appointments</h3>
                            <p class="text-gray-500">You currently have no confirmed appointments</p>
                        </div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($acceptedAppointments as $appointment)
                                <div class="bg-white rounded-2xl shadow-lg border border-gray-200 hover:shadow-xl transition-shadow">
                                    <div class="p-6">
                                        <div class="flex items-center mb-4">
                                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                                </svg>
                                            </div>
                                            <h3 class="text-lg font-semibold text-gray-900">
                                                {{ $appointment->service->name ?? 'Service not found' }}
                                            </h3>
                                        </div>

                                        <div class="space-y-3 text-sm text-gray-700">
                                            <div class="flex items-start">
                                                <svg class="w-5 h-5 text-gray-400 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>
                                                <span>{{ $appointment->homeowner->name ?? 'Unknown' }}</span>
                                            </div>
                                            <div class="flex items-start">
                                                <svg class="w-5 h-5 text-gray-400 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                <span>{{ $appointment->appointment_time ? Carbon\Carbon::parse($appointment->appointment_time)->format('M d, Y h:i A') : 'Not set' }}</span>
                                            </div>
                                            @if($appointment->notes)
                                            <div class="flex items-start">
                                                <svg class="w-5 h-5 text-gray-400 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                                <span>{{ $appointment->notes }}</span>
                                            </div>
                                            @endif
                                        </div>

                                        <div class="mt-6 space-y-3">
                                            <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                                Accepted
                                            </span>

                                            <div class="flex flex-col sm:flex-row gap-3">
                                                @if($appointment->contract)
                                                    <a href="{{ route('contract.byAppointment', $appointment->id) }}" 
                                                       class="flex-1 inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-xl transition-colors">
                                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                        </svg>
                                                        View Contract
                                                    </a>
                                                @else
                                                    <span class="inline-flex items-center px-4 py-2 text-sm text-gray-500 bg-gray-100 rounded-xl">
                                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        No Contract
                                                    </span>
                                                @endif

                                                <a href="{{ route('appointments.damage-report', $appointment->id) }}"
                                                   class="flex-1 inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-indigo-600 bg-indigo-50 hover:bg-indigo-100 rounded-xl transition-colors">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                                    </svg>
                                                    Damage Details
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection