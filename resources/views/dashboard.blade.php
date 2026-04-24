<x-layout>

<style>
.dashboard-card {
    background:#fff;
    padding:24px;
    border-radius:12px;
    border-left:5px solid var(--red);
    box-shadow:0 4px 6px rgba(0,0,0,0.05);
    transition: all 0.25s ease;
}

.dashboard-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 25px rgba(0,0,0,0.12);
}

.blood-card {
    background:#fff;
    padding:20px;
    border-radius:12px;
    text-align:center;
    box-shadow:0 4px 6px rgba(0,0,0,0.05);
    border-left:5px solid var(--red);
    transition: all 0.25s ease;
}

.blood-card:hover {
    transform: translateY(-6px) scale(1.03);
    box-shadow: 0 12px 25px rgba(0,0,0,0.15);
    cursor: pointer;
}
</style>

<div style="font-family: 'DM Sans', sans-serif; padding: 40px; background-color: #f8fafc; min-height: 100vh;">

    <h1 style="font-size: 28px; font-weight: 700;">
        Welcome back, {{ auth()->user()->name }}!
    </h1>

    <p style="color:#666;">Blood Bank Overview Dashboard</p>

    <div style="display:grid; grid-template-columns: repeat(3, 1fr); gap:20px; margin-top:25px;">

        <a href="{{ route('donors.records') }}" style="text-decoration:none;">
            <div class="dashboard-card">
                <div style="font-size:14px; color:#888;">Total Donors</div>
                <div style="font-size:32px; font-weight:700;">{{ $totalDonors }}</div>
            </div>
        </a>

        <a href="{{ route('donors.records') }}" style="text-decoration:none;">
            <div class="dashboard-card">
                <div style="font-size:14px; color:#888;">Blood Units</div>
                <div style="font-size:32px; font-weight:700;">{{ $totalUnits }}</div>
            </div>
        </a>

        <a href="{{ route('blood-requests.index') }}" style="text-decoration:none;">
            <div class="dashboard-card">
                <div style="font-size:14px; color:#888;">Pending Requests</div>
                <div style="font-size:32px; font-weight:700;">{{ $pendingRequests }}</div>
            </div>
        </a>

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
                <div style="color:#888;">No blood types available yet.</div>
            @endforelse

        </div>
    </div>

</div>

</x-layout>