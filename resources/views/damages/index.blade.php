@extends('admin.main')

@section('title', 'Damage Reports')
@section('header', 'Damage Reports')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">Damage Reports</h2>
        <p class="text-gray-600">View and manage all damage documentation</p>
    </div>
    <a href="{{ route('admin.damage-reports.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">
        <i class="fas fa-plus mr-2"></i> Add New Report
    </a>
</div>

<!-- Search and Filter -->
<div class="bg-white rounded-lg shadow-md p-4 mb-6">
    <form action="{{ route('admin.damage-reports') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div>
            <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search</label>
            <input type="text" name="search" id="search" value="{{ request('search') }}" 
                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" 
                   placeholder="Location or notes...">
        </div>
        
        <div>
            <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Damage Type</label>
            <select name="type" id="type" 
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <option value="">All Types</option>
                @foreach($damageTypes as $type)
                    <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>
                        {{ $type }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <div>
            <label for="date" class="block text-sm font-medium text-gray-700 mb-1">Date Range</label>
            <select name="date" id="date" 
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <option value="">All Time</option>
                <option value="today" {{ request('date') == 'today' ? 'selected' : '' }}>Today</option>
                <option value="week" {{ request('date') == 'week' ? 'selected' : '' }}>This Week</option>
                <option value="month" {{ request('date') == 'month' ? 'selected' : '' }}>This Month</option>
                <option value="year" {{ request('date') == 'year' ? 'selected' : '' }}>This Year</option>
            </select>
        </div>
        
        <div class="flex items-end">
            <button type="submit" class="px-4 py-2 bg-gray-100 text-gray-800 rounded-md hover:bg-gray-200 transition mr-2">
                <i class="fas fa-filter mr-2"></i> Filter
            </button>
            
            <a href="{{ route('admin.damage-reports') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition">
                <i class="fas fa-redo mr-2"></i> Reset
            </a>
        </div>
    </form>
</div>

<!-- Toggle Between Grid and List View -->
<div class="flex mb-4">
    <button id="gridViewBtn" class="px-4 py-2 bg-indigo-600 text-white rounded-l-md">
        <i class="fas fa-th-large"></i> Grid
    </button>
    <button id="listViewBtn" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-r-md">
        <i class="fas fa-list"></i> List
    </button>
</div>

<!-- Grid View (Default) -->
<div id="gridView" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($damageReports as $report)
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="aspect-w-16 aspect-h-9 bg-gray-200">
            @if(count($report->images) > 0)
                <img src="{{ asset('storage/' . $report->images[0]->image) }}" 
                     alt="Damage image" 
                     class="w-full h-48 object-cover">
            @else
                <div class="w-full h-48 flex items-center justify-center bg-gray-100">
                    <i class="fas fa-image text-gray-400 text-4xl"></i>
                </div>
            @endif
        </div>
        <div class="p-4">
            <div class="flex justify-between items-start mb-2">
                <h3 class="text-lg font-semibold text-gray-800">{{ $report->location }}</h3>
                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                    {{ $report->type }}
                </span>
            </div>
            <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ $report->notes }}</p>
            <div class="flex justify-between items-center text-sm text-gray-500">
                <div class="flex items-center">
                    <img class="h-6 w-6 rounded-full mr-2" 
                         src="https://ui-avatars.com/api/?name={{ urlencode($report->user->name) }}&color=7F9CF5&background=EBF4FF" 
                         alt="{{ $report->user->name }}">
                    <span>{{ $report->user->name }}</span>
                </div>
                <span>{{ $report->created_at->format('M d, Y') }}</span>
            </div>
        </div>
        <div class="px-4 py-3 bg-gray-50 border-t flex justify-between">
            <a href="{{ route('admin.damage-reports.show', $report->id) }}" class="text-indigo-600 hover:text-indigo-900">
                View Details
            </a>
            <div class="flex space-x-2">
                <a href="{{ route('admin.damage-reports.edit', $report->id) }}" class="text-amber-600 hover:text-amber-900">
                    <i class="fas fa-edit"></i>
                </a>
                <button type="button" 
                        onclick="confirmDelete('{{ $report->id }}')" 
                        class="text-red-600 hover:text-red-900">
                    <i class="fas fa-trash"></i>
                </button>
                <form id="delete-form-{{ $report->id }}" 
                      action="{{ route('admin.damage-reports.destroy', $report->id) }}" 
                      method="POST" 
                      style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="col-span-full text-center py-8 bg-white rounded-lg shadow">
        <i class="fas fa-folder-open text-gray-400 text-4xl mb-3"></i>
        <p class="text-gray-500">No damage reports found</p>
    </div>
    @endforelse
</div>

<!-- List View (Hidden by Default) -->
<div id="listView" class="bg-white rounded-lg shadow-md overflow-hidden hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Reported By</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($damageReports as $report)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $report->id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $report->location }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                            {{ $report->type }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <img class="h-6 w-6 rounded-full mr-2" 
                                 src="https://ui-avatars.com/api/?name={{ urlencode($report->user->name) }}&color=7F9CF5&background=EBF4FF" 
                                 alt="{{ $report->user->name }}">
                            <span class="text-sm text-gray-900">{{ $report->user->name }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $report->created_at->format('M d, Y') }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-3">
                            <a href="{{ route('admin.damage-reports.show', $report->id) }}" class="text-indigo-600 hover:text-indigo-900">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.damage-reports.edit', $report->id) }}" class="text-amber-600 hover:text-amber-900">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button type="button" 
                                    onclick="confirmDelete('{{ $report->id }}')" 
                                    class="text-red-600 hover:text-red-900">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
                        No damage reports found
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Pagination -->
<div class="mt-6">
    {{ $damageReports->links() }}
</div>

@endsection

@push('scripts')
<script>
    // Toggle between Grid and List view
    document.addEventListener('DOMContentLoaded', function() {
        const gridViewBtn = document.getElementById('gridViewBtn');
        const listViewBtn = document.getElementById('listViewBtn');
        const gridView = document.getElementById('gridView');
        const listView = document.getElementById('listView');
        
        gridViewBtn.addEventListener('click', function() {
            gridViewBtn.classList.add('bg-indigo-600', 'text-white');
            gridViewBtn.classList.remove('bg-gray-200', 'text-gray-800');
            
            listViewBtn.classList.add('bg-gray-200', 'text-gray-800');
            listViewBtn.classList.remove('bg-indigo-600', 'text-white');
            
            gridView.classList.remove('hidden');
            listView.classList.add('hidden');
        });
        
        listViewBtn.addEventListener('click', function() {
            listViewBtn.classList.add('bg-indigo-600', 'text-white');
            listViewBtn.classList.remove('bg-gray-200', 'text-gray-800');
            
            gridViewBtn.classList.add('bg-gray-200', 'text-gray-800');
            gridViewBtn.classList.remove('bg-indigo-600', 'text-white');
            
            listView.classList.remove('hidden');
            gridView.classList.add('hidden');
        });
    });
    
    // Delete confirmation
    function confirmDelete(id) {
        if (confirm('Are you sure you want to delete this damage report?')) {
            document.getElementById('delete-form-' + id).submit();
        }
    }
</script>
@endpush