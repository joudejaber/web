@extends('layout.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="grid grid-cols-1 gap-6">

        {{-- Personal Information --}}
        <div class="bg-white rounded-lg shadow">
            <div class="border-b border-gray-200">
                <div class="p-6">
                    <h2 class="text-xl font-semibold text-gray-900">Personal Information</h2>
                    <p class="text-gray-500 mt-1">
                        @if ($personalInfo)
                            Below are the personal details you submitted. You can edit them if needed.
                        @else
                            Start by filling your personal details for the damage report:
                        @endif
                    </p>
                </div>
            </div>

            <div class="p-6">
                @if ($personalInfo)
    <div class="flex justify-between text-left">
        <!-- Column 1 -->
        <div class="flex flex-col space-y-2 w-1/3">
            <p><strong>Full Name:</strong> {{ $personalInfo->full_name }}</p>
            <p><strong>Phone Number:</strong> {{ $personalInfo->phone_number }}</p>
            <p><strong>Email:</strong> {{ $personalInfo->email }}</p>
        </div>

        <!-- Column 2 -->
        <div class="flex flex-col space-y-2 w-1/3">
            <p><strong>City:</strong> {{ $personalInfo->city }}</p>
            <p><strong>Street:</strong> {{ $personalInfo->street }}</p>
        </div>

        <!-- Column 3 -->
        <div class="flex flex-col space-y-2 w-1/3">
            <p><strong>Building Name:</strong> {{ $personalInfo->building_name }}</p>
            <p><strong>Floor Number:</strong> {{ $personalInfo->floor_number ?? 'N/A' }}</p>
        </div>
    </div>

    <a href="{{ route('personal.report.edit', $personalInfo->id) }}"
        class="inline-flex items-center px-4 py-2 mt-6 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition">
        Edit Personal Information
    </a>
@else
    <div class="text-center">
        <a href="{{ route('personal.report.create') }}"
           class="inline-flex items-center px-6 py-3 bg-blue-600 text-white text-lg font-medium rounded-lg hover:bg-blue-700 transition duration-150">
            Fill Personal Information
        </a>
    </div>
@endif


            </div>
        </div>


        {{-- Claimed and Approved Damages --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Claimed Damages Section -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-gray-900">Claimed Damages</h2>
                    @if($report)
                        <a href="{{ route('damage.report.addDamages', $report->id) }}"
                        class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                            Add Damage
                        </a>
                    @endif
                </div>

                @if($damages->isEmpty())
                    <p class="text-sm text-gray-500">No damages added yet. Click "Add Damage" to report one.</p>
                @else
                    <ul class="space-y-4">
                        @foreach($damages as $damage)
                            @if($damage->status === 'pending')
                                <li class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <h3 class="text-lg font-medium text-gray-900">{{ $damage->type }}</h3>
                                            <p class="text-sm text-gray-500">{{ $damage->description }}</p>
                                        </div>
                                        <a href="{{ route('damage.view', $damage->id) }}"
                                           class="inline-flex items-center px-3 py-1 bg-blue-600 text-white text-sm font-medium rounded hover:bg-blue-700">
                                            View
                                        </a>
                                        @if ($damage->status === 'pending')
                                            <span class="inline-block bg-yellow-200 text-yellow-800 text-xs font-semibold px-2 py-1 rounded-full">
                                                   Pending
                                            </span>
                                        @else
                                            <span class="inline-block bg-green-200 text-green-800 text-xs font-semibold px-2 py-1 rounded-full">
                                                {{ ucfirst($damage->status) }}
                                            </span>
                                        @endif
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                @endif
            </div>

           <div class="bg-white rounded-lg shadow">
    <div class="border-b border-gray-200">
        <div class="p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-6">Approved Damages</h2>

            @php
                $hasApproved = false;
            @endphp

            @if($damages->isEmpty())
                <p class="text-sm text-gray-500">No damages added yet. Click "Add Damage" to report one.</p>
            @else
                <ul class="space-y-4">
                    @foreach($damages as $damage)
                        @if($damage->status === 'accepted')
                            @php $hasApproved = true; @endphp
                                <li class="bg-gray-50 p-4 rounded-lg border border-gray-200">
    <div class="flex justify-between items-start gap-4">
        {{-- Left Side: Type & Description --}}
        <div class="flex-1">
            <h3 class="text-lg font-medium text-gray-900">{{ $damage->type }}</h3>
            <p class="text-sm text-gray-500">{{ $damage->description }}</p>
        </div>

        {{-- Right Side: View Button + Status on same row --}}
        <div class="flex items-center gap-2 whitespace-nowrap">
            <a href="{{ route('damage.view', $damage->id) }}"
               class="inline-flex items-center px-3 py-1 bg-blue-600 text-white text-sm font-medium rounded hover:bg-blue-700">
                View
            </a>

            @php $status = $damage->status ?? 'pending'; @endphp

            @if ($status === 'pending')
                <span class="inline-block bg-yellow-200 text-yellow-800 text-xs font-semibold px-2 py-1 rounded-full">
                    Pending Approval
                </span>
            @elseif ($status === 'accepted')
                <span class="inline-block bg-green-200 text-green-800 text-xs font-semibold px-2 py-1 rounded-full">
                    Accepted
                </span>
            @elseif ($status === 'rejected' || $status === 'declined')
                <span class="inline-block bg-red-200 text-red-800 text-xs font-semibold px-2 py-1 rounded-full">
                    Rejected
                </span>
            @else
                <span class="inline-block bg-gray-200 text-gray-800 text-xs font-semibold px-2 py-1 rounded-full">
                    {{ ucfirst($status) }}
                </span>
            @endif
        </div>
    </div>
</li>


                        @endif
                    @endforeach
                </ul>
            @endif
        </div>

        @unless($hasApproved)
            <div class="p-6 text-gray-500 text-sm">No approved damages yet.</div>
        @endunless
    </div>
</div>



        </div>
    </div>
</div>
@endsection
