@extends('layout.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Compact Header Section -->
<div class="text-center mb-6">
    <h1 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent mb-2">
        Damage Report Dashboard
    </h1>
    <p class="text-base text-gray-600 max-w-2xl mx-auto">
        Track and manage your reported damages and repairs
    </p>
</div>

        {{-- AI Severity Estimate Notification --}}
        @if(session('damage_description'))
            <div id="severity-result" class="mb-8 bg-white p-6 rounded-3xl shadow-xl border-l-4 border-yellow-500">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-yellow-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="font-medium text-yellow-800">Estimating damage severity...</span>
                </div>
            </div>

            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    const description = @json(session('damage_description'));

                    fetch("/estimate-severity", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ description })
                    })
                    .then(response => response.json())
                    .then(data => {
                        const severityBox = document.getElementById("severity-result");
                        if (data.severity) {
                            severityBox.innerHTML = `
                                <div class="flex items-center">
                                    <svg class="w-6 h-6 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="font-medium text-green-800">AI Estimate: ${data.severity.charAt(0).toUpperCase() + data.severity.slice(1)} damage</span>
                                </div>
                            `;
                            severityBox.classList.remove("border-yellow-500");
                            severityBox.classList.add("border-green-500");
                        }
                    })
                    .catch(error => {
                        console.error("Error fetching severity:", error);
                        const severityBox = document.getElementById("severity-result");
                        severityBox.innerHTML = `
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-red-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                <span class="font-medium text-red-800">Could not estimate severity.</span>
                            </div>
                        `;
                        severityBox.classList.remove("border-yellow-500");
                        severityBox.classList.add("border-red-500");
                    });
                });
            </script>
        @endif

        <div class="grid grid-cols-1 gap-8">
            {{-- Notifications --}}
            @if($notifications->count())
                <div class="bg-white rounded-3xl shadow-xl p-8">
                    <div class="mb-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-2">📢 Notifications</h2>
                        <p class="text-gray-600">Your recent updates and messages</p>
                    </div>
                    
                    <ul class="divide-y divide-gray-100">
                        @foreach($notifications as $notification)
                            <li class="py-6 hover:bg-gray-50 px-4 rounded-lg transition-colors">
                                <div class="flex justify-between items-center">
                                    <div class="flex-1">
                                        <p class="text-base font-medium text-gray-900">
                                            {{ $notification->data['message'] ?? 'Notification' }}
                                        </p>
                                        @if (isset($notification->data['contract_id']))
                                            <a href="{{ route('notification.contract.view', $notification->data['contract_id']) }}" 
                                               class="text-blue-600 hover:text-blue-800 mt-2 inline-flex items-center text-sm font-semibold">
                                               View Contract
                                               <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                               </svg>
                                            </a>
                                        @endif
                                    </div>
                                    <form method="POST" action="{{ route('notifications.markAsRead', $notification->id) }}" class="ml-6">
                                        @csrf
                                        @method('PATCH')
                                        <button class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 rounded-xl shadow-lg transition-all">
                                            Mark as read
                                        </button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Personal Information --}}
            <div class="bg-white rounded-3xl shadow-xl">
                <div class="bg-gradient-to-r from-gray-50 to-blue-50 px-8 py-6 border-b border-gray-100 rounded-t-3xl">
                    <h2 class="text-2xl font-bold text-gray-900">👤 Personal Information</h2>
                    <p class="text-gray-600 mt-1">
                        @if ($personalInfo)
                            Below are the personal details you submitted
                        @else
                            Start by filling your personal details for the damage report
                        @endif
                    </p>
                </div>

                <div class="p-8">
                    @if ($personalInfo)
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                            <div class="space-y-2">
                                <h3 class="text-sm font-medium text-gray-500">Full Name</h3>
                                <p class="text-lg font-semibold text-gray-900">{{ $personalInfo->full_name }}</p>
                            </div>
                            <div class="space-y-2">
                                <h3 class="text-sm font-medium text-gray-500">Phone Number</h3>
                                <p class="text-lg font-semibold text-gray-900">{{ $personalInfo->phone_number }}</p>
                            </div>
                            <div class="space-y-2">
                                <h3 class="text-sm font-medium text-gray-500">Email</h3>
                                <p class="text-lg font-semibold text-gray-900">{{ $personalInfo->email }}</p>
                            </div>
                            <div class="space-y-2">
                                <h3 class="text-sm font-medium text-gray-500">City</h3>
                                <p class="text-lg font-semibold text-gray-900">{{ $personalInfo->city }}</p>
                            </div>
                            <div class="space-y-2">
                                <h3 class="text-sm font-medium text-gray-500">Street</h3>
                                <p class="text-lg font-semibold text-gray-900">{{ $personalInfo->street }}</p>
                            </div>
                            <div class="space-y-2">
                                <h3 class="text-sm font-medium text-gray-500">Building Name</h3>
                                <p class="text-lg font-semibold text-gray-900">{{ $personalInfo->building_name }}</p>
                            </div>
                        </div>

                        <a href="{{ route('personal.report.edit', $personalInfo->id) }}"
                            class="inline-flex items-center px-6 py-3 text-white font-semibold bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-[1.02]">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Edit Personal Information
                        </a>
                    @else
                        <div class="text-center py-8">
                            <a href="{{ route('personal.report.create') }}"
                               class="inline-flex items-center px-8 py-4 text-white font-semibold bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-[1.02]">
                                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Fill Personal Information
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Claimed and Approved Damages --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Claimed Damages Section -->
                <div class="bg-white rounded-3xl shadow-xl">
                    <div class="bg-gradient-to-r from-gray-50 to-blue-50 px-8 py-6 border-b border-gray-100 rounded-t-3xl">
                        <div class="flex justify-between items-center">
                            <div>
                                <h2 class="text-2xl font-bold text-gray-900">📋 Claimed Damages</h2>
                                <p class="text-gray-600 mt-1">Damages you've reported</p>
                            </div>
                            @if($report)
                                <a href="{{ route('damage.report.addDamages', $report->id) }}"
                                class="inline-flex items-center px-4 py-2 text-white font-semibold bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-[1.02]">
                                    Add Damage
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="p-8">
                        @if($damages->isEmpty())
                            <div class="text-center py-8">
                                <div class="mx-auto h-20 w-20 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                    <svg class="h-10 w-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">No Damages Yet</h3>
                                <p class="text-gray-500">Click "Add Damage" to report one</p>
                            </div>
                        @else
                            <ul class="space-y-4">
                                @foreach($damages as $damage)
                                    @if($damage->status === 'pending')
                                        <li class="p-6 bg-gray-50 rounded-xl border border-gray-200 hover:bg-white transition-colors">
                                            <div class="flex justify-between items-center">
                                                <div>
                                                    <h3 class="text-lg font-semibold text-gray-900">{{ $damage->type }}</h3>
                                                    <p class="text-sm text-gray-600 mt-1">{{ $damage->description }}</p>
                                                </div>
                                                <div class="flex items-center space-x-3">
                                                    <a href="{{ route('damage.view', $damage->id) }}"
                                                       class="inline-flex items-center px-4 py-2 text-white font-semibold bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-[1.02]">
                                                        View
                                                    </a>
                                                    <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                        Pending
                                                    </span>
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>

                <!-- Approved Damages Section -->
                <div class="bg-white rounded-3xl shadow-xl">
                    <div class="bg-gradient-to-r from-gray-50 to-blue-50 px-8 py-6 border-b border-gray-100 rounded-t-3xl">
                        <h2 class="text-2xl font-bold text-gray-900">✅ Approved Damages</h2>
                        <p class="text-gray-600 mt-1">Damages approved for repair</p>
                    </div>

                    <div class="p-8">
                        @php
                            $hasApproved = false;
                        @endphp

                        @if($damages->isEmpty())
                            <div class="text-center py-8">
                                <div class="mx-auto h-20 w-20 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                    <svg class="h-10 w-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">No Damages Yet</h3>
                                <p class="text-gray-500">Click "Add Damage" to report one</p>
                            </div>
                        @else
                            <ul class="space-y-4">
                                @foreach($damages as $damage)
                                    @if($damage->status === 'accepted')
                                        @php $hasApproved = true; @endphp
                                        <li class="p-6 bg-green-50 rounded-xl border border-green-200 hover:bg-white transition-colors">
                                            <div class="flex justify-between items-start gap-4">
                                                <div class="flex-1">
                                                    <h3 class="text-lg font-semibold text-gray-900">{{ $damage->type }}</h3>
                                                    <p class="text-sm text-gray-600 mt-1">{{ $damage->description }}</p>
                                                </div>
                                                <div class="flex items-center gap-3 whitespace-nowrap">
                                                    <a href="{{ route('damage.view', $damage->id) }}"
                                                       class="inline-flex items-center px-4 py-2 text-white font-semibold bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-[1.02]">
                                                        View
                                                    </a>
                                                    <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                                        Accepted
                                                    </span>
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        @endif

                        @unless($hasApproved)
                            <div class="text-center py-8">
                                <div class="mx-auto h-20 w-20 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                    <svg class="h-10 w-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">No Approved Damages</h3>
                                <p class="text-gray-500">Your pending damages will appear here once approved</p>
                            </div>
                        @endunless
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection