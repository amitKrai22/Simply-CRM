@extends('layouts.app')

@section('content')
    <form method="GET" action="{{ route('contacts.index') }}" class="mb-6 flex items-center gap-2">
    <input type="text" name="search" value="{{ request('search') }}"
           placeholder="Search contacts..."
           class="px-4 py-2 border rounded w-72 focus:outline-none focus:ring-2 focus:ring-blue-300" />
    <button type="submit"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
        Search
    </button>
    @if(request('search'))
        <a href="{{ route('contacts.index') }}"
           class="text-sm text-red-500 underline ml-2">Clear</a>
    @endif
</form>

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">My Contacts</h2>
        <a href="{{ route('contacts.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            + Add Contact
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($contacts->isEmpty())
        <p class="text-gray-600">No contacts found.</p>
    @else
        <div class="overflow-x-auto bg-white shadow rounded">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="text-left px-4 py-2 text-sm font-medium text-gray-700">Name</th>
                        <th class="text-left px-4 py-2 text-sm font-medium text-gray-700">Email</th>
                        <th class="text-left px-4 py-2 text-sm font-medium text-gray-700">Phone</th>
                        <th class="text-left px-4 py-2 text-sm font-medium text-gray-700">Note</th>
                        <th class="text-left px-4 py-2 text-sm font-medium text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ($contacts as $contact)
                        <tr>
                            <td class="px-4 py-2">{{ $contact->name }}</td>
                            <td class="px-4 py-2">{{ $contact->email }}</td>
                            <td class="px-4 py-2">{{ $contact->phone }}</td>
                            <td class="px-4 py-2">{{ $contact->note }}</td>
                            <td class="px-4 py-2 space-x-2">
                                <a href="{{ route('contacts.edit', $contact->id) }}"
                                   class="text-blue-600 hover:underline">Edit</a>
                                <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" class="inline"
                                      onsubmit="return confirm('Are you sure you want to delete this contact?');">
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
    {{ $contacts->withQueryString()->links() }}
</div>

        </div>
    @endif
@endsection

