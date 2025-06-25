@extends('layout.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Damage Details for Appointment #{{ $appointment->id }}</h1>

    <div class="bg-white p-6 rounded-lg shadow-lg">
        {{-- Check if there are any damages related to the appointment --}}
        @if($damages->count() > 0)
            <div class="space-y-4">
                @foreach($damages as $damage)
                    <div class="border-b pb-4">
                        <h3 class="text-xl font-semibold">{{ $damage->name }}</h3>
                        <p><strong>Description:</strong> {{ $damage->description }}</p>

                        @if($damage->image_path)
                            <div class="mt-2">
                                <strong>Image:</strong>
                                <img src="{{ asset('storage/' . $damage->image_path) }}" alt="{{ $damage->name }}" class="w-full max-w-sm rounded-md mt-2">
                            </div>
                        @else
                            <p class="text-gray-600">No image available for this damage.</p>
                        @endif

                        <p class="mt-2 text-sm text-gray-500"><strong>Created At:</strong> {{ $damage->created_at->format('M d, Y h:i A') }}</p>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-600">No damage details available for this appointment.</p>
        @endif
    </div>

    <div class="mt-6">
        <a href="{{ route('provider.appointments') }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-2 rounded-lg shadow-md transition">
            Back to Appointments
        </a>
    </div>
</div>
@endsection
