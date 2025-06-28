@extends('layout.app')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-2xl font-bold mb-6">Damage Images for #{{ $damage->id }}</h1>

    @if(count($images) > 0)
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($images as $path)
                <div class="border rounded shadow p-3">
                    <img src="{{ asset('storage/' . $path) }}" alt="Damage Image" class="w-full h-auto rounded">
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-600">No images available for this damage.</p>
    @endif

    <a href="{{ route('government.dashboard') }}" class="mt-8 inline-block text-blue-600 hover:underline">Back to Dashboard</a>
</div>
@endsection

