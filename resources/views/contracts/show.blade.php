@extends('layout.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-2xl font-semibold mb-6">Contract Details</h2>

        <div class="space-y-3 mb-8">
            <p><strong>Provider:</strong> {{ optional($contract->provider)->name ?? 'Unknown Provider' }}</p>
            <p><strong>Homeowner:</strong> {{ optional($contract->homeowner)->name ?? 'Unknown Homeowner' }}</p>
            <p><strong>Service:</strong> {{ optional(optional($contract->appointment)->service)->name ?? 'Unknown Service' }}</p>
            <p><strong>Contract Details:</strong></p>
            <p class="whitespace-pre-line">{{ $contract->contract_details }}</p>
            <p><strong>Created At:</strong> {{ $contract->created_at->format('M d, Y h:i A') }}</p>
        </div>

        <form action="{{ route('contract.storeWork', $contract->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="space-y-6" id="work-sections">
                {{-- Existing works --}}
                @foreach ($contract->works as $i => $work)
                    <div class="relative border p-4 rounded-md bg-gray-50">
                        <div class="absolute top-3 right-3 flex space-x-2">
                            <a href="{{ route('contract.work.edit', [$contract->id, $work->id]) }}"
                               class="text-blue-600 hover:text-blue-900" title="Edit">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>
                            <button type="button"
                                class="text-red-600 hover:text-red-900"
                                title="Delete"
                                onclick="event.preventDefault(); document.getElementById('delete-work-{{ $work->id }}').submit();">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>

                        @push('deleteForms')
                        <form id="delete-work-{{ $work->id }}"
                              method="POST"
                              action="{{ route('contract.work.destroy', [$contract->id, $work->id]) }}"
                              style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                        @endpush

                        <h3 class="text-lg font-medium text-gray-900 mb-2">Work #{{ $i + 1 }}</h3>
                        <p><strong>Description:</strong> {{ $work->description }}</p>
                        <p><strong>Cost:</strong> {{ $work->cost ? '$' . $work->cost : 'N/A' }}</p>
                        <p><strong>Start:</strong> {{ $work->start_date }}</p>
                        <p><strong>End:</strong> {{ $work->end_date ?? 'N/A' }}</p>

                        @if ($work->images->count())
                            <div class="mt-2 flex flex-wrap gap-2">
                                @foreach ($work->images as $img)
                                    <img src="{{ asset('storage/' . $img->image_path) }}" class="w-24 h-24 object-cover rounded border">
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

            <!-- Hidden template for new work -->
            <template id="new-work-template">
                <div class="border p-4 rounded-md bg-gray-50 mt-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">New Work #__index__</h3>

                    <label class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="work[__index__][description]" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required></textarea>

                    <label class="block text-sm font-medium text-gray-700 mt-4">Images</label>
                    <input type="file" name="work[__index__][pictures][]" multiple class="mt-1 block w-full">

                    <label class="block text-sm font-medium text-gray-700 mt-4">Cost</label>
                    <input type="number" name="work[__index__][cost]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">

                    <label class="block text-sm font-medium text-gray-700 mt-4">Start Date</label>
                    <input type="date" name="work[__index__][start_date]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>

                    <label class="block text-sm font-medium text-gray-700 mt-4">End Date</label>
                    <input type="date" name="work[__index__][end_date]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
            </template>

            <div class="mt-6 flex space-x-4">
                <button type="button" id="addWorkBtn" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                    + Add Work
                </button>

                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Save Work
                </button>
            </div>
        </form>

        @stack('deleteForms')

        {{-- Total Cost --}}
@php
    $totalCost = $contract->works->sum('cost');
@endphp

<div class="mt-10 bg-gray-100 p-4 rounded-md">
    <h3 class="text-lg font-semibold text-gray-800 mb-2">Total Cost</h3>
    <p class="text-xl font-bold text-blue-700">${{ number_format($totalCost, 2) }}</p>
</div>


        {{-- Contract Status Timeline --}}
        <div class="mt-12">
            <h3 class="text-lg font-semibold mb-4">Contract Status</h3>
            <form action="{{ route('contract.updateStatus', $contract->id) }}" method="POST" class="flex flex-col items-center">
                @csrf
                @method('PUT')
                <div class="flex items-center w-full max-w-md justify-between mb-6">
                    @php
                        $statuses = ['started' => 'Started', 'in_progress' => 'In Progress', 'finished' => 'Finished'];
                        $currentStatus = $contract->status ?? 'started';
                    @endphp
                    @foreach($statuses as $key => $label)
                        <div class="flex flex-col items-center flex-1">
                            <button type="submit" name="status" value="{{ $key }}"
                                class="w-8 h-8 rounded-full border-2
                                    {{ $currentStatus === $key ? 'bg-blue-600 border-blue-600' : 'bg-white border-gray-300' }}
                                    flex items-center justify-center mb-2
                                    transition-colors duration-200">
                                <span class="w-4 h-4 rounded-full
                                    {{ $currentStatus === $key ? 'bg-white' : 'bg-gray-300' }}">
                                </span>
                            </button>
                            <span class="text-xs {{ $currentStatus === $key ? 'text-blue-600 font-bold' : 'text-gray-500' }}">{{ $label }}</span>
                        </div>
                        @if (!$loop->last)
                            <div class="flex-1 h-1 bg-gray-300 mx-1"></div>
                        @endif
                    @endforeach
                </div>
            </form>
        </div>

        <!-- Back to Appointments Button -->
        <div class="mt-10 text-center">
            <a href="{{ route('provider.appointments') }}"
               class="inline-block px-6 py-2 bg-gray-600 text-white text-sm font-medium rounded hover:bg-gray-700">
                ← Back to Appointments
            </a>
        </div>
    </div>
</div>

<!-- Add Work Script -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        let workIndex = {{ $contract->works->count() }};
        const addWorkBtn = document.getElementById('addWorkBtn');
        const workSections = document.getElementById('work-sections');
        const templateHtml = document.getElementById('new-work-template').innerHTML;

        addWorkBtn.addEventListener('click', () => {
            const filledTemplate = templateHtml.replace(/__index__/g, workIndex);
            const wrapper = document.createElement('div');
            wrapper.innerHTML = filledTemplate;
            workSections.appendChild(wrapper);
            workIndex++;
        });
    });
</script>
@endsection
