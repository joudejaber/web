@extends('layout.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100">
    <!-- Back Navigation -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pt-8">
        <a href="{{ route('services.index') }}" 
           class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium transition-colors group">
            <svg class="w-5 h-5 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Services
        </a>
    </div>

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden">
            <!-- Header Section -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-8 py-10 text-center">
                <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2a4 4 0 018 0v2m-4-6a4 4 0 110-8 4 4 0 010 8z" />
                    </svg>
                </div>
                <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">Edit Service</h1>
                <p class="text-blue-100 text-lg">Modify your service details below</p>
            </div>

            <!-- Form Section -->
            <div class="p-8">
                <form action="{{ route('services.update', $service->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    @method('POST')

                    <div class="space-y-6">
                        <!-- Service Name -->
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700" for="name">Service Name</label>
                            <input type="text" name="name" id="name"
                                   value="{{ old('name', $service->name) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                   required>
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Service Type -->
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700" for="type">Service Type</label>
                            <input type="text" name="type" id="type"
                                   value="{{ old('type', $service->type) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                   required>
                            @error('type')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Service Image -->
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700" for="image">Service Image</label>
                            <input type="file" name="image" id="image"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                            @if($service->image)
                                <div class="mt-4">
                                    <img src="{{ asset('storage/' . $service->image) }}" 
                                         alt="{{ $service->name }}" 
                                         class="h-40 w-auto object-cover rounded-xl shadow">
                                </div>
                            @endif
                            @error('image')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                        <button type="submit"
                                class="flex-1 sm:flex-none px-8 py-4 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-blue-800 focus:ring-4 focus:ring-blue-300 transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl">
                            <div class="flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Update Service
                            </div>
                        </button>

                        <a href="{{ route('services.index') }}"
                           class="flex-1 sm:flex-none px-8 py-4 bg-gray-100 text-gray-700 font-semibold rounded-xl hover:bg-gray-200 focus:ring-4 focus:ring-gray-300 transition-all duration-200 text-center">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
