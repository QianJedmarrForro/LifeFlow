<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'LifeFlow' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 antialiased">
    <nav class="flex justify-between items-center p-6 bg-white shadow-sm">
        <a href="/" class="font-bold text-xl uppercase tracking-tighter">LIFEFLOW</a>
        
        @if(request()->path() !== 'login' && request()->path() !== 'register')
            <div class="space-x-8 font-semibold">
                <a href="/home" class="hover:text-red-600">Home</a>
                <a href="/about" class="hover:text-red-600">About</a>
            </div>
        @endif
    </nav>

    <main class="container mx-auto px-4">
        {{ $slot }} 
    </main>
</body>
</html>