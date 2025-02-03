@extends('layout.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
        <div class="md:col-span-3">
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-semibold mb-4">Quick Actions</h2>
                <div class="space-y-3">
                    <a href="{{route('damages.create')}}" class="block w-full text-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-150">
                        Document New Damage
                    </a>
                    <a href="{{route('appointments.create')}}" class="block w-full text-center px-4 py-2 border border-blue-600 text-blue-600 rounded-lg hover:bg-blue-50 transition duration-150">
                        Schedule Appointment
                    </a>
                </div>
            </div>
        </div>

        <div class="md:col-span-9">
            <div class="bg-white rounded-lg shadow">
                <div class="border-b border-gray-200">
                    <div class="p-6">
                        <h2 class="text-xl font-semibold">Your Damage Reports</h2>
                        <p class="text-gray-500 mt-1">Documentation of property damages</p>
                    </div>
                </div>
                
                <div class="p-6">
                    @if($damages->isEmpty())
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No damage reports</h3>
                            <p class="mt-1 text-sm text-gray-500">Get started by creating a new damage report.</p>
                            <div class="mt-6">
                                <a href="{{route('damages.create')}}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                    <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                    New Damage Report
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="space-y-6">
                            @foreach($damages as $damage)
                            <div class="bg-gray-50 rounded-lg p-6 relative">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="text-lg font-medium text-gray-900">{{ $damage->type }}</h3>
                                        <p class="mt-1 text-sm text-gray-500">Location: {{ $damage->location }}</p>
                                        @if($damage->notes)
                                            <p class="mt-2 text-sm text-gray-700">{{ $damage->notes }}</p>
                                        @endif
                                    </div>
                                    <div class="flex space-x-2">
                                        <a href="{{ route('damages.edit', $damage->id) }}" class="text-blue-600 hover:text-blue-800">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                <path fill-rule="evenodd" d="M2 16V4a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1h-2V4h-4l-2-2H4v12h12v-1h2v1a2 2 0 01-2 2H4a2 2 0 01-2-2z" clip-rule="evenodd" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('damages.destroy', $damage->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this damage report?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                
                                @if($damage->damage_image->isNotEmpty())
                                    <div class="mt-4">
                                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                            @foreach($damage->damage_image as $image)
                                                <div class="relative group">
                                                    <img src="{{ Storage::url($image->image) }}" alt="Damage Image" class="h-32 w-full object-cover rounded-lg">
                                                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-opacity duration-200 rounded-lg"></div>
                                                    <div class="absolute top-2 right-2 flex space-x-2">
                                                        <form action="{{ route('damages.images.destroy', $image->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this image?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="bg-red-500 text-white p-1 rounded-full hover:bg-red-600">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                                </svg>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                <div class="mt-4">
                                    <a href="{{ route('damages.addimages', $damage->id) }}" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
                                        <svg class="-ml-0.5 mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                        </svg>
                                        Add Images
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection