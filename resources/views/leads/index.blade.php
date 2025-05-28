@extends('layouts.app')

@section('content')
    <form method="GET" action="{{ route('leads.index') }}" class="mb-6 flex flex-wrap gap-3 items-center">
    <!-- Search input -->
    <input type="text" name="search" value="{{ request('search') }}"
           placeholder="Search leads..."
           class="px-4 py-2 border rounded w-64 focus:outline-none focus:ring-2 focus:ring-blue-300" />

    <!-- Status dropdown -->
    <select name="status" class="px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-300">
        <option value="">All Status</option>
        <option value="New" {{ request('status') == 'New' ? 'selected' : '' }}>New</option>
        <option value="Contacted" {{ request('status') == 'Contacted' ? 'selected' : '' }}>Contacted</option>
        <option value="Converted" {{ request('status') == 'Converted' ? 'selected' : '' }}>Converted</option>
    </select>

    <!-- Submit -->
    <button type="submit"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
        Filter
    </button>

    <!-- Reset -->
    @if(request()->filled('search') || request()->filled('status'))
        <a href="{{ route('leads.index') }}" class="text-sm text-red-500 underline">Clear</a>
    @endif
</form>

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Leads</h2>
        <a href="{{ route('leads.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            + Add Lead
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($leads->isEmpty())
        <p class="text-gray-600">No leads found.</p>
    @else
        <div class="overflow-x-auto bg-white shadow rounded">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Name</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Email</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Phone</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Status</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Note</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ($leads as $lead)
                        <tr>
                            <td class="px-4 py-2">{{ $lead->name }}</td>
                            <td class="px-4 py-2">{{ $lead->email }}</td>
                            <td class="px-4 py-2">{{ $lead->phone }}</td>
                            <td class="px-4 py-2">
                                @php
                                    $status = strtolower($lead->status);
                                    $badgeClass = match($status) {
                                        'new' => 'bg-blue-100 text-blue-700',
                                        'contacted' => 'bg-yellow-100 text-yellow-700',
                                        'converted' => 'bg-green-100 text-green-700',
                                        default => 'bg-gray-100 text-gray-700',
                                    };
                                @endphp

                                <span class="inline-block text-xs px-2 py-1 rounded {{ $badgeClass }}">
                                    {{ ucfirst($lead->status) }}
                                </span>

                            </td>
                            <td class="px-4 py-2">{{ $lead->note }}</td>
                            <td class="px-4 py-2 space-x-2">
                                <a href="{{ route('leads.edit', $lead->id) }}"
                                   class="text-blue-600 hover:underline">Edit</a>
                                <form action="{{ route('leads.destroy', $lead->id) }}" method="POST" class="inline"
                                      onsubmit="return confirm('Are you sure you want to delete this lead?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-6">
    {{ $leads->withQueryString()->links() }}
</div>

        </div>
    @endif
@endsection
