@extends('layout.app')

@section('content')
<div class="max-w-3xl mx-auto py-10 px-4">
    <div class="bg-white p-8 rounded-3xl shadow-lg">
        <h2 class="text-3xl font-bold mb-6 text-gray-900">Edit Work</h2>
        <form action="{{ route('contract.work.update', [$contract->id, $work->id]) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="description" class="block text-sm font-semibold text-gray-700 mb-1">Description</label>
                <textarea id="description" name="description" required
                    class="w-full rounded-xl border border-gray-300 p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"
                    rows="4">{{ $work->description }}</textarea>
            </div>

            <div>
                <label for="cost" class="block text-sm font-semibold text-gray-700 mb-1">Cost</label>
                <input type="number" id="cost" name="cost" value="{{ $work->cost }}"
                    class="w-full rounded-xl border border-gray-300 p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
            </div>

            <div>
                <label for="start_date" class="block text-sm font-semibold text-gray-700 mb-1">Start Date</label>
                <input type="date" id="start_date" name="start_date" value="{{ $work->start_date }}" required
                    class="w-full rounded-xl border border-gray-300 p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
            </div>

            <div>
                <label for="end_date" class="block text-sm font-semibold text-gray-700 mb-1">End Date</label>
                <input type="date" id="end_date" name="end_date" value="{{ $work->end_date }}"
                    class="w-full rounded-xl border border-gray-300 p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
            </div>

            <div>
                <label for="pictures" class="block text-sm font-semibold text-gray-700 mb-1">Upload New Images</label>
                <input type="file" id="pictures" name="pictures[]" multiple
                    class="w-full rounded-xl border border-gray-300 p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
            </div>

            <button type="submit"
                class="w-full py-3 bg-blue-600 text-white font-semibold rounded-xl hover:bg-blue-700 transition-colors duration-300">
                Update Work
            </button>
        </form>

        @if ($work->images->count())
            <div class="mt-10">
                <p class="text-md font-semibold text-gray-700 mb-4">Current Images</p>
                <div class="flex flex-wrap gap-4">
                    @foreach ($work->images as $img)
                        <div class="relative w-28 h-28 rounded-lg overflow-hidden border border-gray-200 shadow-sm">
                            <img src="{{ asset('storage/' . $img->image_path) }}" alt="Work Image"
                                class="w-full h-full object-cover" />
                            <form method="POST" action="{{ route('contract.work.image.destroy', $img->id) }}"
                                class="absolute top-1 right-1"
                                onsubmit="return confirm('Delete this image?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="text-red-600 hover:text-red-900 bg-white rounded-full p-1 shadow-md">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
