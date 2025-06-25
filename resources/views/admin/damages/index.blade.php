@extends('admin.main')

@section('title', 'All Damages')
@section('header', 'All Individual Damages')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <h2 class="text-xl font-semibold mb-4">List of Damages</h2>

    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">User Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">ID</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Report ID</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Description</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Image</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($damages as $damage)
            <tr>
                <td class="px-6 py-4 text-sm text-gray-900">{{ $damage->report->full_name ?? 'N/A' }}</td>
                <td class="px-6 py-4 text-sm text-gray-900">{{ $damage->id }}</td>
                <td class="px-6 py-4 text-sm text-gray-900">{{ $damage->damage_report_id }}</td>
                <td class="px-6 py-4 text-sm text-gray-900">{{ $damage->name }}</td>
                <td class="px-6 py-4 text-sm text-gray-900">{{ $damage->description }}</td>
                <td class="px-6 py-4 text-sm text-gray-900">
    @if($damage->image_path)
        <a href="{{ route('damages.images', $damage->id) }}" 
           class="inline-block px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">
           View Images
        </a>
    @else
        <span>No Images</span>
    @endif
</td>

                <td class="px-6 py-4 text-sm">
                    @if($damage->status === 'accepted')
                        <span class="px-2 inline-flex text-xs font-semibold rounded-full bg-green-100 text-green-800">Accepted</span>
                    @elseif($damage->status === 'declined')
                        <span class="px-2 inline-flex text-xs font-semibold rounded-full bg-red-100 text-red-800">Declined</span>
                    @else
                        <span class="px-2 inline-flex text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                    @endif
                </td>
                <td class="px-6 py-4 space-x-2">
                    @if($damage->status === 'pending')
                        <form action="{{ route('damages.accept', $damage->id) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white text-xs px-3 py-1 rounded">Accept</button>
                        </form>
                        <form action="{{ route('damages.decline', $damage->id) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white text-xs px-3 py-1 rounded">Decline</button>
                        </form>
                    @else
                        <span class="text-gray-400 text-xs">No actions</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">No damages found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
