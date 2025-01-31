@extends('layouts.app')

@section('title', 'Home - RenovAid')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-md-8 offset-md-2 text-center">
            <h1>Welcome to RenovAid</h1>
            <p class="lead">Your partner in post-war reconstruction and recovery.</p>
            <a href="{{ route('damage.create') }}" class="btn btn-primary btn-lg">Document Damages</a>
            <a href="{{ route('services') }}" class="btn btn-secondary btn-lg">Find Services</a>
        </div>
    </div>
</div>
@endsection