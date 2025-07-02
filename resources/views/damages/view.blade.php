@extends('layout.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100">
    <!-- Back Navigation -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pt-8">
        <a href="{{ url()->previous() }}" 
           class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium transition-colors group">
            <svg class="w-5 h-5 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back
        </a>
    </div>

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden">
            <!-- Header Section -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-8 py-10">
                <div class="text-center">
                    <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </div>
                    <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">Damage Details</h1>
                    <p class="text-blue-100 text-lg">View comprehensive damage information</p>
                </div>
            </div>

            <!-- Content Section -->
            <div class="p-8">
                <!-- Damage Information -->
                <div class="space-y-8">
                    <!-- Damage Name Section -->
                    <div class="space-y-4">
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">Damage Name</h3>
                        </div>
                        
                        <div class="bg-gray-50 border border-gray-200 p-6 rounded-xl">
                            <p class="text-lg font-semibold text-gray-900">{{ $damage->name }}</p>
                        </div>
                    </div>

                    <!-- Description Section -->
                    <div class="space-y-4">
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">Description</h3>
                        </div>
                        
                        <div class="bg-gray-50 border border-gray-200 p-6 rounded-xl">
                            <p class="text-gray-700 leading-relaxed">{{ $damage->description }}</p>
                        </div>
                    </div>

                    <!-- Images Section -->
                    @if($damage->image_path)
                    <div class="space-y-4">
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">Damage Images</h3>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach(json_decode($damage->image_path, true) as $path)
                            <div class="bg-gray-50 border border-gray-200 p-4 rounded-xl">
                                <div class="aspect-square w-full overflow-hidden rounded-lg bg-gray-100">
                                    <img src="{{ asset('storage/' . $path) }}" 
                                         alt="Damage image" 
                                         class="w-full h-full object-cover hover:scale-105 transition-transform duration-300 cursor-pointer"
                                         onclick="openImageModal('{{ asset('storage/' . $path) }}')">
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Action Button -->
                    <div class="flex justify-center pt-6 border-t border-gray-200">
                        <a href="{{ url()->previous() }}" 
                           class="px-8 py-4 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-blue-800 focus:ring-4 focus:ring-blue-300 transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                Back to Previous Page
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Image Modal -->
<div id="imageModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-75 flex items-center justify-center p-4">
    <div class="relative max-w-4xl max-h-full">
        <button onclick="closeImageModal()" 
                class="absolute top-4 right-4 text-white hover:text-gray-300 z-10">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <img id="modalImage" src="" alt="Enlarged damage image" class="max-w-full max-h-full rounded-lg shadow-2xl">
    </div>
</div>

<script>
function openImageModal(imageSrc) {
    document.getElementById('modalImage').src = imageSrc;
    document.getElementById('imageModal').classList.remove('hidden');
}

function closeImageModal() {
    document.getElementById('imageModal').classList.add('hidden');
}

// Close modal when clicking outside the image
document.getElementById('imageModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeImageModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeImageModal();
    }
});
</script>
@endsection