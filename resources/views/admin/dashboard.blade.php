<x-layout>
<div style="padding:40px; font-family: 'DM Sans', sans-serif; background-color: #f8fafc; min-height: 100vh;">

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <div>
            <h1 style="font-size:28px; font-weight:700; color: #1e293b; margin: 0;">Admin Dashboard</h1>
            <p style="color:#64748b; margin: 5px 0 0 0;">Welcome, {{ auth()->user()->name }}</p>
        </div>
        
        <div style="display: flex; gap: 12px;">
            <a href="{{ route('admin.users') }}" style="background: #fff; color: #1e293b; border: 1px solid #e2e8f0; padding: 10px 18px; border-radius: 10px; text-decoration: none; font-weight: 600; font-size: 14px; transition: 0.2s; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                👥 Manage Users
            </a>
            <a href="{{ route('admin.inventory') }}" style="background: #1e293b; color: white; padding: 10px 18px; border-radius: 10px; text-decoration: none; font-weight: 600; font-size: 14px; transition: 0.2s; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                📦 Blood Inventory
            </a>
            <a href="{{ route('admin.reports') }}" style="background: #fff; color: #1e293b; border: 1px solid #e2e8f0; padding: 10px 18px; border-radius: 10px; text-decoration: none; font-weight: 600; font-size: 14px; transition: 0.2s;">
                📊 Activity Reports
            </a>
        </div>
    </div>

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

    <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:20px;">
        <div style="background:#fff; padding:25px; border-radius:12px; box-shadow:0 4px 6px rgba(0,0,0,0.05); border-left: 5px solid #ef4444;">
            <h3 style="font-size: 12px; color: #888; text-transform: uppercase; letter-spacing: 1px;">Total Users</h3>
            <p style="font-size:32px; font-weight:800; color: #1e293b; margin: 10px 0 0 0;">{{ \App\Models\User::count() }}</p>
        </div>

        <div style="background:#fff; padding:25px; border-radius:12px; box-shadow:0 4px 6px rgba(0,0,0,0.05); border-left: 5px solid #10b981;">
            <h3 style="font-size: 12px; color: #888; text-transform: uppercase; letter-spacing: 1px;">Total Donations</h3>
            <p style="font-size:32px; font-weight:800; color: #1e293b; margin: 10px 0 0 0;">{{ \App\Models\Donation::count() }}</p>
        </div>

        <div style="background:#fff; padding:25px; border-radius:12px; box-shadow:0 4px 6px rgba(0,0,0,0.05); border-left: 5px solid #3b82f6;">
            <h3 style="font-size: 12px; color: #888; text-transform: uppercase; letter-spacing: 1px;">Blood Requests</h3>
            <p style="font-size:32px; font-weight:800; color: #1e293b; margin: 10px 0 0 0;">{{ \App\Models\BloodRequest::count() }}</p>
        </div>
    </div>

    <div style="margin-top:40px;">
        <h2 style="font-size:20px; font-weight:700; margin-bottom:20px; color: #1e293b;">Blood Requests Management</h2>

        <div style="background:#fff; border-radius:16px; box-shadow:0 4px 6px rgba(0,0,0,0.05); overflow:hidden; border: 1px solid #e2e8f0;">
            <table style="width:100%; border-collapse: collapse;">
                <thead>
                    <tr style="background:#f8fafc; border-bottom: 1px solid #e2e8f0;">
                        <th style="padding:18px; text-align:left; font-size: 12px; color: #64748b; text-transform: uppercase;">User</th>
                        <th style="padding:18px; text-align:left; font-size: 12px; color: #64748b; text-transform: uppercase;">Blood Type & Units</th>
                        <th style="padding:18px; text-align:left; font-size: 12px; color: #64748b; text-transform: uppercase;">Status</th>
                        <th style="padding:18px; text-align:left; font-size: 12px; color: #64748b; text-transform: uppercase;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(\App\Models\BloodRequest::with('user')->latest()->get() as $req)
                    @php
                        // Stock Calculation Logic
                        $donated = \App\Models\Donation::where('blood_type', $req->blood_type)->sum('units');
                        $taken = \App\Models\BloodRequest::where('blood_type', $req->blood_type)->where('status', 'approved')->sum('units');
                        $available = $donated - $taken;
                        $canApprove = $available >= $req->units;
                    @endphp
                    <tr style="border-bottom: 1px solid #f1f5f9;">
                        <td style="padding:18px;">
                            <div style="font-weight: 600; color: #1e293b;">{{ $req->user->name ?? 'Unknown' }}</div>
                        </td>
                        <td style="padding:18px;">
                            <span style="font-weight: 800; color: #ef4444; background: #fee2e2; padding: 4px 8px; border-radius: 6px;">{{ $req->blood_type }}</span>
                            <div style="font-size: 11px; color: #64748b; margin-top: 5px;">{{ number_format($req->units) }} ml requested</div>
                        </td>
                        <td style="padding:18px;">
                            @if($req->status === 'pending' && !$canApprove)
                                <span style="font-size: 10px; font-weight: 800; background: #fff7ed; color: #c2410c; padding: 5px 10px; border-radius: 20px; border: 1px solid #ffedd5;">
                                    ⚠️ LOW STOCK ({{ number_format($available) }}ml left)
                                </span>
                            @else
                                <span style="font-size: 11px; font-weight: 800; text-transform: uppercase; padding: 5px 12px; border-radius: 20px;
                                    {{ $req->status === 'approved' ? 'background:#dcfce7; color:#166534;' : ($req->status === 'rejected' ? 'background:#fee2e2; color:#991b1b;' : 'background:#fef9c3; color:#854d0e;') }}">
                                    {{ $req->status ?? 'Pending' }}
                                </span>
                            @endif
                        </td>
                        <td style="padding:18px;">
                            <div style="display:flex; gap:10px;">
                                @if($req->status === 'pending' || is_null($req->status))
                                    <form method="POST" action="{{ route('admin.request.approve', $req->id) }}">
                                        @csrf
                                        <button 
                                            {{ !$canApprove ? 'disabled' : '' }}
                                            style="background: {{ $canApprove ? '#10b981' : '#cbd5e1' }}; color:white; border:none; padding:8px 14px; border-radius:8px; cursor:{{ $canApprove ? 'pointer' : 'not-allowed' }}; font-weight: 600; transition: 0.2s;">
                                            Approve
                                        </button>
                                    </form>

                                    <form method="POST" action="{{ route('admin.request.reject', $req->id) }}">
                                        @csrf
                                        <button style="background:#ef4444; color:white; border:none; padding:8px 14px; border-radius:8px; cursor:pointer; font-weight: 600; transition: 0.2s;">Reject</button>
                                    </form>
                                @else
                                    <span style="color: #94a3b8; font-size: 12px; font-style: italic;">Processed</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</x-layout>