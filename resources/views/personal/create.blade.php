@extends('layout.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100">
    <!-- Back Navigation -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pt-8">
        <a href="{{ route('dashboard') }}" 
           class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium transition-colors group">
            <svg class="w-5 h-5 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Dashboard
        </a>
    </div>

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden">
            <!-- Header Section -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-8 py-10">
                <div class="text-center">
                    <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </div>
                    <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">Create Personal Information</h1>
                    <p class="text-blue-100 text-lg">Add your profile details and contact information</p>
                </div>
            </div>

            <!-- Form Section -->
            <div class="p-8">
                <form action="{{ route('personal.report.store') }}" method="POST" class="space-y-8">
                    @csrf

                    <!-- Personal Details Section -->
                    <div class="space-y-6">
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">Personal Details</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">Full Name</label>
                                <input type="text" 
                                       name="full_name" 
                                       value="{{ old('full_name') }}" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors bg-gray-50 focus:bg-white" 
                                       required>
                                @error('full_name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">Phone Number</label>
                                <input type="text" 
                                       name="phone_number" 
                                       value="{{ old('phone_number') }}" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors bg-gray-50 focus:bg-white" 
                                       required>
                                @error('phone_number')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="space-y-2 md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700">Email Address</label>
                                <input type="email" 
                                       name="email" 
                                       value="{{ old('email') }}" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors bg-gray-50 focus:bg-white" 
                                       required>
                                @error('email')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Address Section -->
                    <div class="space-y-6">
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-green-600 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">Address Information</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">City</label>
                                <input type="text" 
                                       name="city" 
                                       value="{{ old('city') }}" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors bg-gray-50 focus:bg-white" 
                                       required>
                                @error('city')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">Street</label>
                                <input type="text" 
                                       name="street" 
                                       value="{{ old('street') }}" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors bg-gray-50 focus:bg-white" 
                                       required>
                                @error('street')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">Building Name</label>
                                <input type="text" 
                                       name="building_name" 
                                       value="{{ old('building_name') }}" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors bg-gray-50 focus:bg-white" 
                                       required>
                                @error('building_name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">Floor Number 
                                    <span class="text-gray-400 font-normal">(optional)</span>
                                </label>
                                <input type="text" 
                                       name="floor_number" 
                                       value="{{ old('floor_number') }}" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors bg-gray-50 focus:bg-white">
                                @error('floor_number')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                        <button type="submit" 
                                class="flex-1 sm:flex-none px-8 py-4 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-blue-800 focus:ring-4 focus:ring-blue-300 transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl">
                            <div class="flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Create Profile
                            </div>
                        </button>
                        
                        <a href="{{ route('dashboard') }}" 
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