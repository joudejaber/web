@extends('layout.app')

@section('content')
<div class="max-w-xl mx-auto p-6 bg-white rounded shadow">
    <h1 class="text-2xl font-semibold mb-6">Edit Your Profile</h1>

    @if(session('success'))
        <div class="mb-4 text-green-600 font-medium">{{ session('success') }}</div>
    @endif

    <form action="{{ route('provider.profile.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="shop_name" class="block text-gray-700 font-medium">Shop Name</label>
            <input type="text" name="shop_name" id="shop_name" value="{{ old('shop_name', $provider->shop_name) }}" class="w-full border rounded px-3 py-2" required>
            @error('shop_name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="location" class="block text-gray-700 font-medium">Location</label>
            <input type="text" name="location" id="location" value="{{ old('location', $provider->location) }}" class="w-full border rounded px-3 py-2" required>
            @error('location') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-medium">Description</label>
            <textarea name="description" id="description" rows="4" class="w-full border rounded px-3 py-2">{{ old('description', $provider->description) }}</textarea>
            @error('description') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="contact_info" class="block text-gray-700 font-medium">Contact Info</label>
            <input type="text" name="contact_info" id="contact_info" value="{{ old('contact_info', $provider->contact_info) }}" class="w-full border rounded px-3 py-2">
            @error('contact_info') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Save Profile</button>
    </form>
</div>
@endsection
