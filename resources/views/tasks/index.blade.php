@extends('layouts.app')

@section('content')
    <form method="GET" action="{{ route('tasks.index') }}" class="mb-6 flex flex-wrap gap-3 items-center">

    <!-- Search field -->
    <input type="text" name="search" value="{{ request('search') }}"
           placeholder="Search tasks..."
           class="px-4 py-2 border rounded w-64 focus:outline-none focus:ring-2 focus:ring-blue-300" />

    <!-- Completion filter -->
    <select name="completed" class="px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-300">
        <option value="">All Status</option>
        <option value="0" {{ request('completed') === '0' ? 'selected' : '' }}>Not Completed</option>
        <option value="1" {{ request('completed') === '1' ? 'selected' : '' }}>Completed</option>
    </select>

    <!-- Submit -->
    <button type="submit"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
        Filter
    </button>

    <!-- Reset -->
    @if(request()->filled('search') || request()->has('completed'))
        <a href="{{ route('tasks.index') }}" class="text-sm text-red-500 underline">Clear</a>
    @endif
</form>

    <div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Tasks</h2>

    <div class="flex gap-3">
        <!-- AI Suggestion Button -->
        <a href="{{ route('ai.task.suggest') }}"
           class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded shadow transition duration-200">
            🧠 Suggest Tasks (AI)
        </a>

        <!-- Add Task Button -->
        <a href="{{ route('tasks.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            + Add Task
        </a>
    </div>
</div>


    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($tasks->isEmpty())
        <p class="text-gray-600">No tasks found.</p>
    @else
        <div class="overflow-x-auto bg-white shadow rounded">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Title</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Description</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Completed</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ($tasks as $task)
                        <tr>
                            <td class="px-4 py-2">{{ $task->title }}</td>
                            <td class="px-4 py-2">{{ $task->description }}</td>
                            <td class="px-4 py-2">
                                <span class="inline-block px-2 py-1 rounded text-xs {{ $task->completed ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                    {{ $task->completed ? 'Yes' : 'No' }}
                                </span>
                            </td>
                            <td class="px-4 py-2 space-x-2">
                                <a href="{{ route('tasks.edit', $task->id) }}"
                                   class="text-blue-600 hover:underline">Edit</a>
                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="inline"
                                      onsubmit="return confirm('Delete this task?');">
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
    {{ $tasks->withQueryString()->links() }}
</div>

        </div>
    @endif
@endsection

