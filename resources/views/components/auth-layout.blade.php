<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'CRM Auth' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-sky-100 to-blue-200 min-h-screen flex items-center justify-center px-4">

    <div class="bg-white shadow-xl rounded-xl p-8 w-full max-w-md">
        <h1 class="text-2xl font-semibold text-center mb-6 text-blue-700">{{ $title ?? 'Welcome' }}</h1>
        
        {{ $slot }}

    </div>

</body>
</html>
