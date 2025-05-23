@extends('layouts.app')

@section('content')
    <div class="max-w-xl mx-auto bg-white p-6 shadow-md rounded">
        <h2 class="text-xl font-bold mb-4 text-gray-800">Edit Task</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('tasks.update', $task->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium">Title</label>
                <input type="text" name="title" value="{{ old('title', $task->title) }}" required
                       class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-300" />
            </div>

            <div>
                <label class="block text-sm font-medium">Description</label>
                <textarea name="description" rows="3"
                          class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-300">{{ old('description', $task->description) }}</textarea>
            </div>

            <div class="flex items-center space-x-2">
                <input type="checkbox" name="completed" value="1" {{ $task->completed ? 'checked' : '' }}
                       class="h-4 w-4 text-green-600 border-gray-300 rounded">
                <label class="text-sm text-gray-700">Mark as Completed</label>
            </div>

            <div class="flex justify-between items-center">
                <a href="{{ route('tasks.index') }}" class="text-sm text-blue-600 hover:underline">← Back to list</a>
                <button type="submit"
                        class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
                    Update Task
                </button>
            </div>
        </form>
    </div>
@endsection
