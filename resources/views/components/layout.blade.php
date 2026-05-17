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

    <script>
        window.addEventListener('pageshow', function (event) {
            if (event.persisted || (typeof window.performance != 'undefined' && window.performance.navigation.type === 2)) {
                window.location.reload();
            }
        });
    </script>

    <style>
        :root {
            --red: #D72638;
            --red-hover: #EF4444;
            --header-h: 72px;
            --bg: #F8FAFC;
            --surface: #0F172A;
            --text-main: #1E293B;
            --text-muted: #94A3B8;
            --shadow-lg: 0 10px 30px rgba(0,0,0,0.15);
        }

        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
        }

        html, body {
            height: 100%;
            font-family: 'DM Sans', sans-serif;
            background-color: var(--bg);
            color: var(--text-main);
            line-height: 1.6;
        }

        .lf-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: var(--header-h);
            background: var(--surface);
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            align-items: center;
            padding: 0 40px;
            z-index: 1000;
            box-shadow: var(--shadow-lg);
        }

        .lf-logo-container {
            display: flex;
            justify-content: flex-start;
        }

        .lf-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .lf-logo-icon {
            width: 38px; height: 38px; border-radius: 10px;
            background: linear-gradient(135deg, #D72638, #FF4D5A);
            display: flex; align-items: center; justify-content: center;
        }

        .lf-logo-icon img { width: 20px; filter: brightness(0) invert(1); }

        .lf-logo-name {
            font-size: 20px;
            font-weight: 800;
            color: #FFFFFF;
            letter-spacing: -0.025em;
        }

        .lf-logo-name span { color: var(--red); }

        .lf-nav {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .lf-nav-item {
            color: var(--text-muted);
            text-decoration: none;
            font-size: 13.5px;
            font-weight: 700;
            padding: 10px 22px;
            border-radius: 14px;
            transition: all 0.2s ease-in-out;
        }

        .lf-nav-item:hover {
            color: #FFFFFF;
            background: rgba(255, 255, 255, 0.05);
        }

        .lf-nav-item.active {
            color: #FFFFFF !important;
            background-color: #EF4444 !important;
            font-weight: 800;
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.4);
        }

        .lf-user-section {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 20px;
        }

        .portal-label {
            font-size: 10px;
            font-weight: 800;
            color: var(--text-muted);
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .lf-avatar {
            width: 40px; height: 40px; border-radius: 12px;
            background: linear-gradient(135deg, #D72638, #FF4D5A);
            color: white; display: flex; align-items: center; justify-content: center;
            font-weight: 700; cursor: pointer; transition: 0.2s;
            box-shadow: 0 4px 10px rgba(215, 38, 56, 0.2);
        }

        .lf-main {
            padding-top: calc(var(--header-h) + 40px);
            padding-bottom: 40px;
            padding-left: 40px;
            padding-right: 40px;
            max-width: 1600px;
            margin: 0 auto;
        }

        .lf-bell-btn {
            background: none;
            border: none;
            cursor: pointer;
            position: relative;
            padding: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            transition: 0.2s;
        }

        .lf-bell-btn:hover {
            background: rgba(255, 255, 255, 0.05);
        }

        .lf-bell-badge {
            position: absolute;
            top: 2px;
            right: 2px;
            background: #EF4444;
            color: white;
            font-size: 9px;
            font-weight: 800;
            padding: 2px 6px;
            border-radius: 99px;
            border: 2px solid var(--surface);
        }

        [x-cloak] { display: none !important; }
    </style>
</head>
<body>

    <header class="lf-header">

        <div class="lf-logo-container">
            <a href="{{ route('dashboard') }}" class="lf-logo">
                <x-logo style="width:45px; filter: brightness(0) invert(1);" />
                <span class="lf-logo-name">Life<span>Flow</span></span>
            </a>
        </div>

        <nav class="lf-nav">
            @can('admin-only')
                <a href="{{ route('admin.dashboard') }}" class="lf-nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a>
                <a href="{{ route('blood-requests.index') }}" class="lf-nav-item {{ request()->routeIs('blood-requests.index') ? 'active' : '' }}">Requests</a>
                <a href="{{ route('admin.donors') }}" class="lf-nav-item {{ request()->routeIs('admin.donors') ? 'active' : '' }}">Donors</a>
            @endcan

            @can('user-only')
                <a href="{{ route('dashboard') }}" class="lf-nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
                <a href="{{ route('donations.create') }}" class="lf-nav-item {{ request()->routeIs('donations.create') ? 'active' : '' }}">Donate</a>
                <a href="{{ route('blood-requests.create') }}" class="lf-nav-item {{ request()->routeIs('blood-requests.create') ? 'active' : '' }}">Request</a>
            @endcan

            <a href="{{ route('about') }}" class="lf-nav-item {{ request()->routeIs('about') ? 'active' : '' }}">About System</a>
            <a href="{{ route('bulletin') }}" class="lf-nav-item {{ request()->routeIs('bulletin') ? 'active' : '' }}">Donation Guide</a>
        </nav>

        <div class="lf-user-section">
            
            @auth
            <div x-data="{ openNotifications: false }" style="position: relative;">
                <button @click="openNotifications = !openNotifications" id="notification-dropdown-btn" class="lf-bell-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="#94A3B8" stroke-width="2" class="hover:stroke-white transition-colors">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                    </svg>

                    @if(auth()->user()->unreadNotifications->count() > 0)
                        <span id="notification-badge" class="lf-bell-badge">
                            {{ auth()->user()->unreadNotifications->count() }}
                        </span>
                    @endif
                </button>

                <div x-show="openNotifications"
                     @click.outside="openNotifications = false"
                     x-transition
                     x-cloak
                     style="position:absolute; right:0; top:52px; width:320px; background:#1e293b; border-radius:12px; padding:4px; box-shadow: var(--shadow-lg); border: 1px solid rgba(255,255,255,0.1); z-index: 1010;">
                    
                    <div style="padding: 12px; border-bottom: 1px solid rgba(255,255,255,0.08); display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-size: 13px; font-weight: 700; color: #FFFFFF;">Notifications</span>
                        @if(auth()->user()->unreadNotifications->count() > 0)
                            <a href="{{ route('notifications.markAllRead') }}" style="font-size: 11px; color: #EF4444; text-decoration: none; font-weight: 500;" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">Mark all read</a>
                        @endif
                    </div>

                    <div style="max-height: 280px; overflow-y: auto;">
                        @forelse(auth()->user()->unreadNotifications as $notification)
                            <div style="padding: 12px; border-bottom: 1px solid rgba(255,255,255,0.05); display: flex; flex-col; gap: 4px;">
                                <div style="font-size: 12px; font-weight: 700; color: #FFFFFF; line-height: 1.4;">
                                    {{ $notification->data['title'] ?? 'System Notice' }}
                                </div>
                                <div style="font-size: 11px; color: #94A3B8; line-height: 1.4; margin-top: 2px;">
                                    {{ $notification->data['message'] ?? '' }}
                                </div>
                                <div style="font-size: 9px; color: #64748B; margin-top: 4px; font-weight: 500;">
                                    {{ $notification->created_at->diffForHumans() }}
                                </div>
                            </div>
                        @empty
                            <div style="padding: 24px 12px; text-align: center; font-size: 12px; color: #94A3B8;">
                                No new notifications
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
            @endauth

            <span class="portal-label">{{ auth()->user()->role ?? 'Guest' }} Portal</span>

            @auth
            <div x-data="{ open: false }" style="position:relative;">

                <div class="lf-avatar" @click="open = !open">
                    @if(auth()->user()->profile_photo)
                        <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}"
                             style="width:40px;height:40px;border-radius:12px;object-fit:cover;"
                             onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
                        <span style="display:none; width:100%; height:100%; align-items:center; justify-content:center;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="white" stroke-width="1.8">
                                <circle cx="12" cy="8" r="4"/>
                                <path stroke-linecap="round" d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
                            </svg>
                        </span>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="white" stroke-width="1.8">
                            <circle cx="12" cy="8" r="4"/>
                            <path stroke-linecap="round" d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
                        </svg>
                    @endif
                </div>

                <div x-show="open"
                     @click.outside="open = false"
                     x-transition
                     x-cloak
                     style="position:absolute; right:0; top:52px; min-width:200px; background:#1e293b; border-radius:12px; padding:8px; box-shadow: var(--shadow-lg); border: 1px solid rgba(255,255,255,0.1);">

                    <a href="{{ route('profile') }}" style="display:block; padding:12px; color:#E2E8F0; text-decoration:none; font-size:13px; border-radius:8px;" onmouseover="this.style.background='rgba(255,255,255,0.05)'" onmouseout="this.style.background='none'">Profile</a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button style="width:100%; text-align:left; padding:12px; border:none; background:none; color:#FF6B6B; font-weight:700; cursor:pointer; font-size:13px; border-radius:8px;" onmouseover="this.style.background='rgba(255,107,107,0.1)'" onmouseout="this.style.background='none'">
                            Logout
                        </button>
                    </form>
                </div>

            </div>
            @endauth
        </div>

    </header>

    <main class="lf-main">
        {{ $slot }}
    </main>

    @stack('toasts')

    @auth
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const notificationBtn = document.getElementById('notification-dropdown-btn');
            
            if (notificationBtn) {
                notificationBtn.addEventListener('click', function() {
                    fetch("{{ route('notifications.markAllRead') }}", {
                        method: "GET",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Content-Type": "application/json"
                        }
                    })
                    .then(response => {
                        const badge = document.getElementById('notification-badge');
                        if (badge) {
                            badge.style.display = 'none';
                        }
                    })
                    .catch(error => console.error('Error handling notifications update:', error));
                });
            }
        });
    </script>
    @endauth
</body>
</html>