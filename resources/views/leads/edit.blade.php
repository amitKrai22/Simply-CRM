@extends('layouts.app')

@section('content')
    <div class="max-w-xl mx-auto bg-white p-6 shadow-md rounded">
        <h2 class="text-xl font-bold mb-4 text-gray-800">Edit Lead</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('leads.update', $lead->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium">Name</label>
                <input type="text" name="name" value="{{ old('name', $lead->name) }}" required
                       class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-300" />
            </div>

            <div>
                <label class="block text-sm font-medium">Email</label>
                <input type="email" name="email" value="{{ old('email', $lead->email) }}"
                       class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-300" />
            </div>

            <div>
                <label class="block text-sm font-medium">Phone</label>
                <input type="text" name="phone" value="{{ old('phone', $lead->phone) }}"
                       class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-300" />
            </div>

            <div>
                <label class="block text-sm font-medium">Status</label>
                <select name="status"
                        class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-300">
                    <option value="New" {{ $lead->status === 'New' ? 'selected' : '' }}>New</option>
                    <option value="Contacted" {{ $lead->status === 'Contacted' ? 'selected' : '' }}>Contacted</option>
                    <option value="Converted" {{ $lead->status === 'Converted' ? 'selected' : '' }}>Converted</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium">Note</label>
                <textarea name="note" rows="3"
                          class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-300">{{ old('note', $lead->note) }}</textarea>
            </div>

            <div class="flex justify-between items-center">
                <a href="{{ route('leads.index') }}" class="text-sm text-blue-600 hover:underline">← Back to list</a>
                <button type="submit"
                        class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
                    Update Lead
                </button>
            </div>
        </form>
    </div>
@endsection
