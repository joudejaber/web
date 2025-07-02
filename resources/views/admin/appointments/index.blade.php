@extends('layout.app')

@section('title', 'Appointments Management')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header Section -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent mb-2">
                Appointments Management
            </h1>
            <p class="text-lg text-gray-600">
                Overview of all scheduled appointments
            </p>
        </div>

        <!-- Content Card -->
        <div class="bg-white rounded-3xl shadow-xl">
            <div class="bg-gradient-to-r from-gray-50 to-blue-50 px-8 py-6 border-b border-gray-100 rounded-t-3xl">
                <h2 class="text-2xl font-bold text-gray-900">📅 All Appointments</h2>
                <p class="text-gray-600 mt-1">List of scheduled appointments between homeowners and service providers</p>
            </div>

            <div class="p-6">
                <table class="w-full table-fixed">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="w-12 px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="w-32 px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Homeowner</th>
                            <th class="w-32 px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Provider</th>
                            <th class="w-32 px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Service</th>
                            <th class="w-40 px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date & Time</th>
                            <th class="w-48 px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Damage</th>
                            <th class="w-24 px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="w-20 px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($appointments as $appointment)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-2 py-4 text-sm font-medium text-gray-900 truncate">{{ $appointment->id }}</td>
                            <td class="px-2 py-4 text-sm text-gray-900 truncate">{{ $appointment->homeowner->name ?? '—' }}</td>
                            <td class="px-2 py-4 text-sm text-gray-900 truncate">{{ $appointment->provider->name ?? '—' }}</td>
                            <td class="px-2 py-4 text-sm text-gray-500 truncate">{{ $appointment->service->name ?? '—' }}</td>
                            <td class="px-2 py-4 text-sm text-gray-500 truncate">
                                {{ $appointment->appointment_time ? $appointment->appointment_time->format('M d, Y h:i A') : '—' }}
                            </td>
                            <td class="px-2 py-4 text-sm text-gray-500 truncate" title="{{ $appointment->damage ? $appointment->damage->description : 'No damage selected' }}">
                                {{ Str::limit($appointment->damage ? $appointment->damage->description : 'No damage selected', 40) }}
                            </td>
                            <td class="px-2 py-4">
                                @if($appointment->status == 'pending')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                @elseif($appointment->status == 'accepted')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Accepted</span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Declined</span>
                                @endif
                            </td>
                            <td class="px-2 py-4 text-sm font-medium">
                                <form method="POST" action="{{ route('appointments.destroy', $appointment->id) }}" onsubmit="return confirm('Are you sure you want to delete this appointment?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="px-6 py-4 text-center text-sm text-gray-500">
                                <div class="flex flex-col items-center justify-center py-8">
                                    <svg class="h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <p class="mt-2 text-sm font-medium text-gray-900">No appointments found</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

           
        </div>
    </div>
</div>
@endsection