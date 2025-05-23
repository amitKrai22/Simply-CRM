<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CRM Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-50 to-blue-100 min-h-screen">

    <nav class="bg-white shadow px-6 py-4 flex justify-between items-center">
        <h1 class="text-xl font-bold text-blue-600">CRM Dashboard</h1>
        <div class="space-x-4">
            <a href="{{ route('contacts.index') }}" class="text-blue-600 hover:underline">Contacts</a>
            <a href="{{ route('leads.index') }}" class="text-blue-600 hover:underline">Leads</a>
            <a href="{{ route('tasks.index') }}" class="text-blue-600 hover:underline">Tasks</a>
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition">Logout</button>
            </form>
        </div>
    </nav>


    <main class="p-10 text-center">
        
        <h2 class="text-2xl font-semibold text-gray-800 mb-2">Welcome, {{ Auth::user()->name }}!</h2>
        <p class="text-sm text-gray-500 mb-4">
    Logged in as: {{ Auth::user()->email }} (Role: {{ Auth::user()->role }})
</p>
        <p class="text-gray-600">Use the nav bar above to manage your CRM data.</p>
    </main>

</body>
</html>
