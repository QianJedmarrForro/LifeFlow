<x-layout>
<style>
    * { transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1); }

    .blood-req-container {
        font-family: 'DM Sans', -apple-system, BlinkMacSystemFont, sans-serif;
        padding: 40px;
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        min-height: 100vh;
    }

    /* ===== HERO HEADER ===== */
    .hero-header {
        margin-bottom: 50px;
        position: relative;
        overflow: hidden;
    }

    .hero-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(239, 68, 68, 0.08) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }

    .hero-title {
        font-size: 48px;
        font-weight: 900;
        background: linear-gradient(135deg, #ffffff 0%, #cbd5e1 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin: 0;
        position: relative;
        z-index: 1;
        letter-spacing: -1px;
    }

    .hero-subtitle {
        color: #94a3b8;
        font-size: 15px;
        margin-top: 12px;
        position: relative;
        z-index: 1;
        font-weight: 500;
    }

    /* ===== METRIC CARDS ===== */
    .metrics-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 20px;
        margin-bottom: 50px;
    }

    .metric-card {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.08) 0%, rgba(255, 255, 255, 0.02) 100%);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 20px;
        padding: 28px;
        position: relative;
        overflow: hidden;
        cursor: pointer;
    }

    .metric-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 300px;
        height: 300px;
        border-radius: 50%;
        pointer-events: none;
    }

    .metric-card.pending::before {
        background: radial-gradient(circle, rgba(245, 158, 11, 0.15) 0%, transparent 70%);
    }

    .metric-card.approved::before {
        background: radial-gradient(circle, rgba(16, 185, 129, 0.15) 0%, transparent 70%);
    }

    .metric-card.rejected::before {
        background: radial-gradient(circle, rgba(239, 68, 68, 0.15) 0%, transparent 70%);
    }

    .metric-card:hover {
        border-color: rgba(255, 255, 255, 0.2);
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.12) 0%, rgba(255, 255, 255, 0.05) 100%);
        transform: translateY(-8px);
    }

    .metric-icon {
        font-size: 32px;
        margin-bottom: 16px;
        position: relative;
        z-index: 1;
    }

    .metric-label {
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        color: #94a3b8;
        letter-spacing: 1.2px;
        margin-bottom: 12px;
        position: relative;
        z-index: 1;
    }

    .metric-value {
        font-size: 42px;
        font-weight: 900;
        color: #ffffff;
        position: relative;
        z-index: 1;
        line-height: 1;
    }

    /* ===== MAIN CARD ===== */
    .requests-container {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(248, 250, 252, 0.98) 100%);
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 30px 60px rgba(0, 0, 0, 0.3);
        border: 1px solid rgba(255, 255, 255, 0.5);
    }

    .requests-header {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        padding: 40px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
    }

    .requests-title {
        font-size: 28px;
        font-weight: 900;
        color: #ffffff;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .filter-group {
        display: flex;
        gap: 12px;
        align-items: center;
    }

    .status-filter {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: #ffffff;
        padding: 10px 18px;
        border-radius: 12px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        font-family: inherit;
    }

    .status-filter:hover {
        background: rgba(255, 255, 255, 0.15);
        border-color: rgba(255, 255, 255, 0.3);
    }

    /* ===== REQUESTS TABLE ===== */
    .requests-table-wrapper {
        overflow-x: auto;
    }

    .requests-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 1200px;
    }

    .requests-table thead tr {
        background: #f8fafc;
        border-bottom: 2px solid #e2e8f0;
    }

    .requests-table thead th {
        padding: 18px 16px;
        text-align: left;
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        color: #64748b;
        letter-spacing: 1px;
    }

    .requests-table tbody tr {
        border-bottom: 1px solid #e2e8f0;
    }

    .requests-table tbody tr:hover {
        background: #f1f5f9;
    }

    .requests-table tbody tr:last-child {
        border-bottom: none;
    }

    .requests-table td {
        padding: 16px;
        color: #475569;
        font-size: 13px;
    }

    /* ===== REQUEST ROW CONTENT ===== */
    .patient-card {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .patient-name {
        font-weight: 800;
        color: #1e293b;
        font-size: 14px;
    }

    .patient-meta {
        font-size: 11px;
        color: #94a3b8;
        display: flex;
        gap: 12px;
    }

    .blood-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
        font-weight: 900;
        font-size: 16px;
        border-radius: 14px;
        box-shadow: 0 8px 16px rgba(239, 68, 68, 0.3);
    }

    .medical-info {
        background: #f0f9ff;
        border: 1px solid #7dd3fc;
        border-radius: 10px;
        padding: 10px 12px;
        font-size: 12px;
        color: #0369a1;
        font-weight: 600;
    }

    .inventory-status {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .inventory-bar {
        width: 120px;
        height: 6px;
        background: #f1f5f9;
        border-radius: 10px;
        overflow: hidden;
    }

    .inventory-fill {
        height: 100%;
        background: linear-gradient(90deg, #10b981 0%, #6ee7b7 100%);
    }

    .inventory-text {
        font-size: 11px;
        color: #64748b;
    }

    .doctor-auth {
        background: #fef3c7;
        border: 1px solid #fcd34d;
        border-radius: 8px;
        padding: 8px 12px;
        font-size: 11px;
        color: #78350f;
        font-weight: 600;
    }

    .urgency-critical {
        background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
        border: 2px solid #ef4444;
        animation: critical-pulse 1.5s infinite;
    }

    .urgency-high {
        background: linear-gradient(135deg, #fef9c3 0%, #fef3c7 100%);
        border: 1px solid #fcd34d;
    }

    @keyframes critical-pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.7; }
    }

    .deadline-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 12px;
        border-radius: 10px;
        font-size: 12px;
        font-weight: 700;
    }

    /* ===== STATUS BADGES ===== */
    .status-badge {
        display: inline-block;
        padding: 8px 16px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        white-space: nowrap;
    }

    .badge-pending {
        background: linear-gradient(135deg, #fef9c3 0%, #fef3c7 100%);
        color: #854d0e;
        border: 1px solid #fef08a;
        animation: pulse-pending 2s infinite;
    }

    .badge-approved {
        background: linear-gradient(135deg, #dcfce7 0%, #d1fae5 100%);
        color: #166534;
        border: 1px solid #bbf7d0;
    }

    .badge-rejected {
        background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
        color: #991b1b;
        border: 1px solid #fecaca;
    }

    @keyframes pulse-pending {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.7; }
    }

    /* ===== ACTION BUTTONS ===== */
    .action-group {
        display: flex;
        gap: 8px;
        flex-direction: column;
    }

    .btn-modern {
        padding: 10px 14px;
        border: none;
        border-radius: 10px;
        font-weight: 700;
        font-size: 12px;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        white-space: nowrap;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .btn-approve {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
    }

    .btn-approve:hover {
        box-shadow: 0 8px 20px rgba(16, 185, 129, 0.4);
        transform: translateY(-2px);
    }

    .btn-reject {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
    }

    .btn-reject:hover {
        box-shadow: 0 8px 20px rgba(239, 68, 68, 0.4);
        transform: translateY(-2px);
    }

    .status-locked {
        padding: 10px 14px;
        background: #f1f5f9;
        color: #94a3b8;
        border-radius: 10px;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
    }

    /* ===== EMPTY STATE ===== */
    .empty-state {
        padding: 80px 40px;
        text-align: center;
        background: linear-gradient(135deg, rgba(15, 23, 42, 0.02) 0%, rgba(30, 41, 59, 0.02) 100%);
    }

    .empty-icon {
        font-size: 64px;
        margin-bottom: 24px;
        opacity: 0.6;
    }

    .empty-title {
        font-size: 24px;
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 10px;
    }

    .empty-text {
        color: #64748b;
        font-size: 15px;
    }

    .info-row {
        display: flex;
        gap: 4px;
        flex-direction: column;
    }

    .info-label {
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        color: #94a3b8;
        letter-spacing: 0.5px;
    }

    .info-value {
        font-size: 13px;
        font-weight: 600;
        color: #1e293b;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 1024px) {
        .requests-table {
            min-width: 1000px;
        }

        .requests-table td {
            padding: 14px 12px;
            font-size: 12px;
        }
    }

    @media (max-width: 768px) {
        .blood-req-container {
            padding: 20px;
        }

        .hero-title {
            font-size: 32px;
        }

        .metrics-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }

        .requests-header {
            padding: 24px;
            flex-direction: column;
            align-items: flex-start;
        }

        .requests-title {
            font-size: 20px;
        }

        .requests-table {
            font-size: 11px;
        }

        .requests-table th,
        .requests-table td {
            padding: 10px 8px;
        }

        .blood-badge {
            width: 50px;
            height: 50px;
            font-size: 14px;
        }

        .action-group {
            flex-direction: row;
        }

        .btn-modern {
            width: 48px;
            padding: 8px 10px;
            font-size: 10px;
        }

        .inventory-bar {
            width: 80px;
        }
    }
</style>

<div class="blood-req-container">
    <!-- Hero Header -->
    <div class="hero-header">
        <h1 class="hero-title">🩸 Blood Bank Requests</h1>
        <p class="hero-subtitle">Real-time request management · Medical authorization · Inventory tracking</p>
    </div>

    <!-- Metrics Grid -->
    <div class="metrics-grid">
        <div class="metric-card pending">
            <div class="metric-icon">⏳</div>
            <div class="metric-label">Pending</div>
            <div class="metric-value">
                @php
                    $pendingCount = \App\Models\BloodRequest::where('status', 'pending')->count();
                @endphp
                {{ $pendingCount }}
            </div>
        </div>

        <div class="metric-card approved">
            <div class="metric-icon">✅</div>
            <div class="metric-label">Approved</div>
            <div class="metric-value">
                @php
                    $approvedCount = \App\Models\BloodRequest::where('status', 'approved')->count();
                @endphp
                {{ $approvedCount }}
            </div>
        </div>

        <div class="metric-card rejected">
            <div class="metric-icon">❌</div>
            <div class="metric-label">Rejected</div>
            <div class="metric-value">
                @php
                    $rejectedCount = \App\Models\BloodRequest::where('status', 'rejected')->count();
                @endphp
                {{ $rejectedCount }}
            </div>
        </div>
    </div>

    <!-- Main Requests Container -->
    <div class="requests-container">
        <!-- Header -->
        <div class="requests-header">
            <h2 class="requests-title">📋 Blood Requests Registry</h2>
            <div class="filter-group">
                <form method="GET" style="display: flex; gap: 8px;">
                    <select name="filter" class="status-filter" onchange="this.form.submit()">
                        <option value="">All Requests</option>
                        <option value="pending" {{ request('filter') === 'pending' ? 'selected' : '' }}>⏳ Pending</option>
                        <option value="approved" {{ request('filter') === 'approved' ? 'selected' : '' }}>✅ Approved</option>
                        <option value="rejected" {{ request('filter') === 'rejected' ? 'selected' : '' }}>❌ Rejected</option>
                    </select>
                </form>
                @if(request('filter'))
                    <a href="{{ route('blood-requests.index') }}" style="color: #ef4444; font-size: 12px; font-weight: 700; text-decoration: none; padding: 10px 14px; background: #fee2e2; border-radius: 10px;">Clear</a>
                @endif
            </div>
        </div>

        <!-- Table -->
        <div class="requests-table-wrapper">
            @forelse($requests as $req)
                @if($loop->first)
                <table class="requests-table">
                    <thead>
                        <tr>
                            <th>Patient</th>
                            <th style="text-align: center;">Blood<br>Type</th>
                            <th style="text-align: center;">Units<br>Requested</th>
                            <th>Medical<br>Diagnosis</th>
                            <th>Hospital<br>Department</th>
                            <th style="text-align: center;">Inventory<br>Status</th>
                            <th>Deadline</th>
                            <th>Doctor<br>Auth</th>
                            <th style="text-align: center;">Status</th>
                            <th style="text-align: center;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                @endif

                        @php
                            // Calculate available inventory
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
                                        <span>📞 {{ substr($req->contact_number ?? 'N/A', 0, 10) }}</span>
                                    </div>
                                </div>
                            </td>
                            <td style="text-align: center;">
                                <div class="blood-badge">{{ $req->blood_type }}</div>
                            </td>
                            <td style="text-align: center;">
                                <div class="info-row">
                                    <div class="info-value">{{ number_format($req->units) }}</div>
                                    <div class="info-label">ml</div>
                                </div>
                            </td>
                            <td>
                                <div class="medical-info">
                                    {{ $req->medical_reason ?? 'Emergency transfusion' }}
                                </div>
                            </td>
                            <td>
                                <div class="info-row">
                                    <div class="info-value">{{ substr($req->hospital, 0, 16) }}</div>
                                    <div class="info-label">{{ $req->department ?? 'ICU/ER' }}</div>
                                </div>
                            </td>
                            <td>
                                <div class="inventory-status">
                                    <div class="inventory-bar">
                                        <div class="inventory-fill" style="width: {{ $inventory_percentage }}%;"></div>
                                    </div>
                                    <div class="inventory-text">{{ number_format($available) }} ml avail</div>
                                </div>
                            </td>
                            <td>
                                <div class="deadline-badge {{ $isCritical ? 'urgency-critical' : ($isUrgent ? 'urgency-high' : '') }}" style="background: none; border: none; padding: 0; font-weight: 700;">
                                    {{ \Carbon\Carbon::parse($req->needed_by)->format('M d, h:i A') }}
                                    @if($isCritical)
                                        <span style="color: #dc2626;">🚨</span>
                                    @elseif($isUrgent)
                                        <span style="color: #f59e0b;">⚠️</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="doctor-auth">
                                    ✓ {{ $req->doctor_name ?? 'Dr. Verified' }}
                                </div>
                            </td>
                            <td style="text-align: center;">
                                <span class="status-badge badge-{{ $req->status }}">
                                    {{ ucfirst($req->status) }}
                                </span>
                            </td>
                            <td style="text-align: center;">
                                <div class="action-group">
                                    @if($req->status === 'pending')
                                        <form action="{{ route('blood-requests.approve', $req->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="btn-modern btn-approve" onclick="return confirm('Approve {{ $req->blood_type }} blood for {{ $req->patient_name }}?')" title="Approve">✓</button>
                                        </form>
                                        <form action="{{ route('blood-requests.reject', $req->id) }}" method="POST" style="display: inline;">
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
                    <div class="empty-text">All blood requests have been processed. Great work!</div>
                </div>
            @endforelse
        </div>
    </div>
</div>
</x-layout>
