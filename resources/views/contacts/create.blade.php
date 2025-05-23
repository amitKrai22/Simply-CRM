@extends('layouts.app')

@section('content')
    <div class="max-w-xl mx-auto bg-white p-6 shadow-md rounded">
        <h2 class="text-xl font-bold mb-4 text-gray-800">Add New Contact</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('contacts.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium">Name</label>
                <input type="text" name="name" value="{{ old('name') }}"
                    class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-300" required>
            </div>

            <div>
                <label class="block text-sm font-medium">Email</label>
                <input type="email" name="email" value="{{ old('email') }}"
                    class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-300">
            </div>

            <div>
                <label class="block text-sm font-medium">Phone</label>
                <input type="text" name="phone" value="{{ old('phone') }}"
                    class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-300">
            </div>

            <div>
                <label class="block text-sm font-medium">Note</label>
                <textarea name="note"
                    class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-300"
                    rows="3">{{ old('note') }}</textarea>
            </div>

            <div class="flex justify-between items-center">
                <a href="{{ route('contacts.index') }}" class="text-sm text-blue-600 hover:underline">← Back to list</a>
                <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                    Save Contact
                </button>
            </div>
        </form>
    </div>
@endsection
