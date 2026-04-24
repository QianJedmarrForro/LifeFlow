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
        }

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

        .lf-logo {
            display: flex;
            align-items: center;
            gap: 14px;
            text-decoration: none;
        }

        .lf-logo-icon {
            width: 40px;
            height: 40px;
            background: var(--red);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .lf-logo-name {
            font-size: 22px;
            font-weight: 700;
            color: #fff;
        }

        .lf-logo-name span { color: var(--red); }

        .lf-header-center {
            font-size: 22px;
            color: #fff;
            font-weight: 700;
        }

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
        }

        .lf-nav-item {
            display: flex;
            align-items: center;
            padding: 16px 32px;
            font-size: 17px;
            font-weight: 500;
            color: var(--muted);
            text-decoration: none;
            transition: 0.2s;
        }

        .lf-nav-item:hover {
            background: var(--surface-light);
            color: #fff;
        }

        .lf-nav-item.active {
            color: #fff;
            background: rgba(192, 57, 43, 0.15);
            border-left: 5px solid var(--red);
        }

        .lf-main {
            grid-area: main;
            background: var(--bg);
        }

        .lf-avatar {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: #F5C4B3;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            cursor: pointer;
        }

        [x-cloak] { display: none !important; }
    </style>
</head>

<body>
<div class="lf-shell">

    <header class="lf-header">

        <a href="{{ route('dashboard') }}" class="lf-logo">
            <div class="lf-logo-icon"></div>
            <span class="lf-logo-name">Life<span>Flow</span></span>
        </a>

        <span class="lf-header-center">Blood Bank Management System</span>

        @auth
        <div x-data="{ open: false }" style="position:relative;">
            <div class="lf-avatar" @click="open = !open">
                {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
            </div>

            <div x-show="open"
                 @click.outside="open = false"
                 x-cloak
                 style="position:absolute; right:0; top:55px; background:#0A0A0A; border:1px solid var(--border); border-radius:12px; min-width:220px;">

                <div style="padding:12px;">
                    <div style="color:#fff; font-weight:700;">
                        {{ auth()->user()->name }}
                    </div>
                    <div style="color:#777; font-size:12px;">
                        {{ auth()->user()->email }}
                    </div>
                </div>

                <a href="{{ route('profile') }}"
                   style="display:block;padding:10px 16px;color:#eee;text-decoration:none;">
                    Profile
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button style="width:100%;text-align:left;padding:10px 16px;color:#E74C3C;background:none;border:none;">
                        Logout
                    </button>
                </form>

            </div>
        </div>
        @endauth

    </header>

    <nav class="lf-sidebar">

        <a href="{{ route('dashboard') }}" class="lf-nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            Dashboard
        </a>

        <a href="{{ route('donations.index') }}" class="lf-nav-item {{ request()->routeIs('donations.index') ? 'active' : '' }}">
            Blood Donations
        </a>

        <a href="{{ route('blood-requests.index') }}" class="lf-nav-item {{ request()->routeIs('blood-requests.index') ? 'active' : '' }}">
            Blood Requests
        </a>

        <a href="{{ route('donors.records') }}" class="lf-nav-item {{ request()->routeIs('donors.records') ? 'active' : '' }}">
            Donor Records
        </a>

        @auth
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}"
                   class="lf-nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    Admin Panel
                </a>
            @endif
        @endauth

    </nav>

    <main class="lf-main">
        {{ $slot }}
    </main>

</div>
</body>
</html>