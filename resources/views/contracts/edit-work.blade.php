@extends('layout.app')

@section('content')
<div class="max-w-3xl mx-auto py-8">
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-4">Edit Work</h2>
        <form action="{{ route('contract.work.update', [$contract->id, $work->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <label class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" class="w-full mt-1 border rounded p-2" required>{{ $work->description }}</textarea>

            <label class="block mt-4 text-sm font-medium text-gray-700">Cost</label>
            <input type="number" name="cost" value="{{ $work->cost }}" class="w-full mt-1 border rounded p-2">

            <label class="block mt-4 text-sm font-medium text-gray-700">Start Date</label>
            <input type="date" name="start_date" value="{{ $work->start_date }}" class="w-full mt-1 border rounded p-2" required>

            <label class="block mt-4 text-sm font-medium text-gray-700">End Date</label>
            <input type="date" name="end_date" value="{{ $work->end_date }}" class="w-full mt-1 border rounded p-2">

            {{-- Upload New Images --}}
            <label class="block mt-6 text-sm font-medium text-gray-700">Upload New Images</label>
            <input type="file" name="pictures[]" multiple class="w-full mt-1">

            <button type="submit" class="mt-6 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Update Work
            </button>
        </form>

        {{-- Existing Images --}}
        @if ($work->images->count())
            <div class="mt-8">
                <p class="text-sm font-medium text-gray-700 mb-2">Current Images</p>
                <div class="flex flex-wrap gap-3">
                    @foreach ($work->images as $img)
                        <div class="relative">
                            <img src="{{ asset('storage/' . $img->image_path) }}" class="w-24 h-24 object-cover rounded border">
                            <form method="POST" action="{{ route('contract.work.image.destroy', $img->id) }}"
                                  class="absolute top-0 right-0"
                                  onsubmit="return confirm('Delete this image?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" title="Delete">
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