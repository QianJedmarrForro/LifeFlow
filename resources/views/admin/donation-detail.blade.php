<x-layout title="Donor Detail — Admin">
<style>
    .admin-detail-wrap { max-width: 800px; margin: 0 auto; padding: 0 16px 60px; }

    .admin-hero {
        background: linear-gradient(135deg, #0F172A 0%, #1E293B 60%, #1a0a0e 100%);
        border-radius: 24px; padding: 36px 40px;
        display: flex; align-items: flex-start; justify-content: space-between; gap: 24px;
        margin-bottom: 28px;
        border: 1px solid rgba(215,38,56,0.2);
        position: relative; overflow: hidden;
    }
    .admin-hero::before {
        content:''; position:absolute; inset:0;
        background: radial-gradient(ellipse at 100% 0%, rgba(215,38,56,0.12) 0%, transparent 60%);
    }
    .admin-hero-left { display:flex; align-items:center; gap:20px; position:relative; }
    .admin-hero-avatar {
        width: 64px; height: 64px; border-radius: 18px;
        background: linear-gradient(135deg, #D72638, #EF4444);
        display: flex; align-items: center; justify-content: center;
        font-size: 22px; font-weight: 900; color: white; flex-shrink: 0;
        box-shadow: 0 8px 24px rgba(215,38,56,0.35);
        overflow: hidden;
    }
    .admin-hero-body {}
    .admin-hero-label { font-size: 11px; font-weight: 800; color: #475569; text-transform: uppercase; letter-spacing: 1.2px; margin-bottom: 5px; }
    .admin-hero-name { font-size: 24px; font-weight: 800; color: #fff; letter-spacing: -0.03em; margin-bottom: 5px; }
    .admin-hero-sub { font-size: 13px; color: #64748B; }
    .admin-hero-right { position: relative; flex-shrink: 0; }

    .status-pill {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 6px 14px; border-radius: 100px;
        font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px;
    }
    .sp-approved { background: rgba(16,185,129,0.15); color: #065f46; }
    .sp-pending  { background: rgba(245,158,11,0.15);  color: #92400e; }
    .sp-rejected { background: rgba(239,68,68,0.12);   color: #991b1b; }

    .info-card {
        background: #fff; border-radius: 20px;
        border: 1px solid #E2E8F0;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        margin-bottom: 20px; overflow: hidden;
    }
    .info-card-header {
        padding: 16px 24px; border-bottom: 1px solid #F1F5F9;
        display: flex; align-items: center; gap: 12px;
    }
    .info-card-icon {
        width: 34px; height: 34px; border-radius: 10px;
        display: flex; align-items: center; justify-content: center; flex-shrink: 0;
    }
    .info-card-title { font-size: 14px; font-weight: 800; color: #1E293B; }

    .info-row {
        display: flex; justify-content: space-between; align-items: flex-start;
        padding: 13px 24px; gap: 16px;
        border-bottom: 1px solid #F8FAFC;
    }
    .info-row:last-child { border-bottom: none; }
    .info-key { font-size: 13px; color: #64748B; font-weight: 500; flex-shrink: 0; min-width: 170px; }
    .info-val { font-size: 13px; color: #1E293B; font-weight: 700; text-align: right; }

    .blood-badge-lg {
        display: inline-flex; align-items: center; justify-content: center;
        background: linear-gradient(135deg, #D72638, #EF4444);
        color: white; font-size: 20px; font-weight: 900;
        width: 52px; height: 52px; border-radius: 14px;
        box-shadow: 0 4px 12px rgba(215,38,56,0.35);
    }

    .hn-box {
        margin: 0 24px 20px;
        background: #F8FAFC; border-radius: 14px;
        border: 1px solid #E2E8F0; overflow: hidden;
    }
    .hn-item {
        display: flex; align-items: flex-start; justify-content: space-between; gap: 16px;
        padding: 11px 18px; border-bottom: 1px solid #F1F5F9;
        font-size: 12.5px;
    }
    .hn-item:last-child { border-bottom: none; }
    .hn-q { color: #475569; flex: 1; line-height: 1.5; }
    .hn-a { font-weight: 800; flex-shrink: 0; padding: 3px 10px; border-radius: 100px; font-size: 11px; }
    .hn-yes { background: rgba(16,185,129,0.1); color: #065f46; }
    .hn-no  { background: rgba(239,68,68,0.08); color: #991b1b; }

    .action-bar {
        display: flex; gap: 12px; align-items: center; margin-top: 8px; flex-wrap: wrap;
    }
    .btn-secondary {
        display: inline-flex; align-items: center; gap: 8px;
        background: #F1F5F9; color: #374151; text-decoration: none;
        padding: 11px 20px; border-radius: 12px; font-size: 13px; font-weight: 700;
        transition: background 0.2s; border: none; cursor: pointer; font-family: inherit;
    }
    .btn-secondary:hover { background: #E2E8F0; }
    .btn-print {
        display: inline-flex; align-items: center; gap: 8px;
        background: #0F172A; color: #fff; text-decoration: none;
        padding: 11px 20px; border-radius: 12px; font-size: 13px; font-weight: 700;
        transition: background 0.2s; border: none; cursor: pointer; font-family: inherit;
    }
    .btn-print:hover { background: #1E293B; }

    @media print {
        .action-bar, header, nav { display: none !important; }
        .admin-detail-wrap { max-width: 100%; padding: 0; }
        .info-card { box-shadow: none; border: 1px solid #ccc; }
        .admin-hero { background: #1e293b !important; -webkit-print-color-adjust: exact; }
    }
</style>

<div class="admin-detail-wrap">

    <a href="{{ url()->previous() }}" class="btn-secondary" style="margin-bottom:24px; display:inline-flex;">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg>
        Back
    </a>

    {{-- Hero --}}
    <div class="admin-hero">
        <div class="admin-hero-left">
            <div class="admin-hero-avatar">
                @if($donation->user && $donation->user->profile_photo)
                    <img src="{{ asset('storage/' . $donation->user->profile_photo) }}" style="width:64px;height:64px;object-fit:cover;">
                @else
                    {{ strtoupper(substr($donation->name, 0, 2)) }}
                @endif
            </div>
            <div class="admin-hero-body">
                <div class="admin-hero-label">Donation Record #{{ $donation->id }}</div>
                <div class="admin-hero-name">{{ $donation->name }}</div>
                <div class="admin-hero-sub">{{ $donation->email }} &nbsp;·&nbsp; Submitted {{ $donation->created_at->format('M j, Y \a\t g:i A') }}</div>
            </div>
        </div>
        <div class="admin-hero-right">
            <span class="status-pill {{ $donation->status === 'approved' ? 'sp-approved' : ($donation->status === 'pending' ? 'sp-pending' : 'sp-rejected') }}">
                <svg width="8" height="8" viewBox="0 0 24 24" fill="currentColor"><circle cx="12" cy="12" r="10"/></svg>
                {{ ucfirst($donation->status) }}
            </span>
        </div>
    </div>

    {{-- Two-column layout for personal + donation --}}
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-bottom:20px;">

        {{-- Personal Info --}}
        <div class="info-card">
            <div class="info-card-header">
                <div class="info-card-icon" style="background:rgba(59,130,246,0.1);">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#3b82f6" stroke-width="2.2"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                </div>
                <div class="info-card-title">Personal Information</div>
            </div>
            <div>
                <div class="info-row"><span class="info-key">Full Name</span><span class="info-val">{{ $donation->name }}</span></div>
                <div class="info-row"><span class="info-key">Date of Birth</span><span class="info-val">{{ $donation->dob ? \Carbon\Carbon::parse($donation->dob)->format('M j, Y') : '—' }}</span></div>
                <div class="info-row"><span class="info-key">Phone</span><span class="info-val">{{ $donation->phone ?? '—' }}</span></div>
                <div class="info-row"><span class="info-key">Address</span><span class="info-val" style="max-width:180px; word-break:break-word;">{{ $donation->address ?? '—' }}</span></div>
                <div class="info-row"><span class="info-key">Email</span><span class="info-val" style="word-break:break-all;">{{ $donation->email }}</span></div>
                <div class="info-row"><span class="info-key">Valid ID Type</span><span class="info-val">{{ $donation->id_type ?? '—' }}</span></div>
            </div>
        </div>

        {{-- Donation Details --}}
        <div class="info-card">
            <div class="info-card-header">
                <div class="info-card-icon" style="background:rgba(215,38,56,0.1);">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#D72638" stroke-width="2.2"><path d="M12 22a7 7 0 007-7c0-2-1-3.9-3-5.5S12 4 12 4s-4 2-6 5.5-3 3.5-3 5.5a7 7 0 007 7z"/></svg>
                </div>
                <div class="info-card-title">Donation Details</div>
            </div>
            <div>
                <div class="info-row" style="align-items:center;">
                    <span class="info-key">Blood Type</span>
                    <span class="blood-badge-lg">{{ $donation->blood_type }}</span>
                </div>
                <div class="info-row"><span class="info-key">Volume Donated</span><span class="info-val">{{ $donation->units }} ml</span></div>
                <div class="info-row"><span class="info-key">Donation Date</span><span class="info-val">{{ $donation->created_at->format('M j, Y') }}</span></div>
                <div class="info-row">
                    <span class="info-key">Status</span>
                    <span class="status-pill {{ $donation->status === 'approved' ? 'sp-approved' : ($donation->status === 'pending' ? 'sp-pending' : 'sp-rejected') }}">
                        {{ ucfirst($donation->status) }}
                    </span>
                </div>
                <div class="info-row">
                    <span class="info-key">Eligibility Confirmed</span>
                    <span class="info-val" style="color:#10b981;">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" style="vertical-align:middle;margin-right:3px;"><polyline points="20 6 9 17 4 12"/></svg>
                        Yes
                    </span>
                </div>
                <div class="info-row">
                    <span class="info-key">Donor Account</span>
                    <span class="info-val" style="color:#3b82f6;">
                        {{ $donation->user ? '#' . $donation->user->id . ' — ' . $donation->user->name : 'N/A' }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- Health Screening Answers --}}
    @if($donation->health_notes)
    <div class="info-card">
        <div class="info-card-header">
            <div class="info-card-icon" style="background:rgba(16,185,129,0.1);">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2.2"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
            </div>
            <div class="info-card-title">Health Screening & Eligibility — Self-Reported Answers</div>
        </div>
        <div class="hn-box">
            @foreach(explode("\n", $donation->health_notes) as $i => $line)
                @if(trim($line))
                    @php
                        $parts    = explode(' → ', $line, 2);
                        $question = $parts[0] ?? $line;
                        $answer   = trim($parts[1] ?? '');
                    @endphp
                    <div class="hn-item">
                        <span class="hn-q">
                            <span style="font-size:10px; color:#94A3B8; font-weight:700; margin-right:6px;">Q{{ $i+1 }}</span>
                            {{ $question }}
                        </span>
                        @if($answer)
                            <span class="hn-a {{ strtolower($answer) === 'yes' ? 'hn-yes' : 'hn-no' }}">
                                {{ $answer }}
                            </span>
                        @endif
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    @else
    <div class="info-card">
        <div class="info-card-header">
            <div class="info-card-icon" style="background:rgba(245,158,11,0.1);">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#f59e0b" stroke-width="2.2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            </div>
            <div class="info-card-title">Health Screening & Eligibility</div>
        </div>
        <div style="padding:24px; color:#94A3B8; font-size:13px;">
            No health screening data recorded for this donation (submitted before the screening form was added).
        </div>
    </div>
    @endif

    {{-- Action Bar --}}
    <div class="action-bar">
        <a href="{{ url()->previous() }}" class="btn-secondary">← Back</a>
        <button class="btn-print" onclick="window.print()">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
            Print / Save PDF
        </button>
    </div>

</div>
</x-layout>
