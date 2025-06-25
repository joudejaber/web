@extends('layout.app') 

@section('content')
<div class="container mx-auto px-4 py-6">
    <h2 class="text-xl font-bold mb-4">Personal & Property Information</h2>

    <form action="{{ route('personal.report.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="full_name" class="block">Full Name</label>
            <input type="text" name="full_name" id="full_name" class="w-full border p-2" required>
        </div>

        <div class="mb-4">
            <label for="phone_number" class="block">Phone Number</label>
            <input type="text" name="phone_number" id="phone_number" class="w-full border p-2" required>
        </div>

        <div class="mb-4">
            <label for="email" class="block">Email</label>
            <input type="email" name="email" id="email" class="w-full border p-2" required>
        </div>

        <div class="mb-4">
            <label for="city" class="block">City</label>
            <input type="text" name="city" id="city" class="w-full border p-2" required>
        </div>

        <div class="mb-4">
            <label for="street" class="block">Street</label>
            <input type="text" name="street" id="street" class="w-full border p-2" required>
        </div>

        <div class="mb-4">
            <label for="building_name" class="block">Building Name</label>
            <input type="text" name="building_name" id="building_name" class="w-full border p-2" required>
        </div>

        <div class="mb-4">
            <label for="floor_number" class="block">Floor Number (optional)</label>
            <input type="text" name="floor_number" id="floor_number" class="w-full border p-2">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Submit</button>
    </form>
</div>
@endsection
