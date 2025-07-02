@extends('layout.app')

@section('title', 'All Damages')
@section('header', 'All Individual Damages')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header Section -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent mb-2">
                All Individual Damages
            </h1>
            <p class="text-lg text-gray-600">
                Comprehensive list of all reported damages
            </p>
        </div>

        <!-- Content Card -->
        <div class="bg-white rounded-3xl shadow-xl">
            <div class="bg-gradient-to-r from-gray-50 to-blue-50 px-8 py-6 border-b border-gray-100 rounded-t-3xl">
                <h2 class="text-2xl font-bold text-gray-900">🛠️ List of Damages</h2>
                <p class="text-gray-600 mt-1">Detailed view of all damage reports in the system</p>
            </div>

            @if(session('success'))
                <div class="mx-6 mt-6 px-4 py-3 bg-green-100 text-green-800 rounded-xl shadow">
                    {{ session('success') }}
                </div>
            @endif

            <div class="p-6 overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Reported By</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Report ID</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($damages as $damage)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $damage->report->user->name ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $damage->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $damage->damage_report_id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $damage->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900 max-w-xs truncate" title="{{ $damage->description }}">
                                {{ $damage->description }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                @if($damage->image_path)
                                    @php
                                        $images = json_decode($damage->image_path, true);
                                    @endphp
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($images as $image)
                                            <img src="{{ asset('storage/' . $image) }}" alt="Damage Image" class="w-16 h-16 object-cover rounded">
                                        @endforeach
                                    </div>
                                @else
                                    <span class="text-gray-500">No Images</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                @if($damage->status === 'accepted')
                                    <span class="px-2 inline-flex text-xs font-semibold rounded-full bg-green-100 text-green-800">Accepted</span>
                                @elseif($damage->status === 'declined')
                                    <span class="px-2 inline-flex text-xs font-semibold rounded-full bg-red-100 text-red-800">Declined</span>
                                @else
                                    <span class="px-2 inline-flex text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-right">
                                <form action="{{ route('admin.damages.destroy', $damage->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this damage?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Delete" class="text-red-600 hover:text-red-800 p-2 rounded-full hover:bg-red-50 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m-3-3v3m-6 0h12"/>
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="px-6 py-4 text-center text-sm text-gray-500">
                                <div class="flex flex-col items-center justify-center py-8">
                                    <svg class="h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <p class="mt-2 text-sm font-medium text-gray-900">No damages found</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
