@extends('layout.app')

@section('content')
<div class="max-w-4xl mx-auto py-10">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-bold mb-4">Damage Report Summary</h2>
        <p><strong>Report Date:</strong> {{ $report->report_date }}</p>

        <div class="mt-6">
            <h3 class="text-lg font-semibold mb-2">Damages</h3>
            @foreach($report->damages as $damage)
                <div class="mb-4 border p-4 rounded-md bg-gray-50">
                    <p><strong>Name:</strong> {{ $damage->name }}</p>
                    <p><strong>Description:</strong> {{ $damage->description }}</p>
                    @if($damage->images->count())
                        <div class="mt-2 grid grid-cols-2 gap-4">
                            @foreach($damage->images as $image)
                                <img src="{{ asset('storage/' . $image->image) }}" alt="Damage image" class="w-full h-auto rounded-md">
                            @endforeach
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        
    </div>
</div>
@endsection
