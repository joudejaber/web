@extends('layout.app') <!-- Or your main layout -->

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-3xl font-bold mb-4">Government Dashboard</h1>

    <p>Welcome, {{ auth()->user()->name }}! This is your government dashboard.</p>

    <!-- Add government-specific dashboard content here -->
</div>
@endsection
