@extends('layout.app')

@section('title', 'Admin Dashboard - Service Providers')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header Section -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent mb-2">
                    Service Providers
                </h1>
                <p class="text-lg text-gray-600">
                    Manage all registered service providers in the system
                </p>
            </div>
        </div>

        <!-- Content Card -->
        <div class="bg-white rounded-3xl shadow-xl mb-8">
            <div class="bg-gradient-to-r from-gray-50 to-blue-50 px-8 py-6 border-b border-gray-100 rounded-t-3xl">
                <h2 class="text-2xl font-bold text-gray-900">🔧 All Service Providers</h2>
                <p class="text-gray-600 mt-1">List of all registered service providers and their services</p>
            </div>
            
            <div class="p-6 overflow-x-auto">
                @if($providers->isEmpty())
                    <div class="text-center py-8">
                        <div class="mx-auto h-20 w-20 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                            <svg class="h-10 w-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">No Service Providers Found</h3>
                        <p class="text-gray-500">There are currently no service providers registered in the system</p>
                    </div>
                @else
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Services</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($providers as $provider)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $provider->user->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $provider->user->name }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $provider->user->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @forelse($provider->user->services as $service)
                                        <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full mr-1 mb-1">
                                            {{ $service->type }}
                                        </span>
                                    @empty
                                        <span class="text-gray-500 text-xs">No services</span>
                                    @endforelse
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('providers.show', $provider->id) }}" 
                                        class="inline-flex items-center px-3 py-1 bg-blue-600 text-white rounded-full hover:bg-blue-700 text-sm transition-colors">
                                            View Info
                                        </a>

                                        <form action="{{ route('providers.destroy', $provider->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this provider?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                class="inline-flex items-center px-3 py-1 bg-red-600 text-white rounded-full hover:bg-red-700 text-sm transition-colors">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
            
            
            
        </div>
    </div>
</div>
@endsection