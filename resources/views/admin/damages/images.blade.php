@extends('admin.main')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Damage Images for #{{ $damage->id }}</h1>

    @if(count($images) > 0)
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach($images as $path)
                <div class="border rounded shadow p-2">
                    <img src="{{ asset('storage/' . $path) }}" alt="Damage Image" class="w-full h-auto rounded">
                </div>
            @endforeach
        </div>
    @else
        <p>No images available for this damage.</p>
    @endif

    <a href="{{ route('damages.index') }}" class="mt-4 inline-block text-blue-600 hover:underline">Back to Damages</a>
@endsection
