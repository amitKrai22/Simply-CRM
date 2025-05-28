<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>{{ config('app.name', 'Laravel CRM') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js']) <!-- Or your setup -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <style>[x-cloak] { display: none !important; }</style>
</head>
<body class="bg-blue-50 min-h-screen" x-data="{ open: false }">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside :class="open ? 'w-64' : 'w-16'"
           class="bg-white h-screen transition-all duration-300 ease-in-out overflow-hidden fixed z-10">

        <!-- Toggle Button -->
        <div class="p-4 flex justify-end">
            <button @click="open = !open"
                    class="text-gray-500 hover:text-blue-600 focus:outline-none">
                <span x-show="open" x-cloak>❌</span>
                <span x-show="!open" x-cloak>☰</span>
            </button>
        </div>

        <!-- Sidebar Content -->
        <div class="px-4" x-show="open" x-cloak x-transition>
            <h2 class="font-bold text-gray-800 text-sm mb-3">🤖 AI Tools</h2>
            <ul class="space-y-2 text-sm text-gray-600">
                <li>
                    <a href="{{ route('ai.task.suggest') }}" class="hover:text-blue-600">🧠 Task Suggestions</a>
                </li>
                <li class="text-gray-400">🔍 Smart Lead Finder (Coming Soon)</li>
                <li class="text-gray-400">💬 AI Chat Assistant (Coming Soon)</li>
            </ul>
        </div>
    </aside>

    <!-- Main Content -->
    <div :class="open ? 'ml-64' : 'ml-16'" class="flex-1 transition-all duration-300 ease-in-out">

        <!-- Navbar -->
        <nav class="bg-white shadow px-6 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold text-blue-600">CRM Dashboard</h1>
            <div class="space-x-4">
                <a href="{{ route('home') }}" class="text-blue-600">Home</a>
                <a href="{{ route('contacts.index') }}" class="text-blue-600">Contacts</a>
                <a href="{{ route('leads.index') }}" class="text-blue-600">Leads</a>
                <a href="{{ route('tasks.index') }}" class="text-blue-600">Tasks</a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition">
                        Logout
                    </button>
                </form>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="p-6">
            @yield('content')
        </main>
    </div>
</div>

</body>
</html>
