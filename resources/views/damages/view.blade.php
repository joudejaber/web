@extends('layout.app')

@section('content')
<div class="max-w-4xl mx-auto py-10">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-bold mb-4">Damage Details</h2>
        <p><strong>Name:</strong> {{ $damage->name }}</p>
        <p><strong>Description:</strong> {{ $damage->description }}</p>

       @if($damage->image_path)
    @foreach(json_decode($damage->image_path, true) as $path)
        <div class="flex justify-center mt-4">
            <img src="{{ asset('storage/' . $path) }}" alt="Damage image" class="max-w-sm w-full h-auto rounded-md shadow">
        </div>
    @endforeach
@endif


        <a href="{{ url()->previous() }}" class="mt-6 inline-block text-blue-600 hover:underline">Back</a>
    </div>
</div>
@endsection
