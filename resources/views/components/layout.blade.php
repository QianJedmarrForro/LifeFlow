<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'LifeFlow' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .custom-scrollbar::-webkit-scrollbar { width: 5px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #333; border-radius: 10px; }
    </style>
</head>
<body class="bg-[#1a1a2e] antialiased text-white">

    {{-- Guest Layout (Login/Register) --}}
    @if(request()->is('login') || request()->is('register') || request()->is('/'))
        <nav class="flex justify-between items-center p-6 bg-white shadow-sm">
            <a href="/" class="font-black text-2xl uppercase tracking-tighter text-red-600">LIFEFLOW</a>
            <div class="space-x-8 font-semibold text-gray-800">
                <a href="/login" class="hover:text-red-600 transition">Login</a>
                <a href="/register" class="hover:text-red-600 transition">Register</a>
            </div>
        </nav>
        <main class="container mx-auto px-4 mt-10 text-gray-800">
            {{ $slot }} 
        </main>

    {{-- Authenticated Layout (Sidebar + Content) --}}
    @else
        <div class="flex min-h-screen">
            
            <aside class="w-64 bg-[#111111] flex flex-col fixed h-full shadow-2xl z-50 p-4 border-r border-gray-900">
                
                <div class="py-8 flex flex-col items-center">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-16 mb-2">
                    <h1 class="font-bold text-white tracking-tight text-center text-sm leading-tight uppercase">
                        LifeFlow<br>Logo
                    </h1>
                </div>

                <div class="px-2 mb-6">
                    <div class="flex items-center bg-[#2a2a2a] rounded-full px-4 py-2">
                        <input type="text" placeholder="Search..." class="bg-transparent border-none outline-none text-xs text-gray-400 w-full placeholder-gray-500">
                        <span class="text-blue-400 text-sm">🔍</span>
                    </div>
                </div>

                <nav class="flex-1 px-2 space-y-3 overflow-y-auto custom-scrollbar">
                    @php
                        $navItems = [
                            ['url' => '/home', 'label' => 'Home'],
                            ['url' => '/donate', 'label' => 'Donate Blood'],
                            ['url' => '/request', 'label' => 'Request Blood'],
                            ['url' => '/records', 'label' => 'Donor Records'],
                            ['url' => '/about', 'label' => 'About Us'],
                            ['url' => '/contact', 'label' => 'Contact Us'],
                        ];
                    @endphp

                    @foreach($navItems as $item)
                        <a href="{{ $item['url'] }}" 
                           class="flex items-center justify-center py-3 px-6 rounded-full transition-all duration-200 text-sm
                           {{ request()->is(ltrim($item['url'], '/').'*') 
                              ? 'bg-[#e53935] text-white font-bold shadow-lg' 
                              : 'bg-[#2a2a2a] text-gray-300 hover:bg-[#3a3a3a]' }}">
                            {{ $item['label'] }}
                        </a>
                    @endforeach
                </nav>

                <div class="p-4 mt-auto flex justify-center">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="bg-[#2a2a2a] hover:bg-gray-700 text-gray-300 px-6 py-2 rounded-full text-xs font-bold uppercase transition">
                            Logout
                        </button>
                    </form>
                </div>
            </aside>

            <main class="flex-1 ml-64 flex flex-col">
                <header class="flex justify-between items-center p-8">
                    <h2 class="text-gray-500 font-medium text-xs uppercase tracking-widest">
                        Dashboard / <span class="text-red-500">{{ ucfirst(request()->path()) }}</span>
                    </h2>
                    
                    <div class="flex items-center space-x-4">
                        <div class="text-right">
                            <p class="text-xs text-gray-500 font-semibold">{{ now()->format('F d, Y') }}</p>
                            <p class="text-sm font-bold text-gray-300">Tagum City Branch</p>
                        </div>
                        <div class="w-10 h-10 bg-[#222222] border border-gray-700 rounded-xl flex items-center justify-center text-red-500 font-black">
                            {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
                        </div>
                    </div>
                </header>

                <div class="px-8 pb-8 flex-1">
                    <div class="bg-[#f87171] min-h-full rounded-[2.5rem] p-8 text-gray-900 shadow-2xl relative overflow-hidden">
                        <div class="absolute -top-24 -right-24 w-64 h-64 bg-red-400 rounded-full opacity-20"></div>
                        <div class="relative z-10">
                            {{ $slot }}
                        </div>
                    </div>
                </div>

                <footer class="p-4 text-center text-gray-600 text-[10px] tracking-widest uppercase">
                    &copy; 2026 LIFEFLOW SYSTEM • DEVELOPED FOR LIFE
                </footer>
            </main>
        </div>
    @endif

</body>
</html>