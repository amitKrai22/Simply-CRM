@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white shadow rounded">
    <h2 class="text-xl font-bold mb-4">🤖 CRM AI Assistant</h2>

    <form method="POST" action="{{ route('ai.assistant.ask') }}" class="mb-4">
        @csrf
        <textarea name="prompt"
                  class="w-full border p-3 rounded focus:outline-none focus:ring"
                  rows="3"
                  placeholder="Ask me something...">{{ old('prompt') }}</textarea>

        <button type="submit"
                class="mt-2 bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700 transition">
            Ask Assistant
        </button>
    </form>

    @if(session('response'))
        <div class="bg-gray-100 p-4 rounded whitespace-pre-line text-gray-800">
            <strong>AI:</strong><br>
            {{ session('response') }}
        </div>
    @endif
</div>
@endsection
