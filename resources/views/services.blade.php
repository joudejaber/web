@extends('layouts.app')

@section('title', 'Services - RenovAid')

@section('content')
<div class="container my-5">
    <h1 class="text-center mb-4">Services</h1>
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Roof Repair</h5>
                    <p class="card-text">Expert roof repair services to restore your home.</p>
                    <a href="#" class="btn btn-primary">Book Now</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Plumbing</h5>
                    <p class="card-text">Professional plumbing services for your home.</p>
                    <a href="#" class="btn btn-primary">Book Now</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Electrical</h5>
                    <p class="card-text">Safe and reliable electrical repair services.</p>
                    <a href="#" class="btn btn-primary">Book Now</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection