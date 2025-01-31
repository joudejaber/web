@extends('layouts.app')

@section('title', 'Government Dashboard - RenovAid')

@section('content')
<div class="container my-5">
    <h1 class="text-center mb-4">Government Dashboard</h1>

    <!-- Data Visualization -->
    <div class="card mb-4">
        <div class="card-body">
            <h2 class="card-title">Repair Costs by Region</h2>
            <div id="chart">
                <!-- Chart will be dynamically added here -->
            </div>
        </div>
    </div>

    <!-- Compensation Management -->
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">Compensation Requests</h2>
            <div id="compensationRequests">
                <!-- Requests will be dynamically added here -->
            </div>
        </div>
    </div>
</div>
@endsection