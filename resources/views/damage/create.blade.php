@extends('layouts.app')

@section('title', 'Damage Documentation - RenovAid')

@section('content')
<div class="container my-5">
    <h1 class="text-center mb-4">Damage Documentation</h1>

    <!-- Display success message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Damage Documentation Form -->
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">Document Damages</h2>
            <form action="{{ route('damage.store') }}" method="POST" enctype="multipart/form-data" id="damageForm">
                @csrf
                <!-- Image Upload -->
                <label for="images">Upload Images (Max 5)</label>
                <input type="file" name="images[]" id="images" multiple accept="image/*" class="form-control mb-3">
                <div class="preview-container" id="imagePreview"></div>

                <!-- Damage Description -->
                <label for="description">Description</label>
                <textarea name="description" id="description" placeholder="Describe the damages..." rows="4" class="form-control mb-3" required></textarea>

                <!-- Submit Button -->
                <button type="submit" id="submitButton" class="btn btn-primary">Submit Documentation</button>
            </form>
        </div>
    </div>
</div>
@endsection