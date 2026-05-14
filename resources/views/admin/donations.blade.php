<x-layout>
<div style="padding:40px; font-family: 'DM Sans', sans-serif; min-height: 100vh; background-color: #f8fafc;">

    <!-- HEADER -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <div>
            <h1 style="font-size:28px; font-weight:800; color: #111; margin: 0;">Manage Donations</h1>
            <p style="color:#64748b; margin: 5px 0 0 0;">All blood donation records in the system.</p>
        </div>
        <div style="display: flex; gap: 12px;">
            <a href="{{ route('admin.dashboard') }}" style="background: #fff; color: #1e293b; border: 1px solid #e2e8f0; padding: 10px 18px; border-radius: 10px; text-decoration: none; font-weight: 600; font-size: 14px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                ← Back to Dashboard
            </a>
        </div>
    </div>

    <!-- STATS ROW -->
    <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:20px; margin-bottom:30px;">
        <div style="background:#fff; padding:20px 25px; border-radius:14px; border-left:5px solid #ef4444; box-shadow:0 2px 8px rgba(0,0,0,0.04);">
            <div style="font-size:11px; color:#888; text-transform:uppercase; letter-spacing:1.5px; font-weight:800;">Total Donations</div>
            <div style="font-size:32px; font-weight:800; color:#1e293b; margin-top:8px;">{{ $donations->count() }}</div>
        </div>
        <div style="background:#fff; padding:20px 25px; border-radius:14px; border-left:5px solid #10b981; box-shadow:0 2px 8px rgba(0,0,0,0.04);">
            <div style="font-size:11px; color:#888; text-transform:uppercase; letter-spacing:1.5px; font-weight:800;">Total Volume</div>
            <div style="font-size:32px; font-weight:800; color:#1e293b; margin-top:8px;">{{ number_format($donations->sum('units')) }} <span style="font-size:14px; color:#94a3b8; font-weight:600;">ml</span></div>
        </div>
        <div style="background:#fff; padding:20px 25px; border-radius:14px; border-left:5px solid #3b82f6; box-shadow:0 2px 8px rgba(0,0,0,0.04);">
            <div style="font-size:11px; color:#888; text-transform:uppercase; letter-spacing:1.5px; font-weight:800;">Lives Saved (est.)</div>
            <div style="font-size:32px; font-weight:800; color:#1e293b; margin-top:8px;">{{ number_format(floor($donations->sum('units') / 450)) }}</div>
        </div>
    </div>

    <!-- DONATIONS TABLE -->
    <div style="background:#fff; border-radius:14px; box-shadow:0 4px 15px rgba(0,0,0,0.05); border:1px solid #e2e8f0; overflow-x:auto;">
        <table style="width:100%; border-collapse:collapse; min-width:700px;">
            <thead>
                <tr style="background:#f8fafc; border-bottom:2px solid #e2e8f0;">
                    <th style="padding:16px 20px; text-align:left; font-size:11px; color:#64748b; text-transform:uppercase; letter-spacing:1px; font-weight:800;">Donor Name</th>
                    <th style="padding:16px 20px; text-align:left; font-size:11px; color:#64748b; text-transform:uppercase; letter-spacing:1px; font-weight:800;">Email</th>
                    <th style="padding:16px 20px; text-align:center; font-size:11px; color:#64748b; text-transform:uppercase; letter-spacing:1px; font-weight:800;">Blood Type</th>
                    <th style="padding:16px 20px; text-align:center; font-size:11px; color:#64748b; text-transform:uppercase; letter-spacing:1px; font-weight:800;">Volume (ml)</th>
                    <th style="padding:16px 20px; text-align:center; font-size:11px; color:#64748b; text-transform:uppercase; letter-spacing:1px; font-weight:800;">Date</th>
                    <th style="padding:16px 20px; text-align:center; font-size:11px; color:#64748b; text-transform:uppercase; letter-spacing:1px; font-weight:800;">Status</th>
                    <th style="padding:16px 20px; text-align:center; font-size:11px; color:#64748b; text-transform:uppercase; letter-spacing:1px; font-weight:800;">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($donations as $donation)
                <tr style="border-bottom:1px solid #f1f5f9; transition:background 0.15s;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background=''">
                    <td style="padding:16px 20px;">
                        <div style="font-weight:700; color:#111; font-size:14px;">{{ $donation->user->name ?? 'Unknown' }}</div>
                    </td>
                    <td style="padding:16px 20px; color:#64748b; font-size:13px;">{{ $donation->user->email ?? '—' }}</td>
                    <td style="padding:16px 20px; text-align:center;">
                        <span style="background:linear-gradient(135deg,#ef4444,#dc2626); color:white; padding:5px 12px; border-radius:8px; font-weight:800; font-size:13px;">
                            {{ $donation->blood_type }}
                        </span>
                    </td>
                    <td style="padding:16px 20px; text-align:center; font-weight:700; color:#1e293b; font-size:14px;">
                        {{ number_format($donation->units) }}
                    </td>
                    <td style="padding:16px 20px; text-align:center; color:#64748b; font-size:13px; font-weight:600;">
                        {{ $donation->created_at->format('M d, Y') }}
                    </td>
                    <td style="padding:16px 20px; text-align:center;">
                        @php $s = strtolower($donation->status ?? 'approved'); @endphp
                        <span style="
                            padding:5px 12px; border-radius:999px; font-size:11px; font-weight:800; text-transform:uppercase;
                            {{ in_array($s, ['approved','completed']) ? 'background:#dcfce7; color:#166534; border:1px solid #bbf7d0;' : 'background:#fef9c3; color:#854d0e; border:1px solid #fef08a;' }}
                        ">
                            {{ $donation->status ?? 'approved' }}
                        </span>
                    </td>
                    <td style="padding:16px 20px; text-align:center;">
                        <a href="{{ route('admin.donation.detail', $donation->id) }}"
                           style="display:inline-flex; align-items:center; gap:6px; background:#F1F5F9; color:#374151; text-decoration:none; padding:7px 14px; border-radius:8px; font-size:12px; font-weight:700; transition:background 0.2s;"
                           onmouseover="this.style.background='#E2E8F0'" onmouseout="this.style.background='#F1F5F9'">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            View
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="padding:60px; text-align:center; color:#94a3b8; font-weight:600;">
                        No donation records found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
</x-layout>
