@extends('layout.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header Section -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent mb-4">
                Schedule Your Appointment
            </h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Book your renovation service appointment and track your scheduled sessions
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Appointment Form -->
            <div class="bg-white rounded-3xl shadow-xl p-8">
                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">Book New Appointment</h2>
                    <p class="text-gray-600">Fill in the details to schedule your service</p>
                </div>

                <form action="{{ route('appointments.store') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <!-- Damage Selection -->
                    <div class="space-y-2">
                        <label for="damage_id" class="block text-sm font-semibold text-gray-700">
                            <div class="flex items-center mb-2">
                                <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                </svg>
                                Select Damage Type
                            </div>
                        </label>
                        <select name="damage_id" id="damage_id" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors bg-gray-50 hover:bg-white">
                            <option value="">Choose damage type...</option>
                            @foreach($damages as $damage)
                                <option value="{{ $damage->id }}">{{ $damage->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Service Selection -->
                    <div class="space-y-2">
                        <label for="service_id" class="block text-sm font-semibold text-gray-700">
                            <div class="flex items-center mb-2">
                                <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                                Select Service
                            </div>
                        </label>
                        <select name="service_id" id="service_id" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors bg-gray-50 hover:bg-white">
                            <option value="">Choose service type...</option>
                            @foreach($services as $service)
                                <option value="{{ $service->id }}">{{ $service->type }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Date and Time -->
                    <div class="space-y-2">
                        <label for="time" class="block text-sm font-semibold text-gray-700">
                            <div class="flex items-center mb-2">
                                <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Preferred Date & Time
                            </div>
                        </label>
                        @php
                            $minDateTime = \Carbon\Carbon::now()->format('Y-m-d\TH:i');
                        @endphp
                        <input type="datetime-local" name="time" id="time" min="{{ $minDateTime }}" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors bg-gray-50 hover:bg-white">
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" 
                            class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-4 px-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-[1.02]">
                        <div class="flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Schedule Appointment
                        </div>
                    </button>
                </form>

                <!-- Error Alert -->
                @if(session('error'))
                    <div class="mt-6 p-4 bg-red-50 border border-red-200 rounded-xl">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-red-700 font-medium">{{ session('error') }}</span>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Booking Benefits -->
            <div class="space-y-6">
                <!-- Why Choose Us Card -->
                <div class="bg-gradient-to-br from-blue-600 to-blue-700 rounded-3xl p-8 text-white">
                    <h3 class="text-2xl font-bold mb-6">Why Choose Our Services?</h3>
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <svg class="w-6 h-6 text-green-300 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            <div>
                                <h4 class="font-semibold">Professional Assessment</h4>
                                <p class="text-blue-100 text-sm">Expert evaluation of your renovation needs</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <svg class="w-6 h-6 text-green-300 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            <div>
                                <h4 class="font-semibold">Quality Guarantee</h4>
                                <p class="text-blue-100 text-sm">100% satisfaction with our workmanship</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <svg class="w-6 h-6 text-green-300 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            <div>
                                <h4 class="font-semibold">Flexible Scheduling</h4>
                                <p class="text-blue-100 text-sm">Book appointments that fit your schedule</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <svg class="w-6 h-6 text-green-300 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            <div>
                                <h4 class="font-semibold">Transparent Pricing</h4>
                                <p class="text-blue-100 text-sm">No hidden fees, clear contract terms</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Support -->
                <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
                    <h4 class="font-bold text-gray-900 mb-3">Need Help?</h4>
                    <p class="text-gray-600 text-sm mb-4">Our support team is here to assist you with scheduling and questions.</p>
                    <div class="flex items-center text-blue-600">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <span class="text-sm font-medium">Available 24/7 at +961 1 234 567</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Your Appointments Section -->
        <div class="mt-12">
            <div class="bg-white rounded-3xl shadow-xl overflow-hidden">
                <div class="bg-gradient-to-r from-gray-50 to-blue-50 px-8 py-6 border-b border-gray-100">
                    <h2 class="text-2xl font-bold text-gray-900">Your Appointments</h2>
                    <p class="text-gray-600 mt-1">Track and manage your scheduled services</p>
                </div>

                <div class="p-8">
                    @if($appointments->isEmpty())
                        <div class="text-center py-12">
                            <div class="mx-auto h-20 w-20 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                <svg class="h-10 w-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">No Appointments Yet</h3>
                            <p class="text-gray-500">Schedule your first appointment using the form above</p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full">
                                <thead>
                                    <tr class="border-b border-gray-200">
                                        <th class="px-6 py-4 text-left">
                                            <div class="flex items-center text-sm font-semibold text-gray-700">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                                </svg>
                                                Service
                                            </div>
                                        </th>
                                        <th class="px-6 py-4 text-left">
                                            <div class="flex items-center text-sm font-semibold text-gray-700">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                Date & Time
                                            </div>
                                        </th>
                                        <th class="px-6 py-4 text-left">
                                            <div class="flex items-center text-sm font-semibold text-gray-700">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                Status
                                            </div>
                                        </th>
                                        <th class="px-6 py-4 text-left">
                                            <div class="flex items-center text-sm font-semibold text-gray-700">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                                Contract
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @foreach($appointments as $appointment)
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="px-6 py-4">
                                                <div class="flex items-center">
                                                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                                        </svg>
                                                    </div>
                                                    <span class="font-medium text-gray-900">{{ $appointment->service->type }}</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="text-sm text-gray-900 font-medium">
                                                    {{ \Carbon\Carbon::parse($appointment->time)->format('M j, Y') }}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    {{ \Carbon\Carbon::parse($appointment->time)->format('h:i A') }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
    @php
        $status = $appointment->status ?? 'pending';
        $statusColors = [
            'pending' => 'bg-yellow-100 text-yellow-800',
            'confirmed' => 'bg-green-100 text-green-800',
            'accepted' => 'bg-green-100 text-green-800',
            'completed' => 'bg-blue-100 text-blue-800',
            'cancelled' => 'bg-red-100 text-red-800',
            'declined' => 'bg-red-200 text-red-900' // Added declined with red shade
        ];

        $statusText = [
            'pending' => 'Pending',
            'confirmed' => 'Confirmed',
            'accepted' => 'Accepted',
            'completed' => 'Completed',
            'cancelled' => 'Cancelled',
            'declined' => 'Declined' // Added declined text
        ];
    @endphp
    <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full {{ $statusColors[$status] ?? $statusColors['pending'] }}">
        {{ $statusText[$status] ?? ucfirst($status) }}
    </span>
</td>

                                            <td class="px-6 py-4">
    @if($appointment->contract)
        <a href="{{ route('contract.byAppointment', $appointment->id) }}"
           class="inline-flex items-center px-4 py-2 text-sm font-medium text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
            View Contract
        </a>
    @else
        <span class="inline-flex items-center px-4 py-2 text-sm text-gray-500 bg-gray-100 rounded-lg">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            {{ $appointment->status === 'declined' ? 'No Contract' : 'Pending' }}
        </span>
    @endif
</td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection