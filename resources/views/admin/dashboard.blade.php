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
            <a href="{{ route('admin.reports') }}" style="background: #fff; color: #1e293b; border: 1px solid #e2e8f0; padding: 10px 18px; border-radius: 10px; text-decoration: none; font-weight: 600; font-size: 14px; transition: 0.2s; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                 Activity Reports
            </a>
        </div>
    </div>

    <!-- NOTIFICATIONS -->
    @if(session('error'))
        <div style="background: #fee2e2; color: #b91c1c; padding: 15px; border-radius: 10px; margin-bottom: 20px; border: 1px solid #fecaca; font-weight: 600;">
            ⚠️ {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div style="background: #dcfce7; color: #15803d; padding: 15px; border-radius: 10px; margin-bottom: 20px; border: 1px solid #bbf7d0; font-weight: 600;">
            ✅ {{ session('success') }}
        </div>
    @endif

    <!-- STATS OVERVIEW (Cards) -->
    <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:20px; margin-bottom: 30px;">
        <div style="background:#fff; padding:25px; border-radius:16px; box-shadow:0 4px 15px rgba(0,0,0,0.05); border-left: 6px solid #ef4444;">
            <h3 style="font-size: 11px; color: #888; text-transform: uppercase; letter-spacing: 1.5px; font-weight: 800;">Total Users</h3>
            <p style="font-size:36px; font-weight:800; color: #1e293b; margin: 10px 0 0 0;">{{ \App\Models\User::count() }}</p>
        </div>

        <div style="background:#fff; padding:25px; border-radius:166x; box-shadow:0 4px 15px rgba(0,0,0,0.05); border-left: 6px solid #10b981;">
            <h3 style="font-size: 11px; color: #888; text-transform: uppercase; letter-spacing: 1.5px; font-weight: 800;">Total Donations</h3>
            <p style="font-size:36px; font-weight:800; color: #1e293b; margin: 10px 0 0 0;">{{ \App\Models\Donation::count() }}</p>
        </div>

        <div style="background:#fff; padding:25px; border-radius:16px; box-shadow:0 4px 15px rgba(0,0,0,0.05); border-left: 6px solid #3b82f6;">
            <h3 style="font-size: 11px; color: #888; text-transform: uppercase; letter-spacing: 1.5px; font-weight: 800;">Blood Requests</h3>
            <p style="font-size:36px; font-weight:800; color: #1e293b; margin: 10px 0 0 0;">{{ \App\Models\BloodRequest::count() }}</p>
        </div>
    </div>

    <!-- BLOOD INVENTORY SECTION -->
    <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 20px;">
        <span style="font-size: 24px;">🩸</span>
        <h2 style="font-size:20px; font-weight:800; color: #1e293b; margin:0;">Blood Bank Inventory</h2>
    </div>

    <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:15px; margin-bottom:40px;">
        @foreach($inventory as $item)
        <div style="background:#fff; padding:20px; border-radius:12px; box-shadow:0 2px 8px rgba(0,0,0,0.04); border: 1px solid #e2e8f0; text-align:center;">
            <span style="font-weight: 900; color: #c44040; font-size: 24px;">{{ $item->type }}</span>
            <p style="font-size:18px; font-weight:700; color: #1e293b; margin: 5px 0;">{{ number_format($item->stock) }} <span style="font-size: 12px; color: #94a3b8;">ml</span></p>
            <div style="display: flex; align-items: center; justify-content: center; gap: 6px; margin-top: 10px;">
                <div style="width: 8px; height: 8px; border-radius: 50%; background: {{ $item->status === 'Low' ? '#ef4444' : '#10b981' }};"></div>
                <span style="font-size: 10px; font-weight: 800; text-transform: uppercase; color: {{ $item->status === 'Low' ? '#ef4444' : '#10b981' }};">
                    {{ $item->status }}
                </span>
            </div>
        </div>
        @endforeach
    </div>

    <!-- RECENT BLOOD DONATIONS (Scrollable Table) -->
    <div style="margin-top:40px; margin-bottom: 50px;">
        <h2 style="font-size:20px; font-weight:800; margin-bottom:20px; color: #111;">Recent Blood Donations</h2>

        <div style="background:#fff; border-radius:12px; box-shadow:0 10px 25px rgba(0,0,0,0.03); border: 1px solid #e2e8f0; overflow-x: auto; width: 100%;">
            <table style="width:100%; border-collapse: collapse; min-width: 700px;">
                <thead>
                    <tr style="background:#f8fafc; border-bottom: 1px solid #e2e8f0;">
                        <th style="padding:18px; text-align:left; font-size: 11px; color: #64748b; text-transform: uppercase; letter-spacing: 1px;">Donor</th>
                        <th style="padding:18px; text-align:center; font-size: 11px; color: #64748b; text-transform: uppercase; letter-spacing: 1px;">Blood Type & Volume</th>
                        <th style="padding:18px; text-align:center; font-size: 11px; color: #64748b; text-transform: uppercase; letter-spacing: 1px;">Date</th>
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