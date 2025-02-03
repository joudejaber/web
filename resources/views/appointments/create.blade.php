@extends('layout.app')

@section('content')
<div class="max-w-screen-xl mx-auto p-4">
    <h1 class="text-2xl font-semibold mb-4">Schedule an Appointment</h1>
    <form action="{{ route('appointments.store') }}" method="POST">
        @csrf
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

    @if(session('error'))
        <div class="mt-4 p-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
            {{ session('error') }}
        </div>
    @endif
</div>
@endsection