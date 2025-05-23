<x-auth-layout title="Reset Password">
    <form action="{{ route('password.update') }}" method="POST" class="space-y-4">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="email" name="email" placeholder="Email" class="w-full border p-2 rounded" required />
        <input type="password" name="password" placeholder="New Password" class="w-full border p-2 rounded" required />
        <input type="password" name="password_confirmation" placeholder="Confirm Password" class="w-full border p-2 rounded" required />
        <button class="bg-green-600 text-white px-4 py-2 rounded">Reset Password</button>
    </form>
</x-auth-layout>
