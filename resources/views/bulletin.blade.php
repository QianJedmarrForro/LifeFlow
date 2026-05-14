<x-layout title="Donation Bulletin">
<style>
    .bulletin-hero {
        background: linear-gradient(135deg, #0F172A 0%, #1E293B 50%, #1a0a0e 100%);
        border-radius: 24px;
        padding: 60px 48px;
        text-align: center;
        margin-bottom: 48px;
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(215,38,56,0.2);
    }
    .bulletin-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(ellipse at 50% 0%, rgba(215,38,56,0.15) 0%, transparent 70%);
    }
    .bulletin-hero-badge {
        display: inline-flex; align-items: center; gap: 8px;
        background: rgba(215,38,56,0.15); border: 1px solid rgba(215,38,56,0.4);
        color: #FF6B6B; font-size: 11px; font-weight: 800;
        letter-spacing: 1.5px; text-transform: uppercase;
        padding: 6px 16px; border-radius: 100px; margin-bottom: 20px;
        position: relative;
    }
    .bulletin-hero h1 {
        font-size: clamp(28px, 4vw, 42px); font-weight: 800;
        color: #FFFFFF; letter-spacing: -0.03em; line-height: 1.15;
        margin-bottom: 16px; position: relative;
    }
    .bulletin-hero h1 span { color: #D72638; }
    .bulletin-hero p {
        font-size: 16px; color: #94A3B8; max-width: 560px;
        margin: 0 auto; position: relative;
    }

    .bulletin-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
        margin-bottom: 24px;
    }
    .bulletin-grid.full { grid-template-columns: 1fr; }
    .bulletin-grid.three { grid-template-columns: 1fr 1fr 1fr; }

    .bulletin-card {
        background: #FFFFFF;
        border-radius: 20px;
        padding: 32px;
        border: 1px solid #E2E8F0;
        box-shadow: 0 4px 20px rgba(0,0,0,0.06);
    }
    .bulletin-card.dark {
        background: #0F172A;
        border-color: rgba(255,255,255,0.08);
    }
    .bulletin-card.red-accent { border-left: 4px solid #D72638; }
    .bulletin-card.green-accent { border-left: 4px solid #10b981; }
    .bulletin-card.amber-accent { border-left: 4px solid #f59e0b; }
    .bulletin-card.red-bg {
        background: linear-gradient(135deg, #D72638, #EF4444);
        border: none;
        color: white;
    }

    .card-header {
        display: flex; align-items: center; gap: 14px; margin-bottom: 24px;
    }
    .card-icon {
        width: 48px; height: 48px; border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }
    .card-icon.red-icon { background: rgba(215,38,56,0.1); }
    .card-icon.green-icon { background: rgba(16,185,129,0.1); }
    .card-icon.amber-icon { background: rgba(245,158,11,0.1); }
    .card-icon.blue-icon { background: rgba(59,130,246,0.1); }
    .card-icon.purple-icon { background: rgba(139,92,246,0.1); }
    .card-icon.dark-icon { background: rgba(255,255,255,0.08); }

    .card-title { font-size: 18px; font-weight: 800; color: #1E293B; letter-spacing: -0.02em; }
    .card-subtitle { font-size: 12px; color: #94A3B8; font-weight: 600; text-transform: uppercase; letter-spacing: 0.8px; margin-top: 2px; }
    .dark .card-title { color: #F1F5F9; }
    .red-bg .card-title { color: #fff; }
    .red-bg .card-subtitle { color: rgba(255,255,255,0.7); }

    /* Process Steps */
    .process-steps { display: flex; flex-direction: column; gap: 0; }
    .process-step {
        display: flex; gap: 16px; align-items: flex-start;
        padding: 16px 0;
        border-bottom: 1px solid #F1F5F9;
        position: relative;
    }
    .process-step:last-child { border-bottom: none; padding-bottom: 0; }
    .process-step:first-child { padding-top: 0; }
    .step-num {
        width: 32px; height: 32px; border-radius: 10px;
        background: #D72638; color: white;
        display: flex; align-items: center; justify-content: center;
        font-size: 13px; font-weight: 800; flex-shrink: 0; margin-top: 2px;
    }
    .step-body {}
    .step-title { font-size: 14px; font-weight: 800; color: #1E293B; margin-bottom: 3px; }
    .step-desc { font-size: 13px; color: #64748B; line-height: 1.5; }
    .step-badge {
        display: inline-block; font-size: 10px; font-weight: 700;
        background: rgba(215,38,56,0.08); color: #D72638;
        padding: 2px 8px; border-radius: 100px; margin-top: 5px; letter-spacing: 0.5px;
    }

    /* Eligibility Lists */
    .eligibility-list { display: flex; flex-direction: column; gap: 10px; }
    .elig-item {
        display: flex; align-items: flex-start; gap: 12px;
        padding: 12px 14px; border-radius: 12px;
        background: #F8FAFC;
    }
    .elig-icon {
        width: 28px; height: 28px; border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0; margin-top: 1px;
    }
    .elig-icon.green { background: rgba(16,185,129,0.1); }
    .elig-icon.red { background: rgba(239,68,68,0.1); }
    .elig-text { font-size: 13px; color: #374151; font-weight: 500; line-height: 1.4; }

    /* Defer lists */
    .defer-section { margin-bottom: 20px; }
    .defer-section:last-child { margin-bottom: 0; }
    .defer-label {
        font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px;
        padding: 4px 12px; border-radius: 100px; display: inline-block; margin-bottom: 12px;
    }
    .defer-label.temp { background: rgba(245,158,11,0.12); color: #b45309; }
    .defer-label.perm { background: rgba(239,68,68,0.1); color: #991b1b; }
    .defer-list { display: flex; flex-direction: column; gap: 8px; }
    .defer-item {
        display: flex; align-items: flex-start; gap: 10px;
        font-size: 13px; color: #374151;
    }
    .defer-dot {
        width: 6px; height: 6px; border-radius: 50%;
        flex-shrink: 0; margin-top: 7px;
    }
    .defer-dot.amber { background: #f59e0b; }
    .defer-dot.red { background: #ef4444; }

    /* Reminders */
    .reminders-grid {
        display: grid; grid-template-columns: 1fr 1fr;
        gap: 14px;
    }
    .reminder-card {
        background: rgba(255,255,255,0.12);
        border: 1px solid rgba(255,255,255,0.18);
        border-radius: 14px; padding: 18px 16px;
        display: flex; align-items: center; gap: 14px;
    }
    .reminder-icon {
        width: 40px; height: 40px; border-radius: 12px;
        background: rgba(255,255,255,0.15);
        display: flex; align-items: center; justify-content: center; flex-shrink: 0;
    }
    .reminder-text { font-size: 13px; font-weight: 700; color: #fff; line-height: 1.3; }
    .reminder-sub { font-size: 11px; color: rgba(255,255,255,0.65); margin-top: 2px; }

    /* Section label */
    .section-label {
        display: flex; align-items: center; gap: 10px;
        margin-bottom: 20px;
    }
    .section-label-line { flex: 1; height: 1px; background: #E2E8F0; }
    .section-label-text {
        font-size: 11px; font-weight: 800; color: #94A3B8;
        text-transform: uppercase; letter-spacing: 1.5px;
        white-space: nowrap;
    }

    @media (max-width: 900px) {
        .bulletin-grid { grid-template-columns: 1fr; }
        .bulletin-grid.three { grid-template-columns: 1fr; }
        .reminders-grid { grid-template-columns: 1fr; }
        .bulletin-hero { padding: 40px 24px; }
        .bulletin-card { padding: 24px 20px; }
    }
</style>

{{-- HERO --}}
<div class="bulletin-hero">
    <div class="bulletin-hero-badge">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
        Public Health Information
    </div>
    <h1>Blood Donation<br><span>Guidelines & Process</span></h1>
    <p>Everything you need to know before, during, and after donating blood — eligibility, steps, and reminders.</p>
</div>

{{-- PROCESS --}}
<div class="section-label">
    <div class="section-label-line"></div>
    <span class="section-label-text">Step-by-Step Process</span>
    <div class="section-label-line"></div>
</div>
<div class="bulletin-grid" style="margin-bottom:48px;">
    <div class="bulletin-card red-accent">
        <div class="card-header">
            <div class="card-icon red-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#D72638" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"/></svg>
            </div>
            <div>
                <div class="card-title">Before & During Donation</div>
                <div class="card-subtitle">What to expect at the donation center</div>
            </div>
        </div>
        <div class="process-steps">
            <div class="process-step">
                <div class="step-num">1</div>
                <div class="step-body">
                    <div class="step-title">Registration</div>
                    <div class="step-desc">Present a valid government-issued ID and complete the donor information form accurately.</div>
                    <span class="step-badge">Valid ID Required</span>
                </div>
            </div>
            <div class="process-step">
                <div class="step-num">2</div>
                <div class="step-body">
                    <div class="step-title">Health Screening</div>
                    <div class="step-desc">A health worker will ask medical history questions and check your blood pressure, pulse, temperature, and hemoglobin level.</div>
                    <span class="step-badge">Confidential Interview</span>
                </div>
            </div>
            <div class="process-step">
                <div class="step-num">3</div>
                <div class="step-body">
                    <div class="step-title">Mini Physical Check</div>
                    <div class="step-desc">A brief physical assessment to confirm you are fit and healthy enough to donate safely on this day.</div>
                    <span class="step-badge">Quick Assessment</span>
                </div>
            </div>
            <div class="process-step">
                <div class="step-num">4</div>
                <div class="step-body">
                    <div class="step-title">Blood Collection</div>
                    <div class="step-desc">A sterile, single-use needle is used to collect approximately 450 ml of blood. The process takes only 5–10 minutes.</div>
                    <span class="step-badge">~450 ml · 5–10 Minutes</span>
                </div>
            </div>
            <div class="process-step">
                <div class="step-num">5</div>
                <div class="step-body">
                    <div class="step-title">Rest & Recovery</div>
                    <div class="step-desc">Rest in the observation area for 10–15 minutes. Enjoy complimentary snacks and fluids before you leave.</div>
                    <span class="step-badge">10–15 Min Rest · Snacks Provided</span>
                </div>
            </div>
        </div>
    </div>

    <div style="display:flex; flex-direction:column; gap:24px;">
        {{-- WHO CAN --}}
        <div class="bulletin-card green-accent">
            <div class="card-header">
                <div class="card-icon green-icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                </div>
                <div>
                    <div class="card-title">Who Can Donate</div>
                    <div class="card-subtitle">Eligible Donors</div>
                </div>
            </div>
            <div class="eligibility-list">
                <div class="elig-item">
                    <div class="elig-icon green">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                    </div>
                    <div class="elig-text"><strong>Age 16–65</strong> years old (minors require parental consent)</div>
                </div>
                <div class="elig-item">
                    <div class="elig-icon green">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                    </div>
                    <div class="elig-text"><strong>At least 50 kg</strong> (110 lbs) body weight</div>
                </div>
                <div class="elig-item">
                    <div class="elig-icon green">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                    </div>
                    <div class="elig-text"><strong>Healthy</strong> with normal hemoglobin levels (≥125 g/L for women, ≥135 g/L for men)</div>
                </div>
                <div class="elig-item">
                    <div class="elig-icon green">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                    </div>
                    <div class="elig-text"><strong>No recent illness</strong> — feeling well on donation day</div>
                </div>
                <div class="elig-item">
                    <div class="elig-icon green">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                    </div>
                    <div class="elig-text"><strong>Low risk</strong> for blood-borne diseases</div>
                </div>
                <div class="elig-item">
                    <div class="elig-icon green">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                    </div>
                    <div class="elig-text"><strong>Sufficient time</strong> since last donation (at least 3 months)</div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- WHO CANNOT + REMINDERS --}}
<div class="bulletin-grid" style="margin-bottom:48px;">
    {{-- WHO CANNOT --}}
    <div class="bulletin-card amber-accent">
        <div class="card-header">
            <div class="card-icon amber-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#f59e0b" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            </div>
            <div>
                <div class="card-title">Who Cannot Donate</div>
                <div class="card-subtitle">Temporary & Permanent Deferrals</div>
            </div>
        </div>
        <div class="defer-section">
            <span class="defer-label temp">
                ⏳ Temporary — Can Donate Later
            </span>
            <div class="defer-list">
                @foreach([
                    'Current illness, fever, or infection (defer until fully recovered)',
                    'Anemia — low hemoglobin at time of screening',
                    'Recent tattoo or body piercing (defer 6–12 months)',
                    'Recent surgery or major dental work',
                    'Pregnancy or breastfeeding',
                    'Certain medications (aspirin, antibiotics — ask staff)',
                    'Recent vaccination (defer 2–4 weeks depending on vaccine)',
                    'Alcohol consumption within the past 24 hours',
                ] as $item)
                <div class="defer-item">
                    <div class="defer-dot amber"></div>
                    <span>{{ $item }}</span>
                </div>
                @endforeach
            </div>
        </div>
        <div class="defer-section">
            <span class="defer-label perm">
                ✕ Permanent — Cannot Donate
            </span>
            <div class="defer-list">
                @foreach([
                    'HIV/AIDS or positive HIV test',
                    'Hepatitis B or Hepatitis C',
                    'Serious heart disease or blood disorders',
                    'High-risk infections (HTLV, syphilis, Chagas disease)',
                    'Certain cancers (leukemia, lymphoma)',
                ] as $item)
                <div class="defer-item">
                    <div class="defer-dot red"></div>
                    <span>{{ $item }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- REMINDERS --}}
    <div class="bulletin-card red-bg">
        <div class="card-header">
            <div class="card-icon dark-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 01-3.46 0"/></svg>
            </div>
            <div>
                <div class="card-title" style="color:#fff;">Important Reminders</div>
                <div class="card-subtitle" style="color:rgba(255,255,255,0.65);">Prepare for your donation day</div>
            </div>
        </div>
        <div class="reminders-grid">
            <div class="reminder-card">
                <div class="reminder-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8h1a4 4 0 010 8h-1"/><path d="M2 8h16v9a4 4 0 01-4 4H6a4 4 0 01-4-4V8z"/><line x1="6" y1="1" x2="6" y2="4"/><line x1="10" y1="1" x2="10" y2="4"/><line x1="14" y1="1" x2="14" y2="4"/></svg>
                </div>
                <div>
                    <div class="reminder-text">Eat a Full Meal</div>
                    <div class="reminder-sub">Have a healthy meal 2–3 hours before donating</div>
                </div>
            </div>
            <div class="reminder-card">
                <div class="reminder-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22a7 7 0 007-7c0-2-1-3.9-3-5.5S12 4 12 4s-4 2-6 5.5-3 3.5-3 5.5a7 7 0 007 7z"/></svg>
                </div>
                <div>
                    <div class="reminder-text">Drink Plenty of Water</div>
                    <div class="reminder-sub">At least 500 ml extra before your appointment</div>
                </div>
            </div>
            <div class="reminder-card">
                <div class="reminder-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
                </div>
                <div>
                    <div class="reminder-text">Get Enough Sleep</div>
                    <div class="reminder-sub">Rest at least 6–8 hours the night before</div>
                </div>
            </div>
            <div class="reminder-card">
                <div class="reminder-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/></svg>
                </div>
                <div>
                    <div class="reminder-text">Be Honest During Screening</div>
                    <div class="reminder-sub">Your answers protect both you and the recipient</div>
                </div>
            </div>
        </div>

        <div style="margin-top:24px; padding:16px 18px; background:rgba(0,0,0,0.2); border-radius:14px; border:1px solid rgba(255,255,255,0.12); display:flex; align-items:flex-start; gap:14px;">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.8)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0; margin-top:1px;"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            <p style="font-size:12.5px; color:rgba(255,255,255,0.75); line-height:1.6; margin:0;">
                <strong style="color:white;">After donating:</strong> Avoid strenuous physical activity and heavy lifting for 24 hours. Keep your bandage on for at least 4–5 hours. If you feel dizzy or unwell, sit down immediately and inform the staff.
            </p>
        </div>
    </div>
</div>

{{-- BOTTOM CTA --}}
<div class="bulletin-card" style="background:linear-gradient(135deg,#0F172A,#1E293B); border-color:rgba(215,38,56,0.25); text-align:center; padding:48px;">
    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#D72638" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin:0 auto 16px;display:block;"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/></svg>
    <h2 style="font-size:24px; font-weight:800; color:#FFFFFF; margin-bottom:10px; letter-spacing:-0.02em;">Every Drop Counts</h2>
    <p style="font-size:15px; color:#94A3B8; max-width:480px; margin:0 auto 28px; line-height:1.6;">A single blood donation can save up to three lives. You have the power to make a difference today.</p>
    @auth
        @can('user-only')
        <a href="{{ route('donations.create') }}" style="display:inline-flex; align-items:center; gap:8px; background:#D72638; color:white; text-decoration:none; padding:14px 32px; border-radius:14px; font-weight:800; font-size:15px; transition:0.2s; box-shadow:0 6px 20px rgba(215,38,56,0.4);"
           onmouseover="this.style.background='#EF4444'" onmouseout="this.style.background='#D72638'">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/></svg>
            Donate Blood Now
        </a>
        @endcan
    @else
        <a href="{{ route('register') }}" style="display:inline-flex; align-items:center; gap:8px; background:#D72638; color:white; text-decoration:none; padding:14px 32px; border-radius:14px; font-weight:800; font-size:15px; transition:0.2s; box-shadow:0 6px 20px rgba(215,38,56,0.4);"
           onmouseover="this.style.background='#EF4444'" onmouseout="this.style.background='#D72638'">
            Register to Donate
        </a>
    @endauth
</div>
</x-layout>
