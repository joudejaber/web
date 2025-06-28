@extends('layout.app')

@section('title', 'Damage Reports for ' . $user->name)

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Damage Reports for {{ $user->name }}</h1>

    <div class="bg-white shadow rounded-lg overflow-x-auto">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-100 text-gray-700 text-sm font-semibold">
                <tr>
                    <th class="px-6 py-3 text-left">Damage Type</th>
                    <th class="px-6 py-3 text-left">Description</th>
                    <th class="px-6 py-3 text-left">Images</th>
                </tr>
            </thead>
            <tbody class="text-sm text-gray-600 divide-y divide-gray-200">
                @forelse($damageReports as $report)
                    @foreach($report->damages as $damage)
                        <tr>
                            <td class="px-6 py-4">{{ $damage->name ?? '—' }}</td>
                            <td class="px-6 py-4">{{ $damage->description ?? '—' }}</td>
                            <td class="px-6 py-4">
                                @if($damage->image_path)
                                    <a href="{{ route('government.damages.images', $damage->id) }}" class="text-blue-600 hover:underline">View Images</a>
                                @else
                                    <span>No Image</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @empty
                    <tr>
                        <td colspan="3" class="text-center text-gray-500 px-6 py-4">No damages found for this homeowner.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <a href="{{ route('government.dashboard') }}" class="mt-6 inline-block text-blue-600 hover:underline">Back to Dashboard</a>
</div>
@endsection
