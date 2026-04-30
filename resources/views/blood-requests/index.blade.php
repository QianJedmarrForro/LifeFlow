<x-layout>
<style>
    .admin-container { font-family: 'DM Sans', sans-serif; padding: 40px; background-color: #f8fafc; min-height: 100vh; }
    
    /* Inventory Cards */
    .inventory-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 40px; }
    .inventory-card { background: white; padding: 20px; border-radius: 16px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); text-align: center; transition: 0.3s; }
    .inventory-card:hover { transform: translateY(-5px); box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1); }
    .type-label { color: #ef4444; font-weight: 800; font-size: 14px; text-transform: uppercase; margin-bottom: 5px; }
    .amount-value { font-size: 24px; font-weight: 700; color: #1e293b; }
    .progress-bg { width: 100%; background: #f1f5f9; height: 8px; border-radius: 10px; margin-top: 15px; overflow: hidden; }
    
    /* Global Card Style */
    .lf-card { background: white; border-radius: 16px; padding: 30px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); border: 1px solid #e2e8f0; margin-bottom: 40px; }
    
    /* Table Styling */
    .request-table { width: 100%; border-collapse: collapse; }
    .request-table th { text-align: left; padding: 12px; background: #f8fafc; color: #475569; font-size: 12px; text-transform: uppercase; border-bottom: 1px solid #e2e8f0; }
    .request-table td { padding: 16px 12px; border-bottom: 1px solid #f1f5f9; font-size: 14px; }
    
    /* Status & Buttons */
    .status-badge { padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: 700; text-transform: uppercase; }
    .status-pending { background: #fef9c3; color: #854d0e; }
    .status-approved { background: #dcfce7; color: #166534; }
    .status-rejected { background: #fee2e2; color: #991b1b; }
    
    .btn-action { padding: 8px 14px; border-radius: 8px; font-weight: 600; cursor: pointer; border: none; transition: 0.2s; font-size: 13px; text-decoration: none; display: inline-block; }
    .btn-approve { background: #22c55e; color: white; }
    .btn-reject { background: #ef4444; color: white; }
    .btn-approve:hover { background: #16a34a; }
    .btn-reject:hover { background: #dc2626; }

    /* Donor Grid */
    .donor-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px; }
    .donor-card { border: 1px solid #f1f5f9; padding: 20px; border-radius: 16px; display: flex; align-items: center; gap: 15px; background: #fff; transition: 0.3s; }
    .donor-card:hover { border-color: #ef4444; background: #fffcfc; }
</style>

<div class="admin-container">
    <div style="margin-bottom: 30px; display: flex; justify-content: space-between; align-items: flex-end;">
        <div>
            <h1 style="font-family: Serif; font-size: 32px; color: #1e293b; margin: 0;">Blood Bank Management</h1>
            <p style="color: #64748b; margin-top: 5px;">Control inventory, approve requests, and contact donors.</p>
        </div>
        <div style="text-align: right; font-size: 14px; color: #64748b; font-weight: 600;">
            Admin Session: {{ auth()->user()->name }} 🛡️
        </div>
    </div>

    <div class="inventory-grid">
        @foreach($inventory as $type => $amount)
        <div class="inventory-card">
            <div class="type-label">{{ $type }}</div>
            <div class="amount-value">{{ number_format($amount) }} <span style="font-size: 12px; color: #94a3b8;">ml</span></div>
            <div class="progress-bg">
                @php 
                    $percentage = min(($amount / 5000) * 100, 100); 
                    $color = $amount < 1000 ? '#ef4444' : ($amount < 2500 ? '#f59e0b' : '#22c55e');
                @endphp
                <div style="width: {{ $percentage }}%; background: {{ $color }}; height: 100%; transition: 0.8s ease-out;"></div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="lf-card">
        <h2 style="margin-bottom: 20px; color: #1e293b; font-size: 20px; display: flex; align-items: center; gap: 10px;">
            🩸 Incoming Requests
        </h2>
        
        <table class="request-table">
            <thead>
                <tr>
                    <th>Patient Details</th>
                    <th>Blood Type</th>
                    <th>Req. Volume</th>
                    <th>Hospital</th>
                    <th>Status</th>
                    <th>Management</th>
                </tr>
            </thead>
            <tbody>
                @forelse($requests as $req)
                <tr>
                    <td>
                        <div style="font-weight: 700; color: #1e293b;">{{ $req->patient_name }}</div>
                        <div style="font-size: 11px; color: #94a3b8;">Needed By: {{ \Carbon\Carbon::parse($req->needed_by)->format('M d, Y') }}</div>
                    </td>
                    <td><strong style="color: #ef4444; font-size: 16px;">{{ $req->blood_type }}</strong></td>
                    <td>{{ $req->units }}ml</td>
                    <td style="color: #64748b;">{{ $req->hospital }}</td>
                    <td><span class="status-badge status-{{ $req->status }}">{{ $req->status }}</span></td>
                    <td>
                        @if($req->status == 'pending')
                            <div style="display: flex; gap: 8px;">
                                <form action="{{ route('blood-requests.approve', $req->id) }}" method="POST" onsubmit="return confirm('Confirm blood release?')">
                                    @csrf
                                    <button type="submit" class="btn-action btn-approve">Approve</button>
                                </form>
                                <form action="{{ route('blood-requests.reject', $req->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn-action btn-reject">Reject</button>
                                </form>
                            </div>
                        @else
                            <span style="color: #cbd5e1; font-size: 12px; font-style: italic;">No actions required</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" style="text-align: center; padding: 40px; color: #94a3b8;">No blood requests found in the system.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="lf-card">
        <h2 style="margin-bottom: 25px; color: #1e293b; font-size: 20px; display: flex; align-items: center; gap: 10px;">
            👥 Registered Donor Directory
        </h2>

        <div class="donor-grid">
            @foreach($donors as $donor)
            <div class="donor-card">
                @if($donor->profile_photo)
                    <img src="{{ asset('storage/' . $donor->profile_photo) }}" style="width: 55px; height: 55px; border-radius: 50%; object-fit: cover; border: 2px solid #f1f5f9;">
                @else
                    <div style="width: 55px; height: 55px; border-radius: 50%; background: #f8fafc; display: flex; align-items: center; justify-content: center; color: #cbd5e1; font-size: 24px; border: 2px solid #f1f5f9;">👤</div>
                @endif

                <div style="flex: 1;">
                    <div style="font-weight: 700; color: #1e293b; font-size: 15px;">{{ $donor->name }}</div>
                    <div style="display: flex; align-items: center; gap: 5px; margin: 3px 0;">
                        <span style="color: #ef4444; font-weight: 800; font-size: 11px; background: #fee2e2; padding: 1px 6px; border-radius: 4px;">{{ $donor->blood_type ?? '??' }}</span>
                        <span style="font-size: 12px; color: #94a3b8;">{{ $donor->email }}</span>
                    </div>
                    <a href="mailto:{{ $donor->email }}" style="color: #3b82f6; font-size: 11px; font-weight: 700; text-decoration: none; text-transform: uppercase;">Direct Contact</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
</x-layout>