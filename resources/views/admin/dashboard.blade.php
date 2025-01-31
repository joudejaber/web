@extends('layouts.app')

@section('title', 'Admin Dashboard - RenovAid')

@section('content')
<div class="container my-5">
    <h1 class="text-center mb-4">Admin Dashboard</h1>

    <!-- User Management -->
    <div class="card mb-4">
        <div class="card-body">
            <h2 class="card-title">Manage Users</h2>
            <div id="users">
                <!-- Users will be dynamically added here -->
            </div>
        </div>
    </div>

    <!-- Content Management -->
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">Manage Content</h2>
            <form id="contentForm">
                <label for="faq">FAQ</label>
                <textarea id="faq" rows="4" class="form-control mb-3" placeholder="Add FAQ content..."></textarea>

                <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>
        </div>
    </div>
</div>
@endsection