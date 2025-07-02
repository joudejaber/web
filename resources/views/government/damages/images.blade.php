@extends('layout.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header Section -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent mb-2">
                Damage Images
            </h1>
            <p class="text-lg text-gray-600">Images for damage report #{{ $damage->id }}</p>
        </div>

        <!-- Images Grid -->
        @if(count($images) > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                @foreach($images as $path)
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                        <img src="{{ asset('storage/' . $path) }}" 
                             alt="Damage Image" 
                             class="w-full h-64 object-cover hover:scale-105 transition-transform duration-300">
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-3xl shadow-xl p-8 text-center">
                <div class="mx-auto h-20 w-20 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                    <svg class="h-10 w-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">No Images Available</h3>
                <p class="text-gray-500">This damage report doesn't have any images attached.</p>
            </div>
        @endif

        <!-- Back Button -->
        <a href="{{ route('government.dashboard') }}" 
           class="inline-flex items-center px-6 py-3 bg-white text-gray-700 font-medium rounded-xl shadow hover:bg-gray-50 transition-colors border border-gray-200">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Dashboard
        </a>
    </div>
</div>
@endsection