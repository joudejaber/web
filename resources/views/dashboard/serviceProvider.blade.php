@extends('layout.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header Section -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent mb-4">
                Provider Dashboard
            </h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Manage your services, products, and business profile
            </p>
        </div>

        <div class="grid grid-cols-1 gap-8">
            
           

            <!-- Profile Information Section -->
            <div class="bg-white rounded-3xl shadow-xl">
                <div class="bg-gradient-to-r from-gray-50 to-blue-50 px-8 py-6 border-b border-gray-100 rounded-t-3xl">
                    <h2 class="text-2xl font-bold text-gray-900">👤 Your Profile Info</h2>
                    <p class="text-gray-600 mt-1">
                        @if($provider && $provider->shop_name && $provider->location)
                            Manage your business information
                        @else
                            Complete your business profile to get started
                        @endif
                    </p>
                </div>

                <div class="p-8">
                    

                    @if($provider && $provider->shop_name && $provider->location)
                        <!-- Display existing profile info -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                            <div class="space-y-2">
                                <h3 class="text-sm font-medium text-gray-500">Shop Name</h3>
                                <p class="text-lg font-semibold text-gray-900">{{ $provider->shop_name }}</p>
                            </div>
                            <div class="space-y-2">
                                <h3 class="text-sm font-medium text-gray-500">Location</h3>
                                <p class="text-lg font-semibold text-gray-900">{{ $provider->location }}</p>
                            </div>
                            <div class="space-y-2 md:col-span-2">
                                <h3 class="text-sm font-medium text-gray-500">Description</h3>
                                <p class="text-lg font-semibold text-gray-900">{!! nl2br(e($provider->description)) ?: 'No description provided.' !!}</p>
                            </div>
                            <div class="space-y-2">
                                <h3 class="text-sm font-medium text-gray-500">Contact Info</h3>
                                <p class="text-lg font-semibold text-gray-900">{{ $provider->contact_info ?: 'No contact info provided.' }}</p>
                            </div>
                        </div>

                        <a href="{{ route('provider.profile.edit') }}"
                           class="inline-flex items-center px-6 py-3 text-white font-semibold bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-[1.02]">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Edit Profile Info
                        </a>
                    @else
                        <!-- Profile setup form -->
                        <form action="{{ route('provider.profile.update') }}" method="POST" class="space-y-6">
                            @csrf
                            @method('PUT')

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="shop_name" class="block text-sm font-medium text-gray-700 mb-2">Shop Name *</label>
                                    <input type="text" name="shop_name" id="shop_name" 
                                           value="{{ old('shop_name', $provider->shop_name ?? '') }}" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors" 
                                           required>
                                    @error('shop_name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                                </div>

                                <div>
                                    <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Location *</label>
                                    <input type="text" name="location" id="location" 
                                           value="{{ old('location', $provider->location ?? '') }}" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors" 
                                           required>
                                    @error('location') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                                <textarea name="description" id="description" rows="4" 
                                          class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                                          placeholder="Tell customers about your business...">{{ old('description', $provider->description ?? '') }}</textarea>
                                @error('description') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="contact_info" class="block text-sm font-medium text-gray-700 mb-2">Contact Info</label>
                                <input type="text" name="contact_info" id="contact_info" 
                                       value="{{ old('contact_info', $provider->contact_info ?? '') }}" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                                       placeholder="Phone, email, or other contact details">
                                @error('contact_info') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>

                            <button type="submit" 
                                    class="inline-flex items-center px-6 py-3 text-white font-semibold bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-[1.02]">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Save Profile
                            </button>
                        </form>
                    @endif
                </div>
            </div>

            <!-- Services and Products Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                
                <!-- Your Service Section -->
                <div class="bg-white rounded-3xl shadow-xl">
                    <div class="bg-gradient-to-r from-gray-50 to-blue-50 px-8 py-6 border-b border-gray-100 rounded-t-3xl">
                        <div class="flex justify-between items-center">
                            <div>
                                <h2 class="text-2xl font-bold text-gray-900">🔧 Your Service</h2>
                                <p class="text-gray-600 mt-1">Manage your service offering</p>
                            </div>
                            @if($services->isEmpty())
                                <a href="{{ route('services.create') }}"
                                   class="inline-flex items-center px-4 py-2 text-white font-semibold bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-[1.02]">
                                    Add Service
                                </a>
                            @endif
                        </div>
                    </div>
                    
                    <div class="p-8">
                        @if($services->isEmpty())
                            <div class="text-center py-8">
                                <div class="mx-auto h-20 w-20 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                    <svg class="h-10 w-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">No Service Added</h3>
                                <p class="text-gray-500">Create your service to start receiving requests</p>
                            </div>
                        @else
                            @foreach($services as $service)
                                <div class="p-6 bg-gray-50 rounded-xl border border-gray-200 hover:bg-white transition-colors mb-4">
                                    <div class="flex justify-between items-start">
                                        <div class="flex items-center space-x-4 flex-1">
                                            @if($service->image)
                                                <img src="{{ asset('storage/' . $service->image) }}" 
                                                     alt="{{ $service->name }}" 
                                                     class="w-16 h-16 object-cover rounded-xl">
                                            @else
                                                <div class="w-16 h-16 bg-gray-200 rounded-xl flex items-center justify-center">
                                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                                    </svg>
                                                </div>
                                            @endif
                                            <div>
                                                <h3 class="text-lg font-semibold text-gray-900">{{ $service->name }}</h3>
                                                <p class="text-sm text-gray-600 mt-1">Type: {{ $service->type }}</p>
                                                <p class="text-sm text-gray-600">Available: {{ $service->timeavailable }}</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-3">
                                            <a href="{{ route('services.edit', $service->id) }}" 
                                               class="p-2 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded-lg transition-colors"
                                               title="Edit Service">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                            </a>
                                            <a href="{{ route('services.delete', $service->id) }}" 
                                               onclick="return confirm('Are you sure you want to delete this service?');" 
                                               class="p-2 text-red-600 hover:text-red-800 hover:bg-red-50 rounded-lg transition-colors"
                                               title="Delete Service">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <!-- Your Products Section -->
<div class="bg-white rounded-3xl shadow-xl">
    <div class="bg-gradient-to-r from-gray-50 to-blue-50 px-8 py-6 border-b border-gray-100 rounded-t-3xl">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">📦 Your Products</h2>
                <p class="text-gray-600 mt-1">Manage your product offerings</p>
            </div>
            @if($services->isEmpty())
                <button disabled
                        class="inline-flex items-center px-4 py-2 bg-gray-300 text-gray-500 rounded-xl cursor-not-allowed"
                        title="Add a service first to add products">
                    Add Product
                </button>
            @else
                <a href="{{ route('products.create') }}"
                   class="inline-flex items-center px-4 py-2 text-white font-semibold bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-[1.02]">
                    Add Product
                </a>
            @endif
        </div>
    </div>

    <div class="p-8">
        @if($services->isEmpty())
            <div class="text-center py-8">
                <div class="mx-auto h-20 w-20 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                    <svg class="h-10 w-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Products Unavailable</h3>
                <p class="text-gray-500">Add a service first to manage products</p>
            </div>
        @elseif($products->isEmpty())
            <div class="text-center py-8">
                <div class="mx-auto h-20 w-20 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                    <svg class="h-10 w-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">No Products Added</h3>
                <p class="text-gray-500">Start adding products to your inventory</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <div class="flex space-x-4">
                    @foreach($products as $product)
                        <div class="min-w-[280px] p-4 bg-gray-50 rounded-xl border border-gray-200 hover:bg-white transition-colors">
                            <div class="flex items-center space-x-4">
                                <img src="{{ Storage::url($product->image) }}"
                                     alt="{{ $product->name }}"
                                     class="w-16 h-16 object-cover rounded-xl">
                                <div class="flex-1">
                                    <h3 class="text-lg font-semibold text-gray-900">{{ $product->name }}</h3>
                                    <p class="text-sm text-gray-600">{{ $product->category }}</p>
                                    <p class="text-sm font-medium text-green-600">${{ number_format($product->price, 2) }}</p>
                                </div>
                            </div>
                            <div class="flex items-center justify-end space-x-2 mt-2">
                                <a href="{{ route('products.edit', $product->id) }}"
                                   class="p-2 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded-lg transition-colors"
                                   title="Edit Product">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                                <a href="{{ route('products.delete', $product->id) }}"
                                   onclick="return confirm('Are you sure you want to delete this product?');"
                                   class="p-2 text-red-600 hover:text-red-800 hover:bg-red-50 rounded-lg transition-colors"
                                   title="Delete Product">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>

            </div>
        </div>
    </div>
</div>
@endsection