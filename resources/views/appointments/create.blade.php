@extends('layout.app')

@section('content')
<div class="max-w-screen-xl mx-auto p-4">
    <h1 class="text-2xl font-semibold mb-4">Schedule an Appointment</h1>

    {{-- Appointment Form --}}
    <form action="{{ route('appointments.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="damage_id" class="block text-sm font-medium text-gray-700">Select Damage</label>
            <select name="damage_id" id="damage_id" class="mt-1 block w-64 p-1.5 border border-gray-300 rounded-md">
                @foreach($damages as $damage)
                    <option value="{{ $damage->id }}">{{ $damage->name }} </option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="service_id" class="block text-sm font-medium text-gray-700">Service</label>
            <select name="service_id" id="service_id" class="mt-1 block w-64 p-1.5 border border-gray-300 rounded-md">
                @foreach($services as $service)
                    <option value="{{ $service->id }}">{{ $service->type }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="time" class="block text-sm font-medium text-gray-700">Date and Time</label>
            <input type="datetime-local" name="time" id="time" class="mt-1 block w-64 p-1.5 border border-gray-300 rounded-md text-sm">
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md">Schedule Appointment</button>
    </form>

    {{-- Error Alert --}}
    @if(session('error'))
        <div class="mt-4 p-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
            {{ session('error') }}
        </div>
    @endif

    {{-- User's Appointments --}}
    <div class="mt-10">
        <h2 class="text-xl font-semibold mb-4">Your Appointments</h2>

        @if($appointments->isEmpty())
            <p class="text-gray-500">You have no scheduled appointments.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 bg-white shadow rounded-lg">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Service</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Date & Time</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($appointments as $appointment)
                            <tr>
                                <td class="px-4 py-2 text-sm text-gray-800">{{ $appointment->service->type }}</td>
                                <td class="px-4 py-2 text-sm text-gray-800">{{ \Carbon\Carbon::parse($appointment->time)->format('F j, Y \a\t h:i A') }}</td>
                                <td class="px-4 py-2 text-sm text-gray-800">{{ ucfirst($appointment->status) ?? 'Pending' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection
