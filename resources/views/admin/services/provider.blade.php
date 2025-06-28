@extends('layout.app')

@section('title', 'Provider Details')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Provider Details</h1>

    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-semibold mb-4">{{ $provider->user->name }} (ID: {{ $provider->id }})</h2>

        <p><strong>Email:</strong> {{ $provider->user->email }}</p>
        <p><strong>Shop Name:</strong> {{ $provider->shop_name ?? 'N/A' }}</p>
        <p><strong>Location:</strong> {{ $provider->location ?? 'N/A' }}</p>
        <p><strong>Description:</strong> {{ $provider->description ?? 'N/A' }}</p>
        <p><strong>Contact Info:</strong> {{ $provider->contact_info ?? 'N/A' }}</p>

        <h3 class="mt-6 font-semibold text-lg">Service Offered</h3>
        @if($provider->user->services->isEmpty())
            <p>No services available.</p>
        @else
            <ul class="list-disc list-inside">
                @foreach($provider->user->services as $service)
                    <li>{{ $service->name }} ({{ $service->type }})</li>
                @endforeach
            </ul>
        @endif

        <div class="mt-6">
            <a href="{{ route('providers.index') }}" class="inline-block px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Back to Services</a>
        </div>
    </div>
</div>
@endsection
