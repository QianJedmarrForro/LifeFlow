<x-layout>
<div style="padding:40px; font-family: 'DM Sans', sans-serif; min-height: 100vh; background-color: #f8fafc;">

    <!-- TOP HEADER SECTION -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <div>
            <h1 style="font-size:28px; font-weight:800; color: #111; margin: 0;">Admin Dashboard</h1>
            <p style="color:#64748b; margin: 5px 0 0 0;">Welcome back, {{ auth()->user()->name }}</p>
        </div>
        
        <div style="display: flex; gap: 12px;">
            <a href="{{ route('admin.users') }}" style="background: #fff; color: #1e293b; border: 1px solid #e2e8f0; padding: 10px 18px; border-radius: 10px; text-decoration: none; font-weight: 600; font-size: 14px; transition: 0.2s; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                 Manage Users
            </a>
            <a href="{{ route('admin.donations') }}" style="background: #ef4444; color: #fff; border: 1px solid #ef4444; padding: 10px 18px; border-radius: 10px; text-decoration: none; font-weight: 600; font-size: 14px; transition: 0.2s; box-shadow: 0 2px 4px rgba(239,68,68,0.2);">
                 Manage Donations
            </a>
            <a href="{{ route('admin.reports') }}" style="background: #fff; color: #1e293b; border: 1px solid #e2e8f0; padding: 10px 18px; border-radius: 10px; text-decoration: none; font-weight: 600; font-size: 14px; transition: 0.2s; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                 Activity Reports
            </a>
        </div>
    </div>

    <!-- NOTIFICATIONS -->
    @if(session('error'))
        <div style="background: #fee2e2; color: #b91c1c; padding: 15px; border-radius: 10px; margin-bottom: 20px; border: 1px solid #fecaca; font-weight: 600; display:flex; align-items:center; gap:8px;">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#b91c1c" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div style="background: #dcfce7; color: #15803d; padding: 15px; border-radius: 10px; margin-bottom: 20px; border: 1px solid #bbf7d0; font-weight: 600; display:flex; align-items:center; gap:8px;">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#15803d" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            {{ session('success') }}
        </div>
    @endif

    <!-- STATS OVERVIEW (Cards) -->
    <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:20px; margin-bottom: 30px;">
        <div style="background:#fff; padding:25px; border-radius:16px; box-shadow:0 4px 15px rgba(0,0,0,0.05); border-left: 6px solid #ef4444;">
            <h3 style="font-size: 11px; color: #888; text-transform: uppercase; letter-spacing: 1.5px; font-weight: 800;">Total Users</h3>
            <p style="font-size:36px; font-weight:800; color: #1e293b; margin: 10px 0 0 0;">{{ \App\Models\User::count() }}</p>
        </div>

        <div style="background:#fff; padding:25px; border-radius:16px; box-shadow:0 4px 15px rgba(0,0,0,0.05); border-left: 6px solid #10b981;">
            <h3 style="font-size: 11px; color: #888; text-transform: uppercase; letter-spacing: 1.5px; font-weight: 800;">Total Donations</h3>
            <p style="font-size:36px; font-weight:800; color: #1e293b; margin: 10px 0 0 0;">{{ \App\Models\Donation::count() }}</p>
        </div>

        <div style="background:#fff; padding:25px; border-radius:16px; box-shadow:0 4px 15px rgba(0,0,0,0.05); border-left: 6px solid #3b82f6;">
            <h3 style="font-size: 11px; color: #888; text-transform: uppercase; letter-spacing: 1.5px; font-weight: 800;">Blood Requests</h3>
            <p style="font-size:36px; font-weight:800; color: #1e293b; margin: 10px 0 0 0;">{{ \App\Models\BloodRequest::count() }}</p>
        </div>

        <div style="background:#fff; padding:25px; border-radius:16px; box-shadow:0 4px 15px rgba(0,0,0,0.05); border-left: 6px solid #C0392B;">
            <h3 style="font-size: 11px; color: #888; text-transform: uppercase; letter-spacing: 1.5px; font-weight: 800;">Total Blood Volume</h3>
            <p style="font-size:30px; font-weight:800; color: #1e293b; margin: 10px 0 0 0;">{{ number_format(\App\Models\Donation::sum('units')) }} <span style="font-size:14px; color:#94a3b8; font-weight:600;">ml</span></p>
        </div>
    </div>

    <!-- BLOOD INVENTORY SECTION -->
    <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 20px;">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="#ef4444"><path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z"/></svg>
        <h2 style="font-size:20px; font-weight:800; color: #1e293b; margin:0;">Blood Bank Inventory</h2>
    </div>

    <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:15px; margin-bottom:40px;">
        @foreach($inventory as $item)
        @php
            $fillPct = min(100, ($item->stock / 5000) * 100);
            $isLow   = $item->status === 'Low';
            $barColor = $isLow ? '#ef4444' : '#10b981';
        @endphp
        <div style="background:#fff; padding:22px 20px; border-radius:14px; box-shadow:0 2px 8px rgba(0,0,0,0.04); border: 1px solid #e2e8f0; position:relative; overflow:hidden;">
            {{-- blood type + status --}}
            <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:14px;">
                <span style="font-weight:900; color:#D72638; font-size:26px; line-height:1;">{{ $item->type }}</span>
                <span style="font-size:9px; font-weight:800; text-transform:uppercase; letter-spacing:0.8px;
                             padding:3px 8px; border-radius:100px;
                             background:{{ $isLow ? 'rgba(239,68,68,0.08)' : 'rgba(16,185,129,0.08)' }};
                             color:{{ $isLow ? '#b91c1c' : '#065f46' }};">
                    {{ $item->status }}
                </span>
            </div>

            {{-- ml --}}
            <div style="font-size:22px; font-weight:800; color:#1e293b; line-height:1; margin-bottom:2px;">
                {{ number_format($item->stock) }}
                <span style="font-size:12px; color:#94a3b8; font-weight:600;">ml</span>
            </div>

            {{-- bags --}}
            <div style="font-size:12px; color:#64748b; font-weight:600; margin-bottom:14px;">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align:middle; margin-right:3px;"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/></svg>
                {{ $item->bags }} bag{{ $item->bags == 1 ? '' : 's' }}
                <span style="color:#CBD5E1; margin:0 4px;">·</span>
                1 bag = 450 ml
            </div>

            {{-- fill bar --}}
            <div style="background:#F1F5F9; border-radius:999px; height:6px; overflow:hidden;">
                <div style="width:{{ $fillPct }}%; height:100%; background:{{ $barColor }}; border-radius:999px; transition:width 0.4s;"></div>
            </div>
            <div style="font-size:10px; color:#94A3B8; font-weight:600; margin-top:5px; text-align:right;">
                {{ round($fillPct) }}% of 5,000 ml target
            </div>
        </div>
        @endforeach
    </div>

    <!-- RECENT BLOOD DONATIONS (Scrollable Table) -->
    <div style="margin-top:40px; margin-bottom: 50px;">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
            <h2 style="font-size:20px; font-weight:800; color: #111; margin:0;">All Blood Donations</h2>
            <a href="{{ route('admin.donations') }}" style="color:#ef4444; font-weight:700; font-size:13px; text-decoration:none;">View All →</a>
        </div>

        <div style="background:#fff; border-radius:12px; box-shadow:0 10px 25px rgba(0,0,0,0.03); border: 1px solid #e2e8f0; overflow-x: auto; width: 100%;">
            <table style="width:100%; border-collapse: collapse; min-width: 700px;">
                <thead>
                    <tr style="background:#f8fafc; border-bottom: 1px solid #e2e8f0;">
                        <th style="padding:18px; text-align:left; font-size: 11px; color: #64748b; text-transform: uppercase; letter-spacing: 1px;">Donor</th>
                        <th style="padding:18px; text-align:center; font-size: 11px; color: #64748b; text-transform: uppercase; letter-spacing: 1px;">Blood Type & Volume</th>
                        <th style="padding:18px; text-align:center; font-size: 11px; color: #64748b; text-transform: uppercase; letter-spacing: 1px;">Date</th>
                        <th style="padding:18px; text-align:center; font-size: 11px; color: #64748b; text-transform: uppercase; letter-spacing: 1px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentDonations as $donation)
                    <tr style="border-bottom: 1px solid #f1f5f9;">
                        <td style="padding:18px;">
                            <div style="font-weight: 700; color: #111;">{{ $donation->user->name ?? 'Unknown' }}</div>
                            <div style="font-size: 12px; color: #94a3b8;">{{ $donation->user->email ?? '' }}</div>
                        </td>
                        <td style="padding:18px; text-align: center;">
                            <span style="font-weight: 800; color: #10b981; background: rgba(16, 185, 129, 0.1); padding: 4px 12px; border-radius: 6px; border: 1px solid rgba(16, 185, 129, 0.2); display: inline-block;">
                                {{ $donation->blood_type }}
                            </span>
                            <div style="font-size: 12px; color: #64748b; font-weight: 600;">{{ number_format($donation->units) }} ml</div>
                        </td>
                        <td style="padding:18px; text-align: center; color: #64748b; font-size: 13px; font-weight: 600;">
                            {{ $donation->created_at->format('M d, Y') }}
                        </td>
                        <td style="padding:18px; text-align:center;">
                            <a href="{{ route('admin.donation.detail', $donation->id) }}"
                               style="display:inline-flex; align-items:center; gap:5px; background:#F1F5F9; color:#374151; text-decoration:none; padding:6px 14px; border-radius:8px; font-size:12px; font-weight:700; transition:background 0.2s;"
                               onmouseover="this.style.background='#E2E8F0'" onmouseout="this.style.background='#F1F5F9'">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                View
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" style="padding: 40px; text-align: center; color: #94a3b8; font-weight: 600;">No recent donations recorded.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
</x-layout>