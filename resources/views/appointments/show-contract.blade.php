@extends('layout.app')

@section('title', 'View Contract')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Contract Details</h1>

    <div class="bg-white shadow rounded-lg p-6 mb-8">
        <p><strong>Homeowner:</strong> {{ $contract->appointment->homeowner->name ?? 'N/A' }}</p>
        <p><strong>Service Provider:</strong> {{ $contract->appointment->provider->name ?? 'N/A' }}</p>
        <p><strong>Service:</strong> {{ $contract->appointment->service->name ?? 'N/A' }}</p>
        <p><strong>Contract Details:</strong></p>
        <p class="whitespace-pre-line border p-4 rounded bg-gray-50">{{ $contract->contract_details ?? $contract->details ?? 'No details available.' }}</p>
        <p class="mt-4"><strong>Status:</strong> {{ ucfirst($contract->status ?? 'N/A') }}</p>
    </div>

    <h2 class="text-xl font-semibold mb-4">Works Done</h2>

    @if($contract->works->isEmpty())
        <p class="text-gray-600 mb-6">No works recorded for this contract.</p>
    @else
        <table class="min-w-full table-auto mb-6 bg-white shadow rounded-lg overflow-hidden">
            <thead class="bg-gray-100 text-gray-700 font-semibold">
                <tr>
                    <th class="px-4 py-2 text-left">Work Description</th>
                    <th class="px-4 py-2 text-left">Cost</th>
                    <th class="px-4 py-2 text-left">Images</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 text-gray-600">
                @foreach($contract->works as $work)
                    <tr>
                        <td class="px-4 py-2">{{ $work->description ?? '—' }}</td>
                        <td class="px-4 py-2">${{ number_format($work->cost, 2) }}</td>
                        <td class="px-4 py-2">
                            @if($work->images && $work->images->count() > 0)
                                @foreach($work->images as $image)
                                    <a href="{{ asset('storage/' . $image->image_path) }}" target="_blank" rel="noopener noreferrer" class="inline-block mr-2 mb-2">
                                        <img src="{{ asset('storage/' . $image->image_path) }}" alt="Work Image" class="h-16 w-auto rounded border" />
                                    </a>
                                @endforeach
                            @else
                                <span>No Image</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p class="text-lg font-semibold">Total Cost: ${{ number_format($contract->works->sum('cost'), 2) }}</p>
    @endif

    <a href="{{ route('appointments.create') }}" class="mt-6 inline-block text-blue-600 hover:underline">Back to Appointments</a>
</div>
@endsection
