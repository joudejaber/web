@extends('layout.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100">
    <!-- Back Navigation -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pt-8">
        <a href="{{ route('services.index') }}" 
           class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium transition-colors group">
            <svg class="w-5 h-5 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Services
        </a>
    </div>

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Associated Service Header -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-3xl shadow-xl p-6 mb-8">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    @if($service->image)
                        <img src="{{ Storage::url($service->image) }}" alt="{{ $service->name }}" class="w-16 h-16 rounded-full object-cover border-2 border-white">
                    @endif
                    <div>
                        <h3 class="text-2xl font-bold">{{ $service->name }}</h3>
                        <p class="text-blue-100 text-sm">{{ $service->type }}</p>
                    </div>
                </div>
                <div class="bg-white/20 rounded-full p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c1.657 0 3-1.343 3-3S13.657 2 12 2s-3 1.343-3 3 1.343 3 3 3zM6 22v-2a4 4 0 014-4h4a4 4 0 014 4v2" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-3xl shadow-xl p-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Create New Product</h2>

            <!-- Alerts -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-xl mb-4">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-xl mb-4">
                    {{ session('error') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-xl mb-4">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form -->
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <input type="hidden" name="service_id" value="{{ $service->id }}">

                <!-- Product Name -->
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700">Product Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                           required>
                </div>

                <!-- Category -->
                <div>
                    <label for="category" class="block text-sm font-semibold text-gray-700">Category</label>
                    <input type="text" name="category" id="category" value="{{ old('category') }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                           required>
                </div>

                <!-- Price -->
                <div>
                    <label for="price" class="block text-sm font-semibold text-gray-700">Price</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-500">$</span>
                        </div>
                        <input type="number" name="price" id="price" step="0.01" value="{{ old('price') }}"
                               class="pl-7 w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                               required>
                    </div>
                </div>

                <!-- Product Image Upload -->
                <div>
                    <label for="image" class="block text-sm font-semibold text-gray-700">Product Image</label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl bg-gray-50">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                      stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex justify-center text-sm text-gray-600">
                                <label for="image"
                                       class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500">
                                    <span>Upload a file</span>
                                    <input id="image" name="image" type="file" class="sr-only" required>
                                </label>
                                <span class="pl-1">or drag & drop</span>
                            </div>
                            <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                        </div>
                    </div>

                    <!-- Image Preview -->
                    <div id="image-preview" class="mt-4 hidden">
                        <img src="" alt="Image Preview" class="mx-auto max-w-xs max-h-48 rounded-lg shadow-md">
                    </div>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit"
                            class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white py-3 px-6 rounded-xl font-semibold hover:from-blue-700 hover:to-blue-800 focus:ring-4 focus:ring-blue-300 transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl">
                        Create Product
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('image').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('image-preview');
        const previewImg = preview.querySelector('img');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                preview.classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        } else {
            preview.classList.add('hidden');
        }
    });
</script>
@endpush
