<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'LifeFlow' }} — Blood Bank System</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">

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
            font-size: 16px;
            color: #333;
            background: var(--bg);
        }

        .lf-shell {
            display: grid;
            grid-template-columns: var(--sidebar-w) 1fr;
            grid-template-rows: var(--header-h) 1fr;
            grid-template-areas:
                "header header"
                "sidebar main";
            min-height: 100vh;
            transition: grid-template-columns 0.3s ease;
        }

        .lf-shell.sidebar-collapsed { grid-template-columns: 0px 1fr; }

        .lf-header {
            grid-area: header;
            position: sticky;
            top: 0;
            z-index: 50;
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
        }

        .lf-header-left { display: flex; align-items: center; }

        .burger-btn {
            background: none; border: none; color: #fff; cursor: pointer;
            margin-right: 20px; display: flex; align-items: center; font-size: 24px;
        }

        .lf-logo { display: flex; align-items: center; gap: 14px; text-decoration: none; }

        .lf-logo-icon {
            width: 40px; height: 40px; background: #fff; border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            overflow: hidden; border: 1px solid var(--border);
        }

        .lf-logo-name { font-size: 22px; font-weight: 700; color: #fff; }
        .lf-logo-name span { color: var(--red); }

        .lf-header-center { font-size: 22px; color: #fff; font-weight: 700; }

        .lf-sidebar {
            grid-area: sidebar;
            position: sticky; top: var(--header-h);
            height: calc(100vh - var(--header-h));
            background: var(--surface);
            border-right: 1px solid var(--border);
            display: flex; flex-direction: column; padding: 24px 0;
            transition: transform 0.3s ease; overflow: hidden;
        }

        .sidebar-collapsed .lf-sidebar { transform: translateX(-100%); }

        .lf-nav-item {
            display: flex; align-items: center; padding: 16px 32px;
            font-size: 17px; font-weight: 500; color: var(--muted);
            text-decoration: none; transition: 0.2s; white-space: nowrap;
        }

        .lf-nav-item:hover { background: var(--surface-light); color: #fff; }
        .lf-nav-item.active {
            color: #fff; background: rgba(192, 57, 43, 0.15);
            border-left: 5px solid var(--red);
        }

        .lf-main { grid-area: main; background: var(--bg); position: relative; }

        .lf-avatar {
            width: 44px; height: 44px; border-radius: 50%;
            background: #F5C4B3; display: flex; align-items: center;
            justify-content: center; font-weight: 700; cursor: pointer;
            overflow: hidden; border: 2px solid var(--red); transition: transform 0.2s;
        }
        .lf-avatar:hover { transform: scale(1.05); }
        .lf-avatar img { width: 100%; height: 100%; object-fit: cover; }

        /* Dropdown Link Styles */
        .dropdown-link {
            display: block; padding: 12px 16px; color: #eee;
            text-decoration: none; transition: background 0.2s, color 0.2s;
            font-size: 14px;
        }
        .dropdown-link:hover { background: var(--surface-light); color: #fff; }

        [x-cloak] { display: none !important; }

        /* Notification Toast Styling */
        .toast-notify {
            position: fixed; top: 85px; right: 20px; z-index: 1000;
            padding: 16px 24px; background: #fff; border-left: 4px solid #10b981;
            border-radius: 8px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);
            display: flex; align-items: center; gap: 12px;
        }
    </style>
</head>

<body x-data="{ sidebarOpen: true }">
<div class="lf-shell" :class="!sidebarOpen ? 'sidebar-collapsed' : ''">

    @if(session('success'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" x-transition x-cloak class="toast-notify">
        <span style="color: #10b981; font-size: 20px;">check_circle</span>
        <div>
            <div style="font-weight: 700; color: #111827; font-size: 14px;">Success</div>
            <div style="color: #6b7280; font-size: 13px;">{{ session('success') }}</div>
        </div>
    </div>
    @endif

    <header class="lf-header">
        <div class="lf-header-left">
            <button class="burger-btn" @click="sidebarOpen = !sidebarOpen">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
            </button>

            <a href="{{ route('dashboard') }}" class="lf-logo">
                <div class="lf-logo-icon">
                    <x-logo />
                </div>
                <span class="lf-logo-name">Life<span>Flow</span></span>
            </a>
        </div>

        <span class="lf-header-center">Blood Bank Management System</span>

        @auth
        <div x-data="{ open: false }" style="position:relative;">
            <div class="lf-avatar" @click="open = !open">
                @if(auth()->user()->profile_photo)
                    <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}" alt="Profile">
                @else
                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                @endif
            </div>

            <div x-show="open" @click.outside="open = false" x-cloak
                 style="position:absolute; right:0; top:55px; background:var(--surface); border:1px solid var(--border); border-radius:12px; min-width:220px; z-index: 100; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.5); overflow: hidden;">

                <div style="padding:16px; border-bottom: 1px solid var(--surface-light); background: var(--surface-light);">
                    <div style="color:#fff; font-weight:700; font-size: 14px;">{{ auth()->user()->name }}</div>
                    <div style="color:#A0A0A0; font-size:12px;">{{ auth()->user()->email }}</div>
                </div>

                <a href="{{ route('profile') }}" class="dropdown-link">
                    <span style="margin-right: 8px;">👤</span> Profile Settings
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="dropdown-link" style="width:100%; text-align:left; color:#E74C3C; background:none; border:none; cursor:pointer;">
                        <span style="margin-right: 8px;">⎋</span> Logout
                    </button>
                </form>
            </div>
        </div>
        @endauth
    </header>

    <nav class="lf-sidebar">
        <a href="{{ route('dashboard') }}" class="lf-nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
        <a href="{{ route('donations.index') }}" class="lf-nav-item {{ request()->routeIs('donations.index') ? 'active' : '' }}">Blood Donations</a>
        <a href="{{ route('blood-requests.index') }}" class="lf-nav-item {{ request()->routeIs('blood-requests.index') ? 'active' : '' }}">Blood Requests</a>
        <a href="{{ route('donors.records') }}" class="lf-nav-item {{ request()->routeIs('donors.records') ? 'active' : '' }}">Donor Records</a>
        
        @auth
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="lf-nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Admin Panel</a>
            @endif
        @endauth
    </nav>

    <main class="lf-main">
        {{ $slot }}
    </main>

</div>
</body>
</html>