<x-layout>

<style>
    .dashboard-card {
        background: #fff;
        padding: 24px;
        border-radius: 12px;
        border-left: 5px solid var(--red, #ef4444);
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        transition: all 0.25s ease;
    }

    .dashboard-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 25px rgba(0,0,0,0.12);
    }

    .blood-card {
        background: #fff;
        padding: 20px;
        border-radius: 12px;
        text-align: center;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        border-left: 5px solid var(--red, #ef4444);
        transition: all 0.25s ease;
    }

    .blood-card:hover {
        transform: translateY(-6px) scale(1.03);
        box-shadow: 0 12px 25px rgba(0,0,0,0.15);
        cursor: pointer;
    }

    .action-icon {
        font-size: 24px;
    }

    .profile-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #ef4444;
        background: #f1f5f9;
    }
</style>

<div style="font-family: 'DM Sans', sans-serif; padding: 40px; background-color: #f8fafc; min-height: 100vh;">

    <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 5px;">
        @if(auth()->user()->profile_photo)
            <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}" class="profile-avatar">
        @else
            <div class="profile-avatar" style="display: flex; align-items: center; justify-content: center; font-size: 24px; color: #cbd5e1;">👤</div>
        @endif
        
        <div>
            <h1 style="font-size: 28px; font-weight: 700; margin: 0;">
                Welcome back, {{ auth()->user()->name }}!
            </h1>
            <p style="color:#666; margin: 0;">Blood Bank Overview Dashboard</p>
        </div>
    </div>

    <div style="display:grid; grid-template-columns: repeat(3, 1fr); gap:20px; margin-top:25px;">

        <a href="{{ route('donors.records') }}" style="text-decoration:none;">
            <div class="dashboard-card">
                <div style="font-size:14px; color:#888;">Total Donors</div>
                <div style="font-size:32px; font-weight:700; color: #1e293b;">{{ $totalDonors }}</div>
            </div>
        </a>

        <a href="{{ route('donors.records') }}" style="text-decoration:none;">
            <div class="dashboard-card">
                <div style="font-size:14px; color:#888;">Blood Units</div>
                <div style="font-size:32px; font-weight:700; color: #1e293b;">{{ $totalUnits }}</div>
            </div>
        </a>

        <a href="{{ route('blood-requests.index') }}" style="text-decoration:none;">
            <div class="dashboard-card">
                <div style="font-size:14px; color:#888;">Pending Requests</div>
                <div style="font-size:32px; font-weight:700; color: #1e293b;">{{ $pendingRequests }}</div>
            </div>
        </a>

    </div>

    <div style="margin-top:40px;">
        <h2 style="font-size:20px; font-weight:700; margin-bottom:15px;">Quick Actions</h2>
        
        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:20px;">
            
            <a href="{{ route('donations.index') }}" style="text-decoration:none;">
                <div class="dashboard-card" style="display: flex; align-items: center; justify-content: space-between;">
                    <div style="text-align: left;">
                        <div style="font-size:18px; font-weight:700; color: #1e293b;">Want to Donate?</div>
                        <div style="font-size:13px; color:#64748b;">Register as a donor and save lives today.</div>
                    </div>
                    <div class="action-icon">🩸</div>
                </div>
            </a>

            <a href="{{ route('blood-requests.index') }}" style="text-decoration:none;">
                <div class="dashboard-card" style="display: flex; align-items: center; justify-content: space-between;">
                    <div style="text-align: left;">
                        <div style="font-size:18px; font-weight:700; color: #1e293b;">Want to Request?</div>
                        <div style="font-size:13px; color:#64748b;">Submit a request for blood units.</div>
                    </div>
                    <div class="action-icon">📋</div>
                </div>
            </a>

        </div>
    </div>

    <div style="margin-top:40px;">
        <h2 style="font-size:20px; font-weight:700; margin-bottom:15px;">
            Blood Types in System
        </h2>

        <div style="display:grid; grid-template-columns: repeat(4, 1fr); gap:15px;">

            @forelse($bloodTypes as $type)
                <a href="{{ route('donors.records') }}" style="text-decoration:none;">
                    <div class="blood-card">
                        <div style="font-size:22px; font-weight:700; color:#ef4444;">
                            {{ $type->blood_type }}
                        </div>
                        <div style="font-size:14px; color:#333; font-weight:600;">
                            {{ $type->total }} donors
                        </div>
                    </div>
                </a>
            @empty
                <div style="color:#888; grid-column: span 4;">No blood types available yet.</div>
            @endforelse

        </div>
    </div>

</div>

</x-layout>