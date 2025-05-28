@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white shadow rounded">
    <h2 class="text-xl font-bold mb-4">🧠 AI Task Suggestions</h2>

    @if($suggestedTasks->isEmpty())
        <p class="text-gray-500">No suggestions found.</p>
    @else
        <div class="space-y-4">
            @foreach($suggestedTasks as $task)
                <div class="bg-gray-100 p-4 rounded flex justify-between items-center">
                    <span class="text-gray-800">{{ $task }}</span>
                    <form method="POST" action="{{ route('tasks.store') }}">
                        @csrf
                        <input type="hidden" name="title" value="{{ Str::limit($task, 60) }}">
                        <input type="hidden" name="description" value="{{ $task }}">
                        <button type="submit"
                                class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700 transition">
                            ➕ Create Task
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
