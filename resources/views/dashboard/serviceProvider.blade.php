@extends('layout.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
        
        <div class="md:col-span-3">
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-semibold mb-4">Quick Actions</h2>
                <div class="space-y-3">
                    @if($services->isEmpty())
                        <a href="{{route("services.create")}}" class="block w-full text-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-150">
                            Add Service
                        </a>
                        <button disabled class="block w-full text-center px-4 py-2 border border-gray-300 text-gray-400 rounded-lg cursor-not-allowed">
                            Add Product
                            <span class="block text-xs mt-1">(Add a service first)</span>
                        </button>
                    @else
                        <button disabled class="block w-full text-center px-4 py-2 bg-gray-300 text-gray-500 rounded-lg cursor-not-allowed">
                            Add Service
                            <span class="block text-xs mt-1">(Service already added)</span>
                        </button>
                        <a href="{{route("products.create")}}" class="block w-full text-center px-4 py-2 border border-blue-600 text-blue-600 rounded-lg hover:bg-blue-50 transition duration-150">
                            Add Product
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <div class="md:col-span-9 space-y-6">
            
            <div class="bg-white rounded-lg shadow">
                <div class="border-b border-gray-200">
                    <div class="p-6">
                        <h2 class="text-xl font-semibold">Your Service</h2>
                        <p class="text-gray-500 mt-1">Manage your service offering</p>
                    </div>
                </div>
                
                <div class="p-6">
                    @if($services->isEmpty())
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No service added</h3>
                            <p class="mt-1 text-sm text-gray-500">Get started by adding your service.</p>
                            <div class="mt-6">
                                <a href="{{ route('services.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                    Add Service
                                </a>
                            </div>
                        </div>
                    @else
                        @foreach($services as $service)
                            <div class="bg-gray-50 rounded-lg p-6 mb-4">
                                <div class="flex justify-between items-start">
                                    <div class="flex items-center space-x-4">
                                        @if($service->image)
                                            <img src="{{ asset('storage/' . $service->image) }}" 
                                                 alt="{{ $service->name }}" 
                                                 class="w-20 h-20 object-cover rounded-lg">
                                        @endif
                                        <div>
                                            <h3 class="text-lg font-medium text-gray-900">{{ $service->name }}</h3>
                                            <p class="mt-1 text-sm text-gray-500">Type: {{ $service->type }}</p>
                                            <p class="mt-1 text-sm text-gray-500">Available: {{ $service->timeavailable }}</p>
                                        </div>
                                    </div>
                                    <div class="flex space-x-2">
                                        <a href="{{ route('services.edit', $service->id) }}" class="text-blue-600 hover:text-blue-900">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <a href="{{ route('services.delete', $service->id) }}" 
                                           onclick="return confirm('Are you sure you want to delete this service?');" 
                                           class="text-red-600 hover:text-red-900">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="bg-white rounded-lg shadow">
                <div class="border-b border-gray-200">
                    <div class="p-6">
                        <h2 class="text-xl font-semibold">Your Products</h2>
                        <p class="text-gray-500 mt-1">Manage your product offerings</p>
                    </div>
                </div>
                
                <div class="p-6">
                    @if($services->isEmpty())
                        <div class="text-center py-12">
                            <div class="text-gray-500">
                                <svg class="mx-auto h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                                <h3 class="mt-2 text-sm font-medium">Products Unavailable</h3>
                                <p class="mt-1 text-sm">Please add a service before managing products.</p>
                            </div>
                        </div>
                    @elseif($products->isEmpty())
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No products added</h3>
                            <p class="mt-1 text-sm text-gray-500">Add products to your service offering.</p>
                            <div class="mt-6">
                                <a href="{{ route('products.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                    Add Product
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            @foreach($products as $product)
                            <div class="bg-gray-50 rounded-lg overflow-hidden">
                                <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                                <div class="p-4">
                                    <h3 class="text-lg font-medium text-gray-900">{{ $product->name }}</h3>
                                    <p class="mt-1 text-sm text-gray-500">Category: {{ $product->category }}</p>
                                    <p class="mt-1 text-sm text-gray-500">Price: ${{ number_format($product->price, 2) }}</p>
                                    <div class="mt-4 flex justify-between items-center space-x-2">
                                        <a href="{{ route('products.edit', $product->id) }}" class="text-blue-600 hover:text-blue-900">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <a href="{{ route('products.delete', $product->id) }}" 
                                           onclick="return confirm('Are you sure you want to delete this product?');" 
                                           class="text-red-600 hover:text-red-900">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection