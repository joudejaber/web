@extends('layout.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100">
    <!-- Back Navigation -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pt-8">
        <a href="{{ route('dashboard') }}" 
           class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium transition-colors group">
            <svg class="w-5 h-5 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Dashboard
        </a>
    </div>

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden">
            <!-- Header Section -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-8 py-10">
                <div class="text-center">
                    <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.464 0L4.35 16.5c-.77.833.192 2.5 1.732 2.5z" />
                        </svg>
                    </div>
                    <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">Submit Damage Report</h1>
                    <p class="text-blue-100 text-lg">Document damages and submit for review</p>
                </div>
            </div>

            <!-- Form Section -->
            <div class="p-8">
                <form action="{{ route('damage.report.storeDamages', ['id' => $report->id]) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf

                    <!-- Damage Details Section -->
                    <div class="space-y-6">
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.464 0L4.35 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">Damage Details</h3>
                        </div>

                        <div id="damages-container" class="space-y-6">
                            <div class="bg-gray-50 border border-gray-200 p-6 rounded-xl">
                                <div class="space-y-4">
                                    <div class="space-y-2">
                                        <label class="block text-sm font-semibold text-gray-700">Damage Name</label>
                                        <input type="text" 
                                               name="damages[0][name]" 
                                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors bg-white" 
                                               required>
                                    </div>

                                    <div class="space-y-2">
                                        <label class="block text-sm font-semibold text-gray-700">Description</label>
                                        <textarea name="damages[0][description]" 
                                                  rows="3" 
                                                  class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors bg-white" 
                                                  required></textarea>
                                    </div>

                                    <div class="space-y-2">
                                        <label class="block text-sm font-semibold text-gray-700">Images</label>
                                        <div class="relative">
                                            <input type="file" 
                                                   name="damages[0][images][]" 
                                                   multiple 
                                                   accept="image/*"
                                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors bg-white file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                        </div>
                                        <p class="text-xs text-gray-500">Upload multiple images to document the damage</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Report Date Section -->
                    <div class="space-y-6">
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">Report Information</h3>
                        </div>

                        <div class="space-y-2">
                            <label for="report_date" class="block text-sm font-semibold text-gray-700">Report Date</label>
                            <input type="date" 
                                   name="report_date" 
                                   id="report_date" 
                                   value="{{ date('Y-m-d') }}" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors bg-gray-50 focus:bg-white" 
                                   required>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                        <button type="submit" 
                                class="flex-1 sm:flex-none px-8 py-4 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-blue-800 focus:ring-4 focus:ring-blue-300 transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl">
                            <div class="flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                </svg>
                                Submit Report
                            </div>
                        </button>
                        
                        <a href="{{ route('dashboard') }}" 
                           class="flex-1 sm:flex-none px-8 py-4 bg-gray-100 text-gray-700 font-semibold rounded-xl hover:bg-gray-200 focus:ring-4 focus:ring-gray-300 transition-all duration-200 text-center">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Script removed - single damage entry only
</script>
@endsection