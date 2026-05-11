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

    .hero-copy {
        max-width: 640px;
    }

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

    .btn-primary {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: #3b82f6;
        color: white;
        padding: 12px 18px;
        border-radius: 14px;
        box-shadow: 0 18px 40px rgba(59, 130, 246, 0.18);
        font-weight: 700;
        text-decoration: none;
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

    .metric-card.pending {
        border-left: 4px solid #f59e0b;
    }

    .metric-card.approved {
        border-left: 4px solid #10b981;
    }

    .metric-card.rejected {
        border-left: 4px solid #ef4444;
    }

    .metric-icon {
        font-size: 32px;
        margin-bottom: 14px;
    }

    .metric-label {
        font-size: 12px;
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

    .metric-note {
        margin-top: 10px;
        font-size: 13px;
        color: #64748b;
    }

    .requests-panels {
        display: grid;
        grid-template-columns: 1.9fr 1fr;
        gap: 24px;
        align-items: start;
    }

    .requests-main,
    .summary-card,
    .urgent-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 24px;
        box-shadow: 0 24px 40px rgba(15, 23, 42, 0.08);
    }

    .requests-main {
        overflow: hidden;
    }

    .requests-main header {
        padding: 28px 32px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 16px;
        border-bottom: 1px solid #f1f5f9;
    }

    .requests-title {
        font-size: 24px;
        font-weight: 900;
        margin: 0;
        color: #111827;
    }

    .filter-group {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        align-items: center;
    }

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

    .clear-filter {
        background: #eff6ff;
        color: #2563eb;
        border-radius: 14px;
        padding: 12px 16px;
        text-decoration: none;
        font-weight: 700;
    }

    .requests-table-wrapper {
        overflow-x: auto;
    }

    .requests-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 1400px;
    }

    .requests-table thead {
        background: #f8fafc;
    }

    .requests-table thead th {
        padding: 18px 16px;
        text-align: left;
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        color: #64748b;
        letter-spacing: 1px;
        border-bottom: 1px solid #e2e8f0;
    }

    .requests-table tbody tr {
        transition: background 0.2s ease;
    }

    .requests-table tbody tr:hover {
        background: #f5f8ff;
    }

    .requests-table td {
        padding: 16px;
        color: #475569;
        font-size: 13px;
        vertical-align: middle;
    }

    .patient-card {
        display: grid;
        gap: 6px;
    }

    .patient-name {
        font-weight: 800;
        color: #111827;
        font-size: 14px;
    }

    .patient-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        font-size: 12px;
        color: #64748b;
    }

    .blood-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 62px;
        height: 62px;
        border-radius: 18px;
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
        font-weight: 900;
        font-size: 16px;
        box-shadow: 0 20px 35px rgba(239, 68, 68, 0.24);
        margin: auto;
    }

    .info-row {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .info-value {
        font-weight: 700;
        color: #111827;
    }

    .info-label {
        font-size: 11px;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: 0.8px;
    }

    .medical-info {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 14px 16px;
        color: #334155;
        font-size: 13px;
        line-height: 1.6;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 10px 16px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.7px;
        white-space: nowrap;
    }

    .badge-pending {
        background: #fef3c7;
        color: #92400e;
        border: 1px solid #fcd34d;
    }

    .badge-approved {
        background: #dcfce7;
        color: #166534;
        border: 1px solid #bbf7d0;
    }

    .badge-rejected {
        background: #fee2e2;
        color: #991b1b;
        border: 1px solid #fecaca;
    }

    .action-group {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        justify-content: center;
    }

    .btn-modern {
        padding: 10px 14px;
        border: none;
        border-radius: 14px;
        font-weight: 700;
        font-size: 12px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        white-space: nowrap;
        box-shadow: 0 8px 20px rgba(15, 23, 42, 0.08);
    }

    .btn-approve {
        background: #22c55e;
        color: white;
    }

    .btn-reject {
        background: #ef4444;
        color: white;
    }

    .btn-modern:hover {
        transform: translateY(-1px);
        opacity: 0.98;
    }

    .status-locked {
        padding: 10px 14px;
        background: #f1f5f9;
        color: #64748b;
        border-radius: 14px;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
    }

    .summary-card,
    .urgent-card {
        padding: 26px;
    }

    .summary-card h3,
    .urgent-card h3 {
        margin: 0 0 18px;
        font-size: 18px;
        font-weight: 900;
        color: #111827;
    }

    .overview-rows {
        display: grid;
        gap: 18px;
    }

    .stat-block {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        padding: 18px;
        border-radius: 18px;
        background: #f8fafc;
    }

    .stat-label {
        font-size: 13px;
        color: #64748b;
        font-weight: 700;
    }

    .stat-value {
        font-size: 22px;
        font-weight: 900;
        color: #111827;
    }

    .stat-chip {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #eff6ff;
        border-radius: 999px;
        padding: 10px 14px;
        font-size: 12px;
        font-weight: 700;
        color: #2563eb;
    }

    .urgent-card {
        border: 1px solid #fecaca;
        background: #fffbeb;
    }

    .urgent-card p {
        margin: 0;
        font-size: 14px;
        line-height: 1.7;
        color: #7c2d12;
    }

    .empty-state {
        padding: 80px 40px;
        text-align: center;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 24px;
    }

    .empty-icon {
        font-size: 64px;
        margin-bottom: 24px;
        color: #64748b;
    }

    .empty-title {
        font-size: 24px;
        font-weight: 800;
        color: #111827;
        margin-bottom: 10px;
    }

    .empty-text {
        color: #64748b;
        font-size: 15px;
        line-height: 1.7;
    }

    @media (max-width: 1080px) {
        .requests-panels {
            grid-template-columns: 1fr;
        }

        .section-header,
        .requests-main header {
            flex-direction: column;
            align-items: flex-start;
        }
    }

    @media (max-width: 768px) {
        .blood-req-container {
            padding: 24px;
        }

        .hero-title {
            font-size: 32px;
        }

        .hero-actions {
            width: 100%;
        }

        .metrics-grid {
            grid-template-columns: 1fr;
        }

        .requests-main header {
            padding: 22px;
        }

        .requests-table thead th,
        .requests-table td {
            padding: 12px 10px;
        }

        .blood-badge {
            width: 52px;
            height: 52px;
            font-size: 14px;
        }

        .btn-modern {
            width: 100%;
        }

        .summary-card,
        .urgent-card {
            padding: 22px;
        }
    }
</style>

<div class="blood-req-container">
    <div class="section-header">
        <div class="hero-copy">
            <h1 class="hero-title">Blood Requests Center</h1>
            <p class="hero-subtitle">A clean new admin experience for processing requests, tracking urgency, and keeping blood inventory aligned with patient need.</p>
        </div>
        <div class="hero-actions">
            <a href="{{ route('blood-requests.index') }}" class="btn-secondary">Refresh</a>
        </div>
    </div>

    <div class="metrics-grid">
        <div class="metric-card pending">
            <div class="metric-icon">⏳</div>
            <div class="metric-label">Pending Requests</div>
            <div class="metric-value">
                @php $pendingCount = \App\Models\BloodRequest::where('status', 'pending')->count(); @endphp
                {{ $pendingCount }}
            </div>
            <div class="metric-note">Waiting for approval.</div>
        </div>

        <div class="metric-card approved">
            <div class="metric-icon">✅</div>
            <div class="metric-label">Approved</div>
            <div class="metric-value">
                @php $approvedCount = \App\Models\BloodRequest::where('status', 'approved')->count(); @endphp
                {{ $approvedCount }}
            </div>
            <div class="metric-note">Allocated to patients.</div>
        </div>

        <div class="metric-card rejected">
            <div class="metric-icon">❌</div>
            <div class="metric-label">Rejected</div>
            <div class="metric-value">
                @php $rejectedCount = \App\Models\BloodRequest::where('status', 'rejected')->count(); @endphp
                {{ $rejectedCount }}
            </div>
            <div class="metric-note">Flagged for review.</div>
        </div>
    </div>

    <div class="requests-panels">
        <div class="requests-main">
            <header>
                <h2 class="requests-title">Request Queue</h2>
                <div class="filter-group">
                    <form method="GET" style="display: flex; gap: 12px; flex-wrap: wrap; align-items: center;">
                        <select name="status" class="status-filter" onchange="this.form.submit()">
                            <option value="">All Statuses</option>
                            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>⏳ Pending</option>
                            <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>✅ Approved</option>
                            <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>❌ Rejected</option>
                        </select>
                        <select name="blood_type" class="status-filter" onchange="this.form.submit()">
                            <option value="">All Blood Types</option>
                            @foreach($bloodTypes as $bloodType)
                                <option value="{{ $bloodType }}" {{ request('blood_type') === $bloodType ? 'selected' : '' }}>{{ $bloodType }}</option>
                            @endforeach
                        </select>
                    </form>
                    @if(request('filter'))
                        <a href="{{ route('blood-requests.index') }}" class="clear-filter">Clear</a>
                    @endif
                </div>
            </header>

            <div class="requests-table-wrapper">
                @forelse($requests as $req)
                    @if($loop->first)
                        <table class="requests-table">
                            <thead>
                                <tr>
                                    <th>Patient</th>
                                    <th style="text-align:center;">Blood Type</th>
                                    <th style="text-align:center;">Units</th>
                                    <th>Hospital</th>
                                    <th>Requested On</th>
                                    <th>Needed By</th>
                                    <th style="text-align:center;">Status</th>
                                    <th>Action Date</th>
                                    <th style="text-align:center;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                    @endif

                    @php
                        $donated = \App\Models\Donation::where('blood_type', $req->blood_type)
                                    ->whereIn('status', ['approved', 'completed', 'Approved', 'Completed'])
                                    ->sum('units');
                        $taken = \App\Models\BloodRequest::where('blood_type', $req->blood_type)
                                    ->where('status', 'approved')
                                    ->sum('units');
                        $available = max(0, $donated - $taken);
                        $inventory_percentage = min(($available / max($req->units, 1)) * 100, 100);
                        $daysLeft = \Carbon\Carbon::parse($req->needed_by)->diffInDays(now(), false);
                        $isCritical = $daysLeft < 1;
                        $isUrgent = $daysLeft < 3;
                    @endphp

                    <tr class="{{ $isCritical ? 'urgency-critical' : ($isUrgent ? 'urgency-high' : '') }}">
                        <td>
                            <div class="patient-card">
                                <div class="patient-name">{{ $req->patient_name }}</div>
                                <div class="patient-meta">
                                    <span>{{ $req->patient_age ?? 'N/A' }} yrs</span>
                                    <span>📞 {{ substr($req->contact_number ?? 'N/A', 0, 12) }}</span>
                                </div>
                            </div>
                        </td>
                        <td style="text-align:center;">
                            <div class="blood-badge">{{ $req->blood_type }}</div>
                        </td>
                        <td style="text-align:center;">
                            <div class="info-row">
                                <div class="info-value">{{ number_format($req->units) }} ml</div>
                                <div class="info-label">Requested</div>
                            </div>
                        </td>
                        <td>
                            <div class="info-row">
                                <div class="info-value">{{ $req->hospital ?? 'Unknown' }}</div>
                                <div class="info-label">{{ $req->department ?? 'Department' }}</div>
                            </div>
                        </td>
                        <td>
                            <div style="font-weight:700; color: #0f172a;">
                                {{ \Carbon\Carbon::parse($req->created_at)->format('M d, Y') }}
                            </div>
                            <div style="font-size: 12px; color: #64748b;">
                                {{ \Carbon\Carbon::parse($req->created_at)->format('h:i A') }}
                            </div>
                        </td>
                        <td>
                            <div style="font-weight:700; color: {{ $isCritical ? '#991b1b' : ($isUrgent ? '#92400e' : '#0f172a') }};">
                                {{ \Carbon\Carbon::parse($req->needed_by)->format('M d, h:i A') }}
                            </div>
                        </td>
                        <td style="text-align:center;">
                            <span class="status-badge badge-{{ $req->status }}">
                                {{ ucfirst($req->status) }}
                            </span>
                        </td>
                        <td>
                            @if($req->status !== 'pending')
                                <div style="font-weight:700; color: {{ $req->status === 'approved' ? '#10b981' : '#ef4444' }};">
                                    {{ \Carbon\Carbon::parse($req->updated_at)->format('M d, Y') }}
                                </div>
                                <div style="font-size: 12px; color: #64748b;">
                                    {{ \Carbon\Carbon::parse($req->updated_at)->format('h:i A') }}
                                </div>
                            @else
                                <div style="font-size: 12px; color: #94a3b8;">—</div>
                            @endif
                        </td>
                        <td style="text-align:center;">
                            <div class="action-group">
                                @if($req->status === 'pending')
                                    <form action="{{ route('blood-requests.approve', $req->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn-modern btn-approve" onclick="return confirm('Approve {{ $req->blood_type }} blood for {{ $req->patient_name }}?')" title="Approve">✓</button>
                                    </form>
                                    <form action="{{ route('blood-requests.reject', $req->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn-modern btn-reject" onclick="return confirm('Reject this request?')" title="Reject">✕</button>
                                    </form>
                                @else
                                    <div class="status-locked">{{ ucfirst($req->status) }}</div>
                                @endif
                            </div>
                        </td>
                    </tr>

                    @if($loop->last)
                            </tbody>
                        </table>
                    @endif
                @empty
                    <div class="empty-state">
                        <div class="empty-icon">🩸</div>
                        <div class="empty-title">No Blood Requests</div>
                        <div class="empty-text">All current requests are processed. Great work!</div>
                    </div>
                @endforelse
            </div>
        </div>

        <aside style="display:grid; gap:20px;">
            <div class="summary-card">
                <h3>Overview</h3>
                @php
                    $totalRequests = \App\Models\BloodRequest::count();
                    $urgentCount = \App\Models\BloodRequest::where('needed_by', '<=', \Carbon\Carbon::now()->addDays(2))->count();
                    $topType = \App\Models\BloodRequest::select('blood_type')->groupBy('blood_type')->orderByRaw('count(*) desc')->value('blood_type') ?? 'N/A';
                @endphp
                <div class="overview-rows">
                    <div class="stat-block">
                        <div>
                            <div class="stat-label">Total Requests</div>
                            <div class="stat-value">{{ $totalRequests }}</div>
                        </div>
                        <span class="stat-chip">Top Type: {{ $topType }}</span>
                    </div>
                    <div class="stat-block">
                        <div>
                            <div class="stat-label">Pending</div>
                            <div class="stat-value">{{ $pendingCount }}</div>
                        </div>
                    </div>
                    <div class="stat-block">
                        <div>
                            <div class="stat-label">Approved</div>
                            <div class="stat-value">{{ $approvedCount }}</div>
                        </div>
                    </div>
                    <div class="stat-block">
                        <div>
                            <div class="stat-label">Rejected</div>
                            <div class="stat-value">{{ $rejectedCount }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="summary-card">
                <h3>Requests by Blood Type</h3>
                @php
                    $typeCounts = \App\Models\BloodRequest::select('blood_type')
                        ->selectRaw('count(*) as total')
                        ->groupBy('blood_type')
                        ->orderByDesc('total')
                        ->get();
                @endphp
                <div class="overview-rows">
                    @foreach($typeCounts as $type)
                        <div class="stat-block">
                            <div>
                                <div class="stat-label">{{ $type->blood_type }}</div>
                                <div class="stat-value">{{ $type->total }}</div>
                            </div>
                            <span class="stat-chip">{{ strtoupper($type->blood_type) }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="urgent-card">
                <h3>Urgent Alerts</h3>
                <div style="display:flex; justify-content:space-between; align-items:center; gap:14px; padding:18px 20px; border-radius:18px; background:#fffbeb; border:1px solid #fecaca;">
                    <div>
                        <div style="font-size:16px; font-weight:800; color:#92400e;">{{ $urgentCount }} requests due soon</div>
                        <p>Focus on orders needing transfusion within the next 48 hours.</p>
                    </div>
                    <div style="font-size:32px;">⚠️</div>
                </div>
            </div>
        </aside>
    </div>
</div>
</x-layout>
