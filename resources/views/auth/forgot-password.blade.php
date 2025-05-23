<x-auth-layout title="Forgot Password">
    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-2 mb-4 rounded">{{ session('success') }}</div>
    @endif

    <form action="{{ route('password.email') }}" method="POST" class="space-y-4">
        @csrf
        <input type="email" name="email" placeholder="Your email" class="w-full border p-2 rounded" required />
        <button class="bg-blue-500 text-white px-4 py-2 rounded">Send Reset Link</button>
    </form>
</x-auth-layout>
