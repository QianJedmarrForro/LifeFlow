<x-layout>
<style>
    * { transition: all 0.18s ease-in-out; box-sizing: border-box; }

    .blood-req-container {
        font-family: 'DM Sans', -apple-system, BlinkMacSystemFont, sans-serif;
        padding: 40px;
        min-height: 100vh;
        background: linear-gradient(180deg, #f8fafc 0%, #eef2ff 100%);
        color: #0f172a;
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        gap: 24px;
        align-items: flex-start;
        margin-bottom: 30px;
    }

    .hero-copy { max-width: 640px; }

    .hero-title {
        font-size: 42px;
        font-weight: 900;
        margin: 0;
        line-height: 1.05;
        letter-spacing: -0.6px;
        color: #0f172a;
    }

    .hero-subtitle {
        margin-top: 16px;
        color: #475569;
        font-size: 15px;
        line-height: 1.75;
    }

    .hero-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-top: 24px;
    }

    .btn-secondary {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: rgba(15, 23, 42, 0.06);
        color: #0f172a;
        padding: 12px 18px;
        border-radius: 14px;
        font-weight: 700;
        text-decoration: none;
    }

    .metrics-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 18px;
        margin-bottom: 36px;
    }

    .metric-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 22px;
        padding: 28px 24px;
        box-shadow: 0 14px 35px rgba(15, 23, 42, 0.06);
        position: relative;
        overflow: hidden;
    }

    .metric-card.pending { border-left: 4px solid #f59e0b; }
    .metric-card.approved { border-left: 4px solid #10b981; }
    .metric-card.rejected { border-left: 4px solid #ef4444; }

    .metric-icon { font-size: 32px; margin-bottom: 14px; }

    .metric-label {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #475569;
        margin-bottom: 10px;
    }

    .metric-value {
        font-size: 36px;
        font-weight: 900;
        color: #111827;
        line-height: 1;
    }

    .metric-note { margin-top: 10px; font-size: 13px; color: #64748b; }

    .requests-panels {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    .top-stats-row {
        display: grid;
        grid-template-columns: 1fr 1.5fr;
        gap: 20px;
    }

    .requests-main, .summary-card, .urgent-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 24px;
        box-shadow: 0 24px 40px rgba(15, 23, 42, 0.08);
    }

    .requests-main { overflow: hidden; width: 100%; }

    .requests-main header {
        padding: 28px 32px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 16px;
        border-bottom: 1px solid #f1f5f9;
    }

    .requests-title { font-size: 24px; font-weight: 900; margin: 0; color: #111827; }

    .filter-group { display: flex; gap: 12px; flex-wrap: wrap; align-items: center; }

    .status-filter {
        min-width: 170px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        color: #0f172a;
        padding: 12px 16px;
        font-size: 13px;
        font-weight: 700;
        outline: none;
    }

    .requests-table-wrapper { overflow-x: hidden; width: 100%; }

    .requests-table { 
        width: 100%; 
        border-collapse: collapse; 
        table-layout: auto;
    }

    .requests-table thead { background: #f8fafc; }

    .requests-table thead th {
        padding: 14px 12px;
        text-align: left;
        font-size: 10px;
        font-weight: 800;
        text-transform: uppercase;
        color: #64748b;
        letter-spacing: 1px;
        border-bottom: 1px solid #e2e8f0;
    }

    .requests-table tbody tr:hover { background: #f5f8ff; }

    .requests-table td { 
        padding: 12px; 
        color: #475569; 
        font-size: 12px; 
        vertical-align: middle; 
    }

    .patient-name { font-weight: 800; color: #111827; font-size: 13px; }

    .patient-meta { display: flex; flex-direction: column; gap: 1px; font-size: 11px; color: #64748b; }

    .blood-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 42px;
        height: 42px;
        border-radius: 12px;
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
        font-weight: 900;
        font-size: 13px;
        box-shadow: 0 6px 12px rgba(239, 68, 68, 0.2);
    }

    .info-row { display: flex; flex-direction: column; gap: 1px; }
    .info-value { font-weight: 700; color: #111827; font-size: 12px; }
    .info-label { font-size: 10px; color: #94a3b8; text-transform: uppercase; }

    .status-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 6px 10px;
        border-radius: 999px;
        font-size: 10px;
        font-weight: 800;
        text-transform: uppercase;
    }

    .badge-pending { background: #fef3c7; color: #92400e; border: 1px solid #fcd34d; }
    .badge-approved { background: #dcfce7; color: #166534; border: 1px solid #bbf7d0; }
    .badge-rejected { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }

    .btn-modern {
        padding: 8px 10px;
        border: none;
        border-radius: 10px;
        font-weight: 800;
        cursor: pointer;
        box-shadow: 0 4px 8px rgba(15, 23, 42, 0.08);
    }

    .btn-approve { background: #22c55e; color: white; }
    .btn-reject { background: #ef4444; color: white; }

    .status-locked {
        padding: 6px 10px;
        background: #f1f5f9;
        color: #64748b;
        border-radius: 8px;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
    }

    .summary-card, .urgent-card { padding: 26px; }
    .summary-card h3, .urgent-card h3 { margin: 0 0 18px; font-size: 18px; font-weight: 900; }

    .insights-row { display: flex; gap: 15px; }

    .stat-block {
        flex: 1;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 16px;
        border-radius: 16px;
        background: #f8fafc;
    }

    .stat-label { font-size: 13px; color: #64748b; font-weight: 700; }
    .stat-value { font-size: 20px; font-weight: 900; color: #111827; }

    .urgent-card { border: 1px solid #fecaca; background: #fffbeb; display: flex; flex-direction: column; justify-content: center; }

    .empty-state { padding: 60px; text-align: center; }

    @media (max-width: 1080px) {
        .top-stats-row { grid-template-columns: 1fr; }
    }
</style>

<div class="blood-req-container">
    <div class="section-header">
        <div class="hero-copy">
            <h1 class="hero-title">Blood Requests Center</h1>
            <p class="hero-subtitle">Manage patient requests and monitor blood inventory status in real-time.</p>
        </div>
        <div class="hero-actions">
            <a href="{{ route('blood-requests.index') }}" class="btn-secondary">Refresh List</a>
        </div>
    </div>

    @php
        $pendingCount = \App\Models\BloodRequest::where('status', 'pending')->count();
        $approvedCount = \App\Models\BloodRequest::where('status', 'approved')->count();
        $rejectedCount = \App\Models\BloodRequest::where('status', 'rejected')->count();
        $total = \App\Models\BloodRequest::count();
        $urgent = \App\Models\BloodRequest::where('needed_by', '<=', now()->addDays(2))->where('status', 'pending')->count();
    @endphp

    <div class="metrics-grid">
        <div class="metric-card pending">
            <div class="metric-icon">⏳</div>
            <div class="metric-label">Pending</div>
            <div class="metric-value">{{ $pendingCount }}</div>
            <div class="metric-note">Waiting for action</div>
        </div>
        <div class="metric-card approved">
            <div class="metric-icon">✅</div>
            <div class="metric-label">Approved</div>
            <div class="metric-value">{{ $approvedCount }}</div>
            <div class="metric-note">Successfully allocated</div>
        </div>
        <div class="metric-card rejected">
            <div class="metric-icon">❌</div>
            <div class="metric-label">Rejected</div>
            <div class="metric-value">{{ $rejectedCount }}</div>
            <div class="metric-note">Requests declined</div>
        </div>
    </div>

    <div class="requests-panels">
        <div class="top-stats-row">
            <div class="summary-card">
                <h3>Insights</h3>
                <div class="insights-row">
                    <div class="stat-block">
                        <div>
                            <div class="stat-label">Total Volume</div>
                            <div class="stat-value">{{ $total }}</div>
                        </div>
                    </div>
                    <div class="stat-block">
                        <div>
                            <div class="stat-label">Urgent (48h)</div>
                            <div class="stat-value" style="color:#ef4444;">{{ $urgent }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="urgent-card">
                <h3>Urgent Alerts</h3>
                <div style="display:flex; align-items:center; gap:12px;">
                    <span style="font-size:24px;">⚠️</span>
                    <span style="font-weight:700; color:#92400e;">{{ $urgent }} critical requests need attention.</span>
                </div>
            </div>
        </div>

        <div class="requests-main">
            <header>
                <h2 class="requests-title">Request Queue</h2>
                <div class="filter-group">
                    <form method="GET" id="filterForm">
                        <select name="status" class="status-filter" onchange="this.form.submit()">
                            <option value="">All Statuses</option>
                            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </form>
                </div>
            </header>

            <div class="requests-table-wrapper">
                <table class="requests-table">
                    <thead>
                        <tr>
                            <th>Patient</th>
                            <th style="text-align:center;">Type</th>
                            <th>Units</th>
                            <th>Location</th>
                            <th>Deadline</th>
                            <th style="text-align:center;">Status</th>
                            <th style="text-align:center;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($requests as $req)
                            @php
                                $daysLeft = \Carbon\Carbon::parse($req->needed_by)->diffInDays(now(), false);
                                $isCritical = $daysLeft < 1;
                            @endphp
                            <tr>
                                <td>
                                    <div class="info-row">
                                        <span class="patient-name">{{ $req->patient_name }}</span>
                                        <span class="patient-meta">{{ $req->patient_age ?? 'N/A' }} yrs • {{ $req->contact_number }}</span>
                                    </div>
                                </td>
                                <td style="text-align:center;">
                                    <div class="blood-badge">{{ $req->blood_type }}</div>
                                </td>
                                <td>
                                    <div class="info-row">
                                        <span class="info-value">{{ number_format($req->units) }} ml</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="info-row">
                                        <span class="info-value">{{ $req->hospital }}</span>
                                        <span class="info-label">{{ $req->department }}</span>
                                    </div>
                                </td>
                                <td style="color: {{ $isCritical ? '#ef4444' : 'inherit' }}; font-weight: {{ $isCritical ? '800' : '500' }}">
                                    {{ \Carbon\Carbon::parse($req->needed_by)->format('M d, h:i A') }}
                                </td>
                                <td style="text-align:center;">
                                    <span class="status-badge badge-{{ strtolower($req->status) }}">{{ $req->status }}</span>
                                </td>
                                <td style="text-align:center;">
                                    @if(strtolower($req->status) === 'pending')
                                        <div style="display:flex; gap:6px; justify-content:center;">
                                            <form action="{{ route('blood-requests.approve', $req->id) }}" method="POST" class="action-form">
                                                @csrf
                                                <button class="btn-modern btn-approve" onclick="return confirm('Approve this?')">✓</button>
                                            </form>
                                            <form action="{{ route('blood-requests.reject', $req->id) }}" method="POST" class="action-form">
                                                @csrf
                                                <button class="btn-modern btn-reject" onclick="return confirm('Reject this?')">✕</button>
                                            </form>
                                        </div>
                                    @else
                                        <span class="status-locked">{{ strtoupper($req->status) }}</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="empty-state">No requests found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var scrollpos = localStorage.getItem('scrollpos');
        if (scrollpos) window.scrollTo(0, scrollpos);
    });

    window.onbeforeunload = function(e) {
        localStorage.setItem('scrollpos', window.scrollY);
    };
</script>
</x-layout> q