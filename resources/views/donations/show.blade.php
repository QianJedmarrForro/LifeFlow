<x-layout title="Donation Details">
<style>
    .detail-wrap { max-width: 720px; margin: 0 auto; padding: 0 16px 60px; }

    .detail-hero {
        background: linear-gradient(135deg, #0F172A, #1E293B);
        border-radius: 24px; padding: 36px 40px;
        display: flex; align-items: center; gap: 24px;
        margin-bottom: 28px;
        border: 1px solid rgba(215,38,56,0.2);
        position: relative; overflow: hidden;
    }
    .detail-hero::before {
        content:''; position:absolute; inset:0;
        background: radial-gradient(ellipse at 0% 50%, rgba(215,38,56,0.12) 0%, transparent 60%);
    }
    .detail-hero-icon {
        width: 64px; height: 64px; border-radius: 18px;
        background: linear-gradient(135deg, #D72638, #EF4444);
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0; box-shadow: 0 8px 24px rgba(215,38,56,0.35);
        position: relative;
    }
    .detail-hero-body { position: relative; }
    .detail-hero-label { font-size: 11px; font-weight: 800; color: #64748B; text-transform: uppercase; letter-spacing: 1.2px; margin-bottom: 6px; }
    .detail-hero-title { font-size: 26px; font-weight: 800; color: #fff; letter-spacing: -0.03em; margin-bottom: 6px; }
    .detail-hero-sub { font-size: 13px; color: #94A3B8; }

    .status-pill {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 5px 14px; border-radius: 100px;
        font-size: 12px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px;
    }
    .status-approved { background: rgba(16,185,129,0.12); color: #065f46; }
    .status-pending   { background: rgba(245,158,11,0.12); color: #92400e; }
    .status-rejected  { background: rgba(239,68,68,0.1);  color: #991b1b; }

    .detail-card {
        background: #fff; border-radius: 20px;
        border: 1px solid #E2E8F0;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        margin-bottom: 20px; overflow: hidden;
    }
    .detail-card-header {
        padding: 18px 24px; border-bottom: 1px solid #F1F5F9;
        display: flex; align-items: center; gap: 12px;
    }
    .detail-card-icon {
        width: 36px; height: 36px; border-radius: 10px;
        display: flex; align-items: center; justify-content: center; flex-shrink: 0;
    }
    .detail-card-title { font-size: 14px; font-weight: 800; color: #1E293B; }
    .detail-card-body { padding: 8px 0; }

    .detail-row {
        display: flex; justify-content: space-between; align-items: flex-start;
        padding: 13px 24px; gap: 16px;
        border-bottom: 1px solid #F8FAFC;
    }
    .detail-row:last-child { border-bottom: none; }
    .detail-key { font-size: 13px; color: #64748B; font-weight: 500; flex-shrink: 0; min-width: 160px; }
    .detail-val { font-size: 13px; color: #1E293B; font-weight: 700; text-align: right; }

    .blood-badge-lg {
        display: inline-flex; align-items: center; justify-content: center;
        background: linear-gradient(135deg, #D72638, #EF4444);
        color: white; font-size: 20px; font-weight: 900;
        width: 52px; height: 52px; border-radius: 14px;
        box-shadow: 0 4px 12px rgba(215,38,56,0.35);
        letter-spacing: -0.5px;
    }

    .health-notes-box {
        background: #F8FAFC; border-radius: 14px;
        padding: 20px 24px; margin: 0 24px 20px;
        border: 1px solid #E2E8F0;
    }
    .health-note-item {
        display: flex; align-items: flex-start; gap: 10px;
        padding: 7px 0; border-bottom: 1px solid #F1F5F9;
        font-size: 12.5px; line-height: 1.5;
    }
    .health-note-item:last-child { border-bottom: none; }
    .hn-q { color: #475569; flex: 1; }
    .hn-ans { font-weight: 800; flex-shrink: 0; }
    .hn-yes { color: #10b981; }
    .hn-no  { color: #D72638; }

    .btn-back-link {
        display: inline-flex; align-items: center; gap: 8px;
        color: #94A3B8; text-decoration: none; font-size: 13.5px; font-weight: 600;
        margin-bottom: 28px; transition: color 0.2s;
    }
    .btn-back-link:hover { color: #475569; }

    .print-btn {
        display: inline-flex; align-items: center; gap: 8px;
        background: #0F172A; color: #fff; text-decoration: none;
        padding: 12px 22px; border-radius: 12px;
        font-size: 13px; font-weight: 700; cursor: pointer; border: none;
        transition: background 0.2s; font-family: inherit;
    }
    .print-btn:hover { background: #1E293B; }

    @media print {
        .btn-back-link, .print-btn, header, nav { display: none !important; }
        .detail-wrap { max-width: 100%; padding: 0; }
        .detail-card { box-shadow: none; border: 1px solid #ccc; }
    }
</style>

<div class="detail-wrap">

    <a href="{{ route('dashboard') }}" class="btn-back-link">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg>
        Back to Dashboard
    </a>

    {{-- Hero --}}
    <div class="detail-hero">
        <div class="detail-hero-icon">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22a7 7 0 007-7c0-2-1-3.9-3-5.5S12 4 12 4s-4 2-6 5.5-3 3.5-3 5.5a7 7 0 007 7z"/></svg>
        </div>
        <div class="detail-hero-body">
            <div class="detail-hero-label">Donation Record #{{ $donation->id }}</div>
            <div class="detail-hero-title">Blood Donation Summary</div>
            <div class="detail-hero-sub">
                Submitted on {{ $donation->created_at->format('F j, Y \a\t g:i A') }}
                &nbsp;·&nbsp;
                <span class="status-pill {{ $donation->status === 'approved' ? 'status-approved' : ($donation->status === 'pending' ? 'status-pending' : 'status-rejected') }}">
                    <svg width="10" height="10" viewBox="0 0 24 24" fill="currentColor"><circle cx="12" cy="12" r="8"/></svg>
                    {{ ucfirst($donation->status) }}
                </span>
            </div>
        </div>
    </div>

    {{-- Personal Information --}}
    <div class="detail-card">
        <div class="detail-card-header">
            <div class="detail-card-icon" style="background:rgba(59,130,246,0.1);">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#3b82f6" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            </div>
            <div class="detail-card-title">Personal Information</div>
        </div>
        <div class="detail-card-body">
            <div class="detail-row">
                <span class="detail-key">Full Name</span>
                <span class="detail-val">{{ $donation->name }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-key">Date of Birth</span>
                <span class="detail-val">{{ $donation->dob ? \Carbon\Carbon::parse($donation->dob)->format('F j, Y') : '—' }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-key">Phone Number</span>
                <span class="detail-val">{{ $donation->phone ?? '—' }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-key">Address</span>
                <span class="detail-val">{{ $donation->address ?? '—' }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-key">Email</span>
                <span class="detail-val">{{ $donation->email }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-key">Valid ID Presented</span>
                <span class="detail-val">{{ $donation->id_type ?? '—' }}</span>
            </div>
        </div>
    </div>

    {{-- Donation Details --}}
    <div class="detail-card">
        <div class="detail-card-header">
            <div class="detail-card-icon" style="background:rgba(215,38,56,0.1);">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#D72638" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22a7 7 0 007-7c0-2-1-3.9-3-5.5S12 4 12 4s-4 2-6 5.5-3 3.5-3 5.5a7 7 0 007 7z"/></svg>
            </div>
            <div class="detail-card-title">Donation Details</div>
        </div>
        <div class="detail-card-body">
            <div class="detail-row" style="align-items:center;">
                <span class="detail-key">Blood Type</span>
                <span class="blood-badge-lg">{{ $donation->blood_type }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-key">Volume Donated</span>
                <span class="detail-val">{{ $donation->units }} ml</span>
            </div>
            <div class="detail-row">
                <span class="detail-key">Donation Date</span>
                <span class="detail-val">{{ $donation->created_at->format('F j, Y') }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-key">Status</span>
                <span class="status-pill {{ $donation->status === 'approved' ? 'status-approved' : ($donation->status === 'pending' ? 'status-pending' : 'status-rejected') }}">
                    {{ ucfirst($donation->status) }}
                </span>
            </div>
            <div class="detail-row">
                <span class="detail-key">Eligibility Confirmed</span>
                <span class="detail-val" style="color:#10b981;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" style="vertical-align:middle;margin-right:4px;"><polyline points="20 6 9 17 4 12"/></svg>
                    Yes
                </span>
            </div>
        </div>
    </div>

    {{-- Health Screening Answers --}}
    @if($donation->health_notes)
    <div class="detail-card">
        <div class="detail-card-header">
            <div class="detail-card-icon" style="background:rgba(16,185,129,0.1);">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
            </div>
            <div class="detail-card-title">Health Screening & Eligibility Answers</div>
        </div>
        <div class="health-notes-box">
            @foreach(explode("\n", $donation->health_notes) as $line)
                @if(trim($line))
                    @php
                        $parts = explode(' → ', $line, 2);
                        $question = $parts[0] ?? $line;
                        $answer   = $parts[1] ?? '';
                    @endphp
                    <div class="health-note-item">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#CBD5E1" stroke-width="2" style="flex-shrink:0;margin-top:3px;"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        <span class="hn-q">{{ $question }}</span>
                        @if($answer)
                            <span class="hn-ans {{ strtolower(trim($answer)) === 'yes' ? 'hn-yes' : 'hn-no' }}">
                                {{ $answer }}
                            </span>
                        @endif
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    @endif

    {{-- Actions --}}
    <div style="display:flex; gap:12px; align-items:center; margin-top:8px;">
        <a href="{{ route('dashboard') }}" style="display:inline-flex; align-items:center; gap:8px; background:#F1F5F9; color:#374151; text-decoration:none; padding:12px 22px; border-radius:12px; font-size:13px; font-weight:700; transition:background 0.2s;" onmouseover="this.style.background='#E2E8F0'" onmouseout="this.style.background='#F1F5F9'">
            ← Back to Dashboard
        </a>
        <button class="print-btn" onclick="window.print()">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
            Print / Save PDF
        </button>
    </div>

</div>
</x-layout>
