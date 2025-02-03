@extends('layout.app')

@section('content')
<div class="max-w-2xl mx-auto px-4 py-8">
    <div class="bg-white shadow-md rounded-lg">
        <div class="border-b border-gray-200 p-6">
            <h2 class="text-2xl font-bold text-gray-900">Add Images to Damage Report</h2>
            <p class="text-sm text-gray-500 mt-2">Upload additional images for {{ $damage->type }} damage at {{ $damage->location }}</p>
        </div>

        <form action="{{ route('damages.storeimages', $damage->id) }}" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf

            <div>
                <label for="image" class="block text-sm font-medium text-gray-700">New Damage Images</label>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                    <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-gray-600">
                            <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                <span>Upload files</span>
                                <input id="image" name="images[]" type="file" class="sr-only" 
                                       accept="image/jpeg,image/png,image/jpg,image/gif"
                                       multiple>
                            </label>
                            <p class="pl-1">or drag and drop</p>
                        </div>
                        <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                    </div>
                </div>
                @error('images')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
                <div id="image-preview" class="mt-4 grid grid-cols-4 gap-4">
                </div>
            </div>

            <div class="mt-6 flex justify-end space-x-4">
                <a href="{{ route('dashboard') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 rounded-md border border-gray-300">
                    Cancel
                </a>
                <button type="submit" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Add Images
                </button>
            </div>
        </form>

        @if($damage->damage_image->isNotEmpty())
            <div class="p-6 border-t">
                <h3 class="text-lg font-medium mb-4">Existing Images</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach($damage->damage_image as $image)
                        <div class="relative group">
                            <img src="{{ Storage::url($image->image) }}" alt="Damage Image" class="h-32 w-full object-cover rounded-lg">
                            <div class="absolute top-2 right-2">
                                <form action="{{ route('damages.images.destroy', $image->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this image?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white p-1 rounded-full hover:bg-red-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('image').addEventListener('change', function(event) {
        const files = event.target.files;
        const preview = document.getElementById('image-preview');
        
        preview.innerHTML = '';

        if (files.length > 0) {
            preview.classList.remove('hidden');
            
            Array.from(files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const imgContainer = document.createElement('div');
                    imgContainer.className = 'relative';
                    
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'h-32 w-full object-cover rounded-lg';
                    
                    const removeBtn = document.createElement('button');
                    removeBtn.innerHTML = `
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    `;
                    removeBtn.className = 'absolute top-1 right-1 bg-red-500 text-white rounded-full p-1 hover:bg-red-600';
                    removeBtn.type = 'button';
                    
                    removeBtn.addEventListener('click', () => {
                        imgContainer.remove();
                        
                        const dataTransfer = new DataTransfer();
                        Array.from(files).forEach(remainingFile => {
                            if (remainingFile !== file) {
                                dataTransfer.items.add(remainingFile);
                            }
                        });
                        document.getElementById('image').files = dataTransfer.files;
                    });

                    imgContainer.appendChild(img);
                    imgContainer.appendChild(removeBtn);
                    preview.appendChild(imgContainer);
                }
                reader.readAsDataURL(file);
            });
        } else {
            preview.classList.add('hidden');
        }
    });
</script>
@endpush