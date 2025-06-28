@extends('layout.app')

@section('title', 'Admin Dashboard - Users')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">All Users</h1>

    @if($users->isEmpty())
        <p>No users found.</p>
    @else
        <table class="min-w-full bg-white rounded shadow">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b border-gray-300 text-left">ID</th>
                    <th class="py-2 px-4 border-b border-gray-300 text-left">Name</th>
                    <th class="py-2 px-4 border-b border-gray-300 text-left">Email</th>
                    <th class="py-2 px-4 border-b border-gray-300 text-left">Created At</th>
                    <th class="py-2 px-4 border-b border-gray-300 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td class="py-2 px-4 border-b border-gray-300 text-left">{{ $user->id }}</td>
                    <td class="py-2 px-4 border-b border-gray-300 text-left">{{ $user->name }}</td>
                    <td class="py-2 px-4 border-b border-gray-300 text-left">{{ $user->email }}</td>
                    <td class="py-2 px-4 border-b border-gray-300 text-left">
                        {{ $user->created_at ? $user->created_at->format('Y-m-d') : 'N/A' }}
                    </td>
                    <td class="py-2 px-4 border-b border-gray-300 text-left">
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 text-sm">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
