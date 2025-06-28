@extends('layout.app')

@section('title', 'Appointments Management')

@section('content')
<div class="max-w-7xl mx-auto p-6">
    <h1 class="text-3xl font-bold mb-8">Appointments Management</h1>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Homeowner</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Provider</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Service</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date & Time</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Damage</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($appointments as $appointment)
                    <tr>
                        <td class="px-6 py-4 text-sm text-gray-700 font-medium">{{ $appointment->id }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $appointment->homeowner->name ?? '—' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $appointment->provider->name ?? '—' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $appointment->service->name ?? '—' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">
                            {{ $appointment->appointment_time ? $appointment->appointment_time->format('M d, Y h:i A') : '—' }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-700">
                            {{ $appointment->damage ? $appointment->damage->description : 'No damage selected' }}
                        </td>
                        <td class="px-6 py-4">
                            @if($appointment->status == 'pending')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    Pending
                                </span>
                            @elseif($appointment->status == 'accepted')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Accepted
                                </span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    Declined
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm">
                            <form method="POST" action="{{ route('appointments.destroy', $appointment->id) }}" onsubmit="return confirm('Are you sure you want to delete this appointment?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-600 text-white px-3 py-1 rounded-md hover:bg-red-700 transition">
                                    <i class="fas fa-trash mr-1"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-6 py-4 text-sm text-gray-500 text-center">
                            No appointments found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
