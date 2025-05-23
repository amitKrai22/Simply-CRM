<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CRM Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen">

    <!-- Navigation -->
    <nav class="bg-white shadow px-6 py-4 flex justify-between items-center">
        <div class="text-xl font-bold text-blue-600">CRM Dashboard</div>
        <div class="space-x-4">
            <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600">Home</a>
            <a href="{{ route('contacts.index') }}" class="text-gray-700 hover:text-blue-600">Contacts</a>
            <a href="{{ route('leads.index') }}" class="text-gray-700 hover:text-blue-600">Leads</a>
            <a href="{{ route('tasks.index') }}" class="text-gray-700 hover:text-blue-600">Tasks</a>

            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition">Logout</button>
            </form>
        </div>
    </nav>

    <!-- Page Content -->
    <main class="p-8">
        @yield('content')
    </main>

</body>
</html>
