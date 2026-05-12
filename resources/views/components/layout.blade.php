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
            --red: #D72638;
            --red-hover: #B51D2D;
            --sidebar-w: 280px;
            --header-h: 72px;
            --bg: #F8FAFC;
            --surface: #0F172A;
            --text-main: #1E293B;
            --text-muted: #64748B;
            --white: #FFFFFF;
            --border: #E2E8F0;
            --fs-sm: 0.875rem;
            --fs-base: 1rem;
            --shadow-lg: 0 20px 40px rgba(0,0,0,0.08);
        }

        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        html, body {
            height: 100%;
            font-family: 'DM Sans', sans-serif;
            background-color: var(--bg);
            color: var(--text-main);
            line-height: 1.6;
            letter-spacing: -0.01em;
        }

        .lf-shell {
            display: grid;
            grid-template-columns: var(--sidebar-w) 1fr;
            grid-template-rows: var(--header-h) 1fr;
            grid-template-areas:
                "sidebar header"
                "sidebar main";
            height: 100vh;
            transition: all 0.3s ease;
        }

        .sidebar-collapsed {
            grid-template-columns: 0 1fr;
        }

        .lf-sidebar {
            grid-area: sidebar;
            background: linear-gradient(180deg, #111827 0%, #0F172A 100%);
            display: flex;
            flex-direction: column;
            padding: 24px 0;
            overflow-y: auto;
            position: relative;
            z-index: 60;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-lg);
        }

        .sidebar-collapsed .lf-sidebar {
            transform: translateX(-100%);
        }

        .sidebar-label {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #475569;
            padding: 24px 32px 8px;
        }

        .lf-header {
            grid-area: header;
            height: var(--header-h);
            background: rgba(255,255,255,0.85);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
            z-index: 50;
        }

        .lf-logo { display: flex; align-items: center; gap: 14px; text-decoration: none; }
        .lf-logo-icon {
            width: 42px; height: 42px; border-radius: 12px;
            background: linear-gradient(135deg, #D72638, #FF4D5A);
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 8px 16px rgba(215,38,56,0.3);
        }
        .lf-logo-icon img { width: 22px; filter: brightness(0) invert(1); }
        .lf-logo-name { font-size: 22px; font-weight: 800; color: #0F172A; letter-spacing: -0.025em; }
        .lf-logo-name span { color: var(--red); }

        .lf-nav-item {
            display: flex; align-items: center;
            margin: 4px 16px; padding: 12px 18px; border-radius: 12px;
            color: #94A3B8; text-decoration: none; font-size: var(--fs-sm); font-weight: 500;
            transition: all 0.2s ease;
        }
        .lf-nav-item:hover { background: rgba(255,255,255,0.05); color: #fff; transform: translateX(4px); }
        .lf-nav-item.active {
            background: linear-gradient(135deg, rgba(215,38,56,0.15), rgba(215,38,56,0.05));
            color: #fff; font-weight: 600; border: 1px solid rgba(215,38,56,0.2);
        }
        .icon-box { margin-right: 12px; font-size: 16px; flex-shrink: 0; }

        .lf-main {
            grid-area: main;
            overflow-y: auto;
            height: calc(100vh - var(--header-h));
            padding: 40px;
            max-width: 1600px;
        }

        .lf-avatar {
            width: 42px; height: 42px; border-radius: 12px;
            background: linear-gradient(135deg, #D72638, #FF4D5A);
            color: white; display: flex; align-items: center; justify-content: center;
            font-weight: 700; cursor: pointer; transition: 0.2s;
        }

        table { width: 100%; border-collapse: collapse; }
        thead th {
            background: #F1F5F9; color: #475569; font-weight: 700;
            text-transform: uppercase; font-size: 11px; letter-spacing: 0.05em;
            padding: 14px; text-align: left; border-bottom: 2px solid #E2E8F0;
        }
        tbody td { padding: 14px; border-bottom: 1px solid #F1F5F9; font-size: 14px; }

        @media (max-width: 900px) {
            .lf-shell { grid-template-columns: 1fr; grid-template-areas: "header" "main"; }
            .lf-sidebar { position: fixed; top: var(--header-h); left: 0; bottom: 0; width: var(--sidebar-w); }
            .sidebar-collapsed .lf-sidebar { transform: translateX(-100%); }
        }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body x-data="{ sidebarOpen: true }">
    <div class="lf-shell" :class="!sidebarOpen ? 'sidebar-collapsed' : ''">
        <header class="lf-header">
            <div style="display:flex; align-items:center; gap:20px;">
                <button @click="sidebarOpen = !sidebarOpen" style="background:none; border:none; cursor:pointer; color:#1e293b;">
                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <a href="{{ route('dashboard') }}" class="lf-logo">
                    <div class="lf-logo-icon"><img src="/logo.svg"></div>
                    <span class="lf-logo-name">Life<span>Flow</span></span>
                </a>
            </div>
            <div style="font-size:11px; font-weight:800; color:var(--text-muted); letter-spacing:1px; text-transform:uppercase;">
                {{ auth()->user()->role ?? 'Guest' }} Portal
            </div>
            @auth
            <div x-data="{ open: false }" style="position:relative;">
                <div class="lf-avatar" @click="open = !open">
                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                </div>
                <div x-show="open" @click.outside="open = false" x-cloak style="position:absolute; right:0; top:52px; min-width:220px; background:#0F172A; border-radius:12px; padding:8px; box-shadow: var(--shadow-lg);">
                    <a href="{{ route('profile') }}" style="display:block; padding:12px; color:#E2E8F0; text-decoration:none; font-size:13px;">Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button style="width:100%; text-align:left; padding:12px; border:none; background:none; color:#FF6B6B; font-weight:700; cursor:pointer; font-size:13px;">Logout</button>
                    </form>
                </div>
            </div>
            @endauth
        </header>

        <nav class="lf-sidebar">
            <div class="sidebar-label">Management</div>
            @can('admin-only')
                <a href="{{ route('admin.dashboard') }}" class="lf-nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <span class="icon-box"></span> Admin Dashboard
                </a>
                <a href="{{ route('blood-requests.index') }}" class="lf-nav-item {{ request()->routeIs('blood-requests.index') ? 'active' : '' }}">
                    <span class="icon-box"></span> Blood Requests
                </a>
                <a href="{{ route('admin.donors') }}" class="lf-nav-item {{ request()->routeIs('admin.donors') ? 'active' : '' }}">
                    <span class="icon-box"></span> Donor Directory
                </a>
            @endcan
            @can('user-only')
                <a href="{{ route('dashboard') }}" class="lf-nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <span class="icon-box"></span> Dashboard
                </a>
                <div class="sidebar-label">Donation</div>
                <a href="{{ route('donations.create') }}" class="lf-nav-item {{ request()->routeIs('donations.create') ? 'active' : '' }}">
                    <span class="icon-box"></span> Donate Blood
                </a>
                <a href="{{ route('blood-requests.create') }}" class="lf-nav-item {{ request()->routeIs('blood-requests.create') ? 'active' : '' }}">
                    <span class="icon-box"></span> Request Blood
                </a>
            @endcan
            <div style="margin-top:auto;">
                <a href="{{ route('about') }}" class="lf-nav-item {{ request()->routeIs('about') ? 'active' : '' }}">
                    <span class="icon-box"></span> About System
                </a>
            </div>
        </nav>

        <main class="lf-main">
            {{ $slot }}
        </main>
    </div>
</body>
</html>