<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'LifeFlow' }} — Blood Bank System</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        :root {
            --red: #C0392B;
            --red-hover: #E74C3C;
            --sidebar-w: 280px;
            --header-h: 72px;
            --bg: #F5F4F2;
            --surface: #0A0A0A;
            --surface-light: #1A1A1A;
            --border: rgba(192, 57, 43, 0.4);
            --text-on-dark: #FFFFFF;
            --muted: #A0A0A0;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        html, body {
            height: 100%;
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            color: #333;
        }

        /* --- LAYOUT SHELL FIX --- */
        .lf-shell {
            display: grid;
            grid-template-columns: var(--sidebar-w) 1fr;
            grid-template-rows: var(--header-h) 1fr;
            grid-template-areas: "header header" "sidebar main";
            min-height: 100vh;
            transition: grid-template-columns 0.3s ease;
        }

        .sidebar-collapsed { 
            grid-template-columns: 0px 1fr; 
        }

        .lf-header {
            grid-area: header;
            position: sticky; top: 0; z-index: 50;
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 32px;
        }

        .lf-logo { display: flex; align-items: center; gap: 14px; text-decoration: none; }
        .lf-logo-icon { width: 40px; height: 40px; background: #fff; border-radius: 10px; display: flex; align-items: center; justify-content: center; border: 1px solid var(--border); }
        .lf-logo-name { font-size: 22px; font-weight: 700; color: #fff; }
        .lf-logo-name span { color: var(--red); }

        /* --- SIDEBAR ALIGNMENT FIX --- */
        .lf-sidebar {
            grid-area: sidebar;
            position: sticky; 
            top: var(--header-h);
            height: calc(100vh - var(--header-h));
            background: var(--surface);
            border-right: 1px solid var(--border);
            display: flex; 
            flex-direction: column; 
            padding: 24px 0;
            overflow-x: hidden; /* Mo-prevent og text leak kung i-collapse */
            transition: transform 0.3s ease, width 0.3s ease;
        }

        .sidebar-collapsed .lf-sidebar { 
            transform: translateX(-100%); 
        }

        .lf-nav-item {
            display: flex; 
            align-items: center; 
            padding: 14px 28px; /* Adjusted padding */
            font-size: 14px; 
            font-weight: 500; 
            color: var(--muted);
            text-decoration: none; 
            transition: 0.2s;
            white-space: nowrap; /* Sigurohon nga dili mo-wrap ang text */
        }

        /* Icon Container Fix */
        .lf-nav-item .icon-box {
            width: 24px;
            display: flex;
            justify-content: center;
            margin-right: 16px; /* Saktong distansya base sa image_f4cfc0.png */
            font-size: 18px;
            flex-shrink: 0;
        }

        .lf-nav-item:hover { background: var(--surface-light); color: #fff; }
        .lf-nav-item.active { 
            color: #fff; 
            background: rgba(192, 57, 43, 0.15); 
            border-left: 4px solid var(--red); 
            padding-left: 24px; /* Compensate for the 4px border */
        }

        .lf-main { 
            grid-area: main; 
            padding: 40px; 
            overflow-y: auto; 
            background: var(--bg); /* Sigurohon nga dili transparent */
        }

        .lf-avatar {
            width: 42px; height: 42px; border-radius: 50%;
            background: var(--red); color: #fff; display: flex;
            align-items: center; justify-content: center; font-weight: 700;
            cursor: pointer; border: 2px solid var(--border); overflow: hidden;
        }
        .lf-avatar img { width: 100%; height: 100%; object-fit: cover; }

        .toast-stack {
            position: fixed;
            top: 90px;
            right: 24px;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: 14px;
            width: min(360px, calc(100% - 48px));
            max-width: 100%;
        }

        .toast-notify {
            position: relative;
            padding: 16px 24px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            gap: 15px;
            border-left: 6px solid;
        }

        [x-cloak] { display: none !important; }
    </style>
</head>

<body x-data="{ sidebarOpen: true }">
<div class="lf-shell" :class="!sidebarOpen ? 'sidebar-collapsed' : ''">

    <!-- Toasts (Success/Error) -->
    <div class="toast-stack" aria-live="polite" aria-atomic="true">
        @if(session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" x-transition x-cloak class="toast-notify" style="border-color: #10b981;">
            <span style="font-size: 24px;">✅</span>
            <div>
                <div style="font-weight: 800; color: #111827; font-size: 14px;">Action Successful</div>
                <div style="color: #6b7280; font-size: 13px;">{{ session('success') }}</div>
            </div>
        </div>
        @endif

        @if(session('error'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" x-transition x-cloak class="toast-notify" style="border-color: #ef4444;">
            <span style="font-size: 24px;">⚠️</span>
            <div>
                <div style="font-weight: 800; color: #111827; font-size: 14px;">Medical Alert / Error</div>
                <div style="color: #6b7280; font-size: 13px;">{{ session('error') }}</div>
            </div>
        </div>
        @endif

        @stack('toasts')
    </div>

    <!-- Main Header -->
    <header class="lf-header">
        <div style="display: flex; align-items: center; gap: 20px;">
            <button @click="sidebarOpen = !sidebarOpen" style="background:none; border:none; color:#fff; cursor:pointer;">
                <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M3 12h18M3 6h18M3 18h18"></path></svg>
            </button>
            <a href="{{ route('dashboard') }}" class="lf-logo">
                <div class="lf-logo-icon"><img src="/logo.svg" style="width:24px;" onerror="this.src='https://cdn-icons-png.flaticon.com/512/822/822118.png'"></div>
                <span class="lf-logo-name">Life<span>Flow</span></span>
            </a>
        </div>

        <div style="color:rgba(255,255,255,0.5); font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;">
            {{ auth()->user()->role ?? 'Guest' }} Access
        </div>

        @auth
        <div x-data="{ open: false }" style="position:relative;">
            <div class="lf-avatar" @click="open = !open">
                @if(auth()->user()->profile_photo)
                    <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}">
                @else
                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                @endif
            </div>
            <div x-show="open" @click.outside="open = false" x-cloak
                 style="position:absolute; right:0; top:55px; background:var(--surface); border:1px solid var(--border); border-radius:12px; min-width:240px; overflow:hidden; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.5);">
                <div style="padding:20px; background: var(--surface-light);">
                    <div style="color:#fff; font-weight:700;">{{ auth()->user()->name }}</div>
                    <div style="color:var(--muted); font-size:12px;">{{ auth()->user()->email }}</div>
                </div>
                <a href="{{ route('profile') }}" style="display:block; padding:12px 20px; color:#eee; text-decoration:none; font-size:14px;" class="nav-hover">Profile Settings</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button style="width:100%; text-align:left; padding:12px 20px; color:var(--red); background:none; border:none; cursor:pointer; font-weight:700;">Logout</button>
                </form>
            </div>
        </div>
        @endauth
    </header>

    <!-- Side Navigation -->
    <nav class="lf-sidebar">
        @can('admin-only')
            <div style="padding: 20px 32px 10px; font-size: 11px; color: var(--red); font-weight: 800; text-transform: uppercase; letter-spacing: 1px;">Management</div>
            
            <a href="{{ route('admin.dashboard') }}" class="lf-nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span class="icon-box">🛡️</span> Admin Dashboard
            </a>

            <a href="{{ route('blood-requests.index') }}" class="lf-nav-item {{ request()->routeIs('blood-requests.index') ? 'active' : '' }}">
                <span class="icon-box">🩸</span> Blood Requests
            </a>
            
            <a href="{{ route('admin.donors') }}" class="lf-nav-item {{ request()->routeIs('admin.donors') ? 'active' : '' }}">
                <span class="icon-box">📂</span> Donor Directory
            </a>
        @endcan

        @can('user-only')
            <a href="{{ route('dashboard') }}" class="lf-nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <span class="icon-box">📊</span> Dashboard
            </a>

            <div style="padding: 20px 32px 10px; font-size: 11px; color: var(--red); font-weight: 800; text-transform: uppercase; letter-spacing: 1px;">Activities</div>
            <a href="{{ route('information') }}" class="lf-nav-item {{ request()->routeIs('information') ? 'active' : '' }}">
                <span class="icon-box">📘</span> Donation Information
            </a>
            <a href="{{ route('donations.create') }}" class="lf-nav-item {{ request()->routeIs('donations.create') ? 'active' : '' }}">
                <span class="icon-box">❤️</span> Donate Blood
            </a>
            <a href="{{ route('blood-requests.create') }}" class="lf-nav-item {{ request()->routeIs('blood-requests.create') ? 'active' : '' }}">
                <span class="icon-box">🚑</span> Request Blood
            </a>
        @endcan

        <div style="margin-top:auto; padding-bottom: 20px;">
            <a href="{{ route('about') }}" class="lf-nav-item {{ request()->routeIs('about') ? 'active' : '' }}">
                <span class="icon-box">ℹ️</span> About System
            </a>
        </div>
    </nav>

    <!-- Main Content Area -->
    <main class="lf-main">
        {{ $slot }}
    </main>

</div>
</body>
</html>