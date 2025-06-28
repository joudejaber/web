@extends('layout.app')

@section('title', 'Admin Dashboard - Service Providers')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">All Service Providers</h1>

    @if($providers->isEmpty())
        <p>No service providers found.</p>
    @else
        <table class="min-w-full bg-white rounded shadow">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b border-gray-300 text-left">ID</th>
                    <th class="py-2 px-4 border-b border-gray-300 text-left">Name</th>
                    <th class="py-2 px-4 border-b border-gray-300 text-left">Email</th>
                    <th class="py-2 px-4 border-b border-gray-300 text-left">Services</th>
                    <th class="py-2 px-4 border-b border-gray-300 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($providers as $provider)
                <tr>
                    <td class="py-2 px-4 border-b border-gray-300 text-left">{{ $provider->user->id }}</td>
                    <td class="py-2 px-4 border-b border-gray-300 text-left">{{ $provider->user->name }}</td>
                    <td class="py-2 px-4 border-b border-gray-300 text-left">{{ $provider->user->email }}</td>
                    <td class="py-2 px-4 border-b border-gray-300 text-left">
                        @forelse($provider->user->services as $service)
                            <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded mr-1">
                                {{ $service->type }}
                            </span>
                        @empty
                            <span class="text-gray-500 text-xs">No services</span>
                        @endforelse
                    </td>
                    <td class="py-2 px-4 border-b border-gray-300 text-left">
                        <a href="{{ route('providers.show', $provider->id) }}" 
                        class="inline-block mr-2 px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">
                            View Info
                        </a>

                        <form action="{{ route('providers.destroy', $provider->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this provider?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 text-sm">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
