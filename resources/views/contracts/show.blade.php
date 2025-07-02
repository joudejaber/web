@extends('layout.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden">
            <!-- Header Section -->
            <div class="bg-gradient-to-r from-gray-50 to-blue-50 px-8 py-6 border-b border-gray-100">
                <h1 class="text-3xl font-bold text-gray-900">Contract Details</h1>
                <p class="text-gray-600 mt-1">Review and manage contract information</p>
            </div>

            <div class="p-8">
                <!-- Contract Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="space-y-2">
                        <h3 class="text-sm font-medium text-gray-500">Service Provider</h3>
                        <p class="text-lg font-semibold text-gray-900">{{ optional($contract->provider)->name ?? 'Unknown' }}</p>
                    </div>
                    <div class="space-y-2">
                        <h3 class="text-sm font-medium text-gray-500">Homeowner</h3>
                        <p class="text-lg font-semibold text-gray-900">{{ optional($contract->homeowner)->name ?? 'Unknown' }}</p>
                    </div>
                    <div class="space-y-2">
                        <h3 class="text-sm font-medium text-gray-500">Service</h3>
                        <p class="text-lg font-semibold text-gray-900">{{ optional(optional($contract->appointment)->service)->name ?? 'Unknown' }}</p>
                    </div>
                    <div class="space-y-2">
                        <h3 class="text-sm font-medium text-gray-500">Created At</h3>
                        <p class="text-lg font-semibold text-gray-900">{{ $contract->created_at->format('M d, Y h:i A') }}</p>
                    </div>
                </div>

                <!-- Contract Details -->
                <div class="space-y-2 mb-8">
                    <h3 class="text-sm font-medium text-gray-500">Contract Details</h3>
                    <div class="bg-gray-50 p-4 rounded-xl border border-gray-200">
                        <p class="whitespace-pre-line text-gray-700">{{ $contract->contract_details }}</p>
                    </div>
                </div>

                <!-- Works Section -->
                <form action="{{ route('contract.storeWork', $contract->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf

                    <div id="work-sections" class="space-y-6">
                        <!-- Existing Works -->
                        @foreach ($contract->works as $i => $work)
                            <div class="relative bg-white rounded-2xl shadow-sm p-6 border border-gray-200 hover:shadow-md transition-shadow">
                                <div class="absolute top-4 right-4 flex space-x-3">
                                    <a href="{{ route('contract.work.edit', [$contract->id, $work->id]) }}" 
                                       class="text-blue-600 hover:text-blue-800" title="Edit">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                    <button type="button"
                                        class="text-red-600 hover:text-red-800"
                                        title="Delete"
                                        onclick="event.preventDefault(); document.getElementById('delete-work-{{ $work->id }}').submit();">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>

                                @push('deleteForms')
                                <form id="delete-work-{{ $work->id }}" method="POST" action="{{ route('contract.work.destroy', [$contract->id, $work->id]) }}" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                @endpush

                                <h3 class="text-xl font-semibold text-gray-900 mb-4">Work #{{ $i + 1 }}</h3>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="space-y-1">
                                        <h4 class="text-sm font-medium text-gray-500">Description</h4>
                                        <p class="text-gray-700">{{ $work->description }}</p>
                                    </div>
                                    <div class="space-y-1">
                                        <h4 class="text-sm font-medium text-gray-500">Cost</h4>
                                        <p class="text-gray-700">{{ $work->cost ? '$' . number_format($work->cost, 2) : 'N/A' }}</p>
                                    </div>
                                    <div class="space-y-1">
                                        <h4 class="text-sm font-medium text-gray-500">Start Date</h4>
                                        <p class="text-gray-700">{{ $work->start_date }}</p>
                                    </div>
                                    <div class="space-y-1">
                                        <h4 class="text-sm font-medium text-gray-500">End Date</h4>
                                        <p class="text-gray-700">{{ $work->end_date ?? 'N/A' }}</p>
                                    </div>
                                </div>

                                @if ($work->images->count())
                                    <div class="mt-4">
                                        <h4 class="text-sm font-medium text-gray-500 mb-2">Images</h4>
                                        <div class="flex flex-wrap gap-3">
                                            @foreach ($work->images as $img)
                                                <a href="{{ asset('storage/' . $img->image_path) }}" target="_blank" class="group">
                                                    <img src="{{ asset('storage/' . $img->image_path) }}" 
                                                         alt="Work Image" 
                                                         class="w-24 h-24 object-cover rounded-lg border border-gray-200 group-hover:border-blue-300 transition-colors">
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <!-- New Work Template -->
                    <template id="new-work-template">
                        <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-200">
                            <h3 class="text-xl font-semibold text-gray-900 mb-4">New Work #__index__</h3>
                            
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                                    <textarea name="work[__index__][description]" rows="3" required
                                        class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors bg-gray-50 hover:bg-white"></textarea>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Images</label>
                                    <input type="file" name="work[__index__][pictures][]" multiple
                                        class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors bg-gray-50 hover:bg-white">
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Cost</label>
                                        <input type="number" name="work[__index__][cost]"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors bg-gray-50 hover:bg-white">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
                                        <input type="date" name="work[__index__][start_date]" required
                                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors bg-gray-50 hover:bg-white">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
                                        <input type="date" name="work[__index__][end_date]"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors bg-gray-50 hover:bg-white">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>

                    <!-- Form Buttons -->
                    <div class="flex flex-wrap gap-4">
                        <button type="button" id="addWorkBtn" 
                                class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-[1.02]">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Add Work
                        </button>

                        <button type="submit" 
                                class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-[1.02]">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Save All Work
                        </button>
                    </div>
                </form>

                @stack('deleteForms')

                <!-- Total Cost -->
                @php
                    $totalCost = $contract->works->sum('cost');
                @endphp
                <div class="mt-12 bg-gray-50 p-6 rounded-xl border border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Total Contract Cost</h3>
                    <p class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">${{ number_format($totalCost, 2) }}</p>
                </div>

                <!-- Contract Status -->
                <div class="mt-12">
                    <h3 class="text-lg font-semibold text-gray-900 mb-6">Contract Status</h3>
                    <form action="{{ route('contract.updateStatus', $contract->id) }}" method="POST" class="flex flex-col items-center">
                        @csrf
                        @method('PUT')
                        <div class="flex items-center w-full max-w-md justify-between mb-8">
                            @php
                                $statuses = ['started' => 'Started', 'in_progress' => 'In Progress', 'finished' => 'Finished'];
                                $currentStatus = $contract->status ?? 'started';
                            @endphp
                            @foreach($statuses as $key => $label)
                                <div class="flex flex-col items-center flex-1">
                                    <button type="submit" name="status" value="{{ $key }}"
                                        class="w-12 h-12 rounded-full border-2
                                            {{ $currentStatus === $key ? 'bg-blue-600 border-blue-600' : 'bg-white border-gray-300' }}
                                            flex items-center justify-center mb-2
                                            transition-colors duration-200 hover:shadow-md">
                                        <span class="w-6 h-6 rounded-full
                                            {{ $currentStatus === $key ? 'bg-white' : 'bg-gray-300' }}">
                                        </span>
                                    </button>
                                    <span class="text-sm {{ $currentStatus === $key ? 'text-blue-600 font-bold' : 'text-gray-500' }}">{{ $label }}</span>
                                </div>
                                @if (!$loop->last)
                                    <div class="flex-1 h-1 bg-gray-300 mx-2"></div>
                                @endif
                            @endforeach
                        </div>
                    </form>
                </div>

                <!-- Back Button -->
                <div class="mt-12 text-center">
                    <a href="{{ route('provider.appointments') }}"
                       class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-gray-600 to-gray-700 hover:from-gray-700 hover:to-gray-800 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-[1.02]">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to Appointments
                    </a>
                </div>
            </div>
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
            workSections.appendChild(wrapper.firstElementChild);
            workIndex++;
        });
    });
</script>
@endsection