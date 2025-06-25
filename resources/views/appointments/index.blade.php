@extends('admin.main')

@section('title', 'Appointments Management')
@section('header', 'Appointments Management')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">Appointments</h2>
        <p class="text-gray-600">Manage all service appointments</p>
    </div>
    <a href="{{ route('admin.appointments.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">
        <i class="fas fa-plus mr-2"></i> Schedule Appointment
    </a>
</div>

<!-- Search and Filter -->
<div class="bg-white rounded-lg shadow-md p-4 mb-6">
    <form action="{{ route('admin.appointments') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div>
            <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search</label>
            <input type="text" name="search" id="search" value="{{ request('search') }}" 
                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" 
                   placeholder="Search appointments...">
        </div>
        
        <div>
            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
            <select name="status" id="status" 
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <option value="">All Statuses</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="accepted" {{ request('status') == 'accepted' ? 'selected' : '' }}>Accepted</option>
                <option value="declined" {{ request('status') == 'declined' ? 'selected' : '' }}>Declined</option>
            </select>
        </div>
        
        <div>
            <label for="date_range" class="block text-sm font-medium text-gray-700 mb-1">Date Range</label>
            <select name="date_range" id="date_range" 
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <option value="">All Dates</option>
                <option value="today" {{ request('date_range') == 'today' ? 'selected' : '' }}>Today</option>
                <option value="tomorrow" {{ request('date_range') == 'tomorrow' ? 'selected' : '' }}>Tomorrow</option>
                <option value="this_week" {{ request('date_range') == 'this_week' ? 'selected' : '' }}>This Week</option>
                <option value="next_week" {{ request('date_range') == 'next_week' ? 'selected' : '' }}>Next Week</option>
                <option value="this_month" {{ request('date_range') == 'this_month' ? 'selected' : '' }}>This Month</option>
            </select>
        </div>
        
        <div class="flex items-end">
            <button type="submit" class="px-4 py-2 bg-gray-100 text-gray-800 rounded-md hover:bg-gray-200 transition mr-2">
                <i class="fas fa-filter mr-2"></i> Filter
            </button>
            
            <a href="{{ route('admin.appointments') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition">
                <i class="fas fa-redo mr-2"></i> Reset
            </a>
        </div>
    </form>
</div>

<!-- Calendar View Toggle -->
<div class="bg-white rounded-lg shadow-md p-4 mb-6">
    <div class="flex items-center justify-between">
        <div class="flex space-x-4">
            <button id="listViewBtn" class="px-4 py-2 bg-indigo-600 text-white rounded-md">
                <i class="fas fa-list mr-2"></i> List View
            </button>
            <button id="calendarViewBtn" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md">
                <i class="fas fa-calendar-alt mr-2"></i> Calendar View
            </button>
        </div>
        
        <div class="flex space-x-2">
            <button id="prevBtn" class="p-2 bg-gray-100 text-gray-800 rounded-md hover:bg-gray-200">
                <i class="fas fa-chevron-left"></i>
            </button>
            <span id="currentDateRange" class="p-2 font-medium">March 2025</span>
            <button id="nextBtn" class="p-2 bg-gray-100 text-gray-800 rounded-md hover:bg-gray-200">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </div>
</div>

<!-- List View (Default) -->
<div id="listView" class="bg-white rounded-lg shadow-md overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Homeowner</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Provider</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Service</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date & Time</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($appointments as $appointment)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $appointment->id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-8 w-8">
                                <img class="h-8 w-8 rounded-full" 
                                     src="https://ui-avatars.com/api/?name={{ urlencode($appointment->homeowner->name) }}&color=7F9CF5&background=EBF4FF" 
                                     alt="{{ $appointment->homeowner->name }}">
                            </div>
                            <div class="ml-3">
                                <div class="text-sm font-medium text-gray-900">{{ $appointment->homeowner->name }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-8 w-8">
                                <img class="h-8 w-8 rounded-full" 
                                     src="https://ui-avatars.com/api/?name={{ urlencode($appointment->provider->name) }}&color=7F9CF5&background=EBF4FF" 
                                     alt="{{ $appointment->provider->name }}">
                            </div>
                            <div class="ml-3">
                                <div class="text-sm font-medium text-gray-900">{{ $appointment->provider->name }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $appointment->service->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $appointment->appointment_time->format('M d, Y H:i') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($appointment->status == 'pending')
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                Pending
                            </span>
                        @elseif($appointment->status == 'accepted')
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Accepted
                            </span>
                        @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                Declined
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.appointments.show', $appointment->id) }}" class="text-indigo-600 hover:text-indigo-900">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.appointments.edit', $appointment->id) }}" class="text-amber-600 hover:text-amber-900">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button type="button" 
                                    onclick="confirmDelete('{{ $appointment->id }}')" 
                                    class="text-red-600 hover:text-red-900">
                                <i class="fas fa-trash"></i>
                            </button>
                            <form id="delete-form-{{ $appointment->id }}" 
                                  action="{{ route('admin.appointments.destroy', $appointment->id) }}" 
                                  method="POST" 
                                  style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                        No appointments found
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-4 py-3 bg-gray-50 border-t border-gray-200">
        {{ $appointments->withQueryString()->links() }}
    </div>
</div>

<!-- Calendar View (Hidden by Default) -->
<div id="calendarView" class="bg-white rounded-lg shadow-md p-4 hidden">
    <div class="grid grid-cols-7 gap-2 mb-2">
        <div class="text-center font-medium text-gray-500">Sun</div>
        <div class="text-center font-medium text-gray-500">Mon</div>
        <div class="text-center font-medium text-gray-500">Tue</div>
        <div class="text-center font-medium text-gray-500">Wed</div>
        <div class="text-center font-medium text-gray-500">Thu</div>
        <div class="text-center font-medium text-gray-500">Fri</div>
        <div class="text-center font-medium text-gray-500">Sat</div>
    </div>
    <div id="calendarDays" class="grid grid-cols-7 gap-2">
        <!-- Calendar days will be populated by JavaScript -->
    </div>
</div>

<!-- Appointment Details Modal -->
<div id="appointmentModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-lg mx-4">
        <div class="p-4 border-b">
            <div class="flex justify-between items-center">
                <h3 class="font-semibold text-lg" id="modalTitle">Appointment Details</h3>
                <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="p-4" id="modalContent">
            <!-- Modal content will be populated by JavaScript -->
        </div>
        <div class="p-4 border-t flex justify-end space-x-2">
            <a id="editAppointmentBtn" href="#" class="px-4 py-2 bg-amber-500 text-white rounded-md hover:bg-amber-600 transition">
                <i class="fas fa-edit mr-2"></i> Edit
            </a>
            <button onclick="closeModal()" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition">
                Close
            </button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Toggle between list and calendar views
    document.getElementById('listViewBtn').addEventListener('click', function() {
        document.getElementById('listView').classList.remove('hidden');
        document.getElementById('calendarView').classList.add('hidden');
        this.classList.remove('bg-gray-200', 'text-gray-800');
        this.classList.add('bg-indigo-600', 'text-white');
        document.getElementById('calendarViewBtn').classList.remove('bg-indigo-600', 'text-white');
        document.getElementById('calendarViewBtn').classList.add('bg-gray-200', 'text-gray-800');
    });
    
    document.getElementById('calendarViewBtn').addEventListener('click', function() {
        document.getElementById('calendarView').classList.remove('hidden');
        document.getElementById('listView').classList.add('hidden');
        this.classList.remove('bg-gray-200', 'text-gray-800');
        this.classList.add('bg-indigo-600', 'text-white');
        document.getElementById('listViewBtn').classList.remove('bg-indigo-600', 'text-white');
        document.getElementById('listViewBtn').classList.add('bg-gray-200', 'text-gray-800');
        renderCalendar();
    });
    
    // Calendar functionality
    let currentDate = new Date();
    
    document.getElementById('prevBtn').addEventListener('click', function() {
        currentDate.setMonth(currentDate.getMonth() - 1);
        updateCalendarHeader();
        renderCalendar();
    });
    
    document.getElementById('nextBtn').addEventListener('click', function() {
        currentDate.setMonth(currentDate.getMonth() + 1);
        updateCalendarHeader();
        renderCalendar();
    });
    
    function updateCalendarHeader() {
        const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        document.getElementById('currentDateRange').textContent = `${months[currentDate.getMonth()]} ${currentDate.getFullYear()}`;
    }
    
    function renderCalendar() {
        const calendarDays = document.getElementById('calendarDays');
        calendarDays.innerHTML = '';
        
        const year = currentDate.getFullYear();
        const month = currentDate.getMonth();
        
        // First day of the month
        const firstDay = new Date(year, month, 1);
        // Last day of the month
        const lastDay = new Date(year, month + 1, 0);
        
        // Days from previous month
        const daysBeforeFirstDay = firstDay.getDay();
        for (let i = 0; i < daysBeforeFirstDay; i++) {
            const dayElement = document.createElement('div');
            dayElement.className = 'h-24 border rounded-md bg-gray-50 p-1';
            calendarDays.appendChild(dayElement);
        }
        
        // Days of current month
        const appointments = {!! json_encode($calendarAppointments ?? []) !!};
        
        for (let day = 1; day <= lastDay.getDate(); day++) {
            const dayElement = document.createElement('div');
            dayElement.className = 'h-24 border rounded-md p-1 relative bg-white overflow-y-auto';
            
            // Add day number
            const dayHeader = document.createElement('div');
            dayHeader.className = 'text-right text-sm font-medium mb-1';
            dayHeader.textContent = day;
            dayElement.appendChild(dayHeader);
            
            // Check if there are appointments for this day
            const dateString = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
            if (appointments[dateString]) {
                appointments[dateString].forEach(appointment => {
                    const appointmentElement = document.createElement('div');
                    appointmentElement.className = `text-xs p-1 mb-1 rounded truncate ${getStatusColor(appointment.status)}`;
                    appointmentElement.textContent = appointment.time + ' - ' + appointment.service;
                    appointmentElement.setAttribute('data-id', appointment.id);
                    appointmentElement.addEventListener('click', function() {
                        showAppointmentDetails(appointment.id);
                    });
                    dayElement.appendChild(appointmentElement);
                });
            }
            
            calendarDays.appendChild(dayElement);
        }
        
        // Days from next month to fill the grid
        const totalDaysShown = daysBeforeFirstDay + lastDay.getDate();
        const daysToAdd = totalDaysShown % 7 === 0 ? 0 : 7 - (totalDaysShown % 7);
        
        for (let i = 0; i < daysToAdd; i++) {
            const dayElement = document.createElement('div');
            dayElement.className = 'h-24 border rounded-md bg-gray-50 p-1';
            calendarDays.appendChild(dayElement);
        }
    }
    
    function getStatusColor(status) {
        switch (status) {
            case 'pending':
                return 'bg-yellow-100 text-yellow-800';
            case 'accepted':
                return 'bg-green-100 text-green-800';
            case 'declined':
                return 'bg-red-100 text-red-800';
            default:
                return 'bg-gray-100 text-gray-800';
        }
    }
    
    function showAppointmentDetails(appointmentId) {
        // In a real application, you would fetch the appointment details via AJAX
        // For now, we'll just use a mock example
        document.getElementById('modalTitle').textContent = 'Appointment Details #' + appointmentId;
        document.getElementById('editAppointmentBtn').href = `{{ route('admin.appointments.edit', '') }}/${appointmentId}`;
        
        // Populate modal content (this would be done with real data in production)
        document.getElementById('modalContent').innerHTML = `
            <div class="space-y-4">
                <div>
                    <h4 class="text-sm font-medium text-gray-500">Homeowner</h4>
                    <p class="text-gray-900">John Doe</p>
                </div>
                <div>
                    <h4 class="text-sm font-medium text-gray-500">Service Provider</h4>
                    <p class="text-gray-900">Jane Smith</p>
                </div>
                <div>
                    <h4 class="text-sm font-medium text-gray-500">Service</h4>
                    <p class="text-gray-900">Plumbing Repair</p>
                </div>
                <div>
                    <h4 class="text-sm font-medium text-gray-500">Date & Time</h4>
                    <p class="text-gray-900">March 15, 2025 at 10:00 AM</p>
                </div>
                <div>
                    <h4 class="text-sm font-medium text-gray-500">Status</h4>
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                        Pending
                    </span>
                </div>
                <div>
                    <h4 class="text-sm font-medium text-gray-500">Notes</h4>
                    <p class="text-gray-900">Kitchen sink is clogged and needs repair.</p>
                </div>
            </div>
        `;
        
        document.getElementById('appointmentModal').classList.remove('hidden');
    }
    
    function closeModal() {
        document.getElementById('appointmentModal').classList.add('hidden');
    }
    
    function confirmDelete(appointmentId) {
        if (confirm('Are you sure you want to delete this appointment? This action cannot be undone.')) {
            document.getElementById('delete-form-' + appointmentId).submit();
        }
    }
    
    // Initialize calendar header
    updateCalendarHeader();
</script>
@endpush