@extends('layout.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-2xl font-semibold mb-6">Submit Damage Report</h2>

        <form action="{{ route('damage.report.storeDamages', ['id' => $report->id]) }}" method="POST" enctype="multipart/form-data">

            @csrf

            {{-- Damage Items --}}
            <div class="mb-6">
                <h3 class="text-lg font-medium mb-2">Damage Details</h3>

                <div id="damages-container" class="space-y-4">
                    <div class="border p-4 rounded-md bg-gray-50">
                        <label class="block text-sm font-medium text-gray-700">Damage Name</label>
                        <input type="text" name="damages[0][name]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>

                        <label class="block text-sm font-medium text-gray-700 mt-2">Description</label>
                        <textarea name="damages[0][description]" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required></textarea>

                        <label class="block text-sm font-medium text-gray-700 mt-2">Images</label>
                        <input type="file" name="damages[0][images][]" multiple class="mt-1 block w-full">
                    </div>
                </div>

                
            </div>

            {{-- Report Date --}}
            <div class="mb-6">
                <label for="report_date" class="block text-sm font-medium text-gray-700">Report Date</label>
                <input type="date" name="report_date" id="report_date" value="{{ date('Y-m-d') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
            </div>

            <div class="mt-6">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Submit Report</button>
            </div>
        </form>
    </div>
</div>

<script>
    let damageIndex = 1;
    document.getElementById('add-damage').addEventListener('click', () => {
        const container = document.getElementById('damages-container');
        const damageHtml = `
        <div class="border p-4 rounded-md bg-gray-50">
            <label class="block text-sm font-medium text-gray-700">Damage Name</label>
            <input type="text" name="damages[${damageIndex}][name]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>

            <label class="block text-sm font-medium text-gray-700 mt-2">Description</label>
            <textarea name="damages[${damageIndex}][description]" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required></textarea>

            <label class="block text-sm font-medium text-gray-700 mt-2">Images</label>
            <input type="file" name="damages[${damageIndex}][images][]" multiple class="mt-1 block w-full">
        </div>
        `;
        container.insertAdjacentHTML('beforeend', damageHtml);
        damageIndex++;
    });
</script>
@endsection