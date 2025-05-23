@extends('layouts.app')

@section('content')
    <div class="max-w-xl mx-auto bg-white p-6 shadow-md rounded">
        <h2 class="text-xl font-bold mb-4 text-gray-800">Add New Task</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('tasks.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium">Title</label>
                <input type="text" name="title" value="{{ old('title') }}" required
                       class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-300" />
            </div>

            <div>
                <label class="block text-sm font-medium">Description</label>
                <textarea name="description" rows="3"
                          class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-300">{{ old('description') }}</textarea>
            </div>

            <div class="flex justify-between items-center">
                <a href="{{ route('tasks.index') }}" class="text-sm text-blue-600 hover:underline">← Back to list</a>
                <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                    Save Task
                </button>
            </div>
        </form>
    </div>
@endsection
