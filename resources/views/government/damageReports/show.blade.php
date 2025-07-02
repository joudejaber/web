@extends('layout.app')

@section('title', 'Damage Reports for ' . $user->name)

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header Section -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent mb-2">
                Damage Reports
            </h1>
            <p class="text-lg text-gray-600">Damage reports for {{ $user->name }}</p>
        </div>

        <!-- Reports Table Card -->
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden mb-8">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Damage Type</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Images</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($damageReports as $report)
                            @foreach($report->damages as $damage)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $damage->name ?? '—' }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900 max-w-prose">{{ $damage->description ?? '—' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($damage->image_path)
                                            <a href="{{ route('government.damages.images', $damage->id) }}" 
                                               class="inline-flex items-center px-3 py-1 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                                View Images
                                            </a>
                                        @else
                                            <span class="text-sm text-gray-500">No images</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-center">
                                    <div class="text-gray-500 py-8">
                                        <div class="mx-auto h-16 w-16 bg-gray-100 rounded-full flex items-center justify-center mb-3">
                                            <svg class="h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                        <p class="text-gray-900 font-medium">No damages found for this homeowner</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

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