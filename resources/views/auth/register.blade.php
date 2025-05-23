<x-auth-layout title="Register">

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 text-red-800 p-2 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('register.submit') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-medium mb-1">Name</label>
            <input type="text" name="name" value="{{ old('name') }}" required
                class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-300" />
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required
                class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-300" />
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Phone</label>
            <input type="text" name="phone" value="{{ old('phone') }}"
                class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-300" />
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Password</label>
            <input type="password" name="password" required
                class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-300" />
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Confirm Password</label>
            <input type="password" name="password_confirmation" required
                class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-300" />
        </div>

        <div class="flex justify-between items-center">
            <a href="{{ route('login.form') }}" class="text-sm text-blue-600 hover:underline">Already have an account?</a>
        </div>

        <div>
            <button type="submit"
                class="w-full bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                Register
            </button>
        </div>
    </form>

</x-auth-layout>
