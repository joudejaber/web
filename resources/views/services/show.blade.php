@extends('layout.app')

@section('content')
<div class="max-w-screen-md mx-auto p-6 bg-white rounded shadow">
    <h1 class="text-3xl font-bold mb-4">{{ $service->user->name }}</h1>
    <h2 class="text-xl text-gray-700 mb-2">{{ $service->user->provider->shop_name ?? 'Shop Name Not Provided' }}</h2>

    <div class="mb-4">
        <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->name }}" class="w-full h-64 object-cover rounded">
    </div>

    <p class="mb-4"><strong>Service Name:</strong> {{ $service->name }}</p>
    <p class="mb-4"><strong>Service Type:</strong> {{ $service->type }}</p>
    
    <p class="mb-4"><strong>Location:</strong> {{ $service->user->provider->location ?? 'Location not provided' }}</p>

    <p class="mb-6"><strong>About the Provider:</strong><br>
        {{ $service->user->provider->description ?? 'No description available.' }}
    </p>

    <a href="{{ route('appointments.create', ['service_id' => $service->id]) }}"
       class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded">
       Book Appointment
    </a>
</div>
@endsection
