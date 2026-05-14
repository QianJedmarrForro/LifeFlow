<x-layout title="Donate Blood">
<style>
    :root { --red:#D72638; --red-hover:#EF4444; }

    .wizard-wrap {
        max-width: 780px; margin: 0 auto; padding: 0 16px 60px;
    }

    /* ── Progress bar ── */
    .wiz-progress {
        display: flex; align-items: center; gap: 0;
        margin-bottom: 40px; padding: 28px 0 0;
    }
    .wiz-step {
        display: flex; flex-direction: column; align-items: center;
        flex: 1; position: relative;
    }
    .wiz-step:not(:last-child)::after {
        content: '';
        position: absolute;
        top: 18px; left: 50%; width: 100%; height: 2px;
        background: #E2E8F0; z-index: 0;
        transition: background 0.4s;
    }
    .wiz-step.done:not(:last-child)::after { background: var(--red); }
    .wiz-dot {
        width: 36px; height: 36px; border-radius: 50%;
        border: 2px solid #E2E8F0; background: #fff;
        display: flex; align-items: center; justify-content: center;
        font-size: 12px; font-weight: 800; color: #94A3B8;
        position: relative; z-index: 1; transition: all 0.3s;
    }
    .wiz-step.active .wiz-dot {
        border-color: var(--red); background: var(--red); color: #fff;
        box-shadow: 0 0 0 4px rgba(215,38,56,0.15);
    }
    .wiz-step.done .wiz-dot {
        border-color: var(--red); background: var(--red); color: #fff;
    }
    .wiz-label {
        font-size: 10px; font-weight: 700; color: #94A3B8;
        text-transform: uppercase; letter-spacing: 0.8px;
        margin-top: 8px; text-align: center;
    }
    .wiz-step.active .wiz-label { color: var(--red); }
    .wiz-step.done .wiz-label { color: #64748B; }

    /* ── Card ── */
    .wiz-card {
        background: #fff; border-radius: 24px;
        padding: 40px; border: 1px solid #E2E8F0;
        box-shadow: 0 8px 32px rgba(0,0,0,0.06);
    }

    .wiz-card-header { margin-bottom: 32px; }
    .wiz-card-badge {
        display: inline-flex; align-items: center; gap: 6px;
        background: rgba(215,38,56,0.08); color: var(--red);
        font-size: 11px; font-weight: 800; letter-spacing: 1px;
        text-transform: uppercase; padding: 5px 12px;
        border-radius: 100px; margin-bottom: 12px;
    }
    .wiz-card-title {
        font-size: 24px; font-weight: 800; color: #1E293B;
        letter-spacing: -0.03em; margin-bottom: 6px;
    }
    .wiz-card-desc { font-size: 14px; color: #64748B; line-height: 1.6; }

    /* ── Form elements ── */
    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px; }
    .form-row.full { grid-template-columns: 1fr; }
    .form-group { display: flex; flex-direction: column; }
    .form-label {
        font-size: 12px; font-weight: 800; color: #374151;
        text-transform: uppercase; letter-spacing: 0.7px; margin-bottom: 8px;
    }
    .form-required { color: var(--red); }
    .form-input {
        background: #F8FAFC; border: 1.5px solid #E2E8F0;
        border-radius: 12px; padding: 14px 16px;
        font-size: 14px; font-family: inherit;
        outline: none; transition: all 0.2s; color: #1E293B;
        width: 100%; box-sizing: border-box;
    }
    .form-input:focus {
        border-color: var(--red); background: #fff;
        box-shadow: 0 0 0 3px rgba(215,38,56,0.1);
    }

    /* ── Blood type grid ── */
    .blood-grid { display: grid; grid-template-columns: repeat(4,1fr); gap: 12px; }
    .blood-btn {
        padding: 18px 8px; text-align: center;
        border: 2px solid #E2E8F0; border-radius: 14px;
        font-size: 18px; font-weight: 800; color: #94A3B8;
        background: #F8FAFC; cursor: pointer; transition: all 0.2s;
        user-select: none;
    }
    .blood-btn:hover { border-color: var(--red); color: var(--red); background: rgba(215,38,56,0.05); }
    .blood-btn.sel { border-color: var(--red); background: var(--red); color: #fff; transform: scale(1.04); box-shadow: 0 4px 14px rgba(215,38,56,0.3); }

    /* ── Yes/No question rows ── */
    .q-row {
        display: flex; align-items: center; justify-content: space-between;
        gap: 16px; padding: 14px 16px;
        border-radius: 12px; background: #F8FAFC;
        border: 1.5px solid #E2E8F0; margin-bottom: 10px;
        transition: border-color 0.2s;
    }
    .q-row.fail { border-color: #FECACA; background: #FFF5F5; }
    .q-row.pass { border-color: #A7F3D0; background: #F0FDF9; }
    .q-text { font-size: 13.5px; color: #374151; font-weight: 500; line-height: 1.4; flex: 1; }
    .q-btns { display: flex; gap: 8px; flex-shrink: 0; }
    .q-btn {
        padding: 7px 18px; border-radius: 8px; border: 1.5px solid #E2E8F0;
        font-size: 12px; font-weight: 800; cursor: pointer; transition: all 0.2s;
        background: #fff; color: #64748B; letter-spacing: 0.3px;
    }
    .q-btn.yes-sel { background: #10b981; border-color: #10b981; color: #fff; }
    .q-btn.no-sel  { background: var(--red); border-color: var(--red); color: #fff; }

    /* ── Disqualification alert ── */
    .dq-alert {
        background: #FEF2F2; border: 1.5px solid #FECACA;
        border-radius: 14px; padding: 20px 20px;
        display: flex; gap: 14px; align-items: flex-start; margin-top: 20px;
    }
    .dq-alert-icon { flex-shrink: 0; margin-top: 2px; }
    .dq-alert-title { font-size: 15px; font-weight: 800; color: #991B1B; margin-bottom: 6px; }
    .dq-alert-text { font-size: 13px; color: #B91C1C; line-height: 1.6; }
    .dq-btn {
        display: inline-flex; align-items: center; gap: 8px;
        margin-top: 14px; padding: 10px 20px;
        background: #D72638; color: #fff; border: none; border-radius: 10px;
        font-size: 13px; font-weight: 700; cursor: pointer;
        text-decoration: none;
    }

    /* ── Review summary ── */
    .review-section { margin-bottom: 24px; }
    .review-section-title {
        font-size: 11px; font-weight: 800; text-transform: uppercase;
        letter-spacing: 1px; color: #94A3B8; margin-bottom: 12px;
        padding-bottom: 8px; border-bottom: 1px solid #E2E8F0;
    }
    .review-row {
        display: flex; justify-content: space-between; align-items: center;
        padding: 8px 0; font-size: 13.5px;
    }
    .review-key { color: #64748B; font-weight: 500; }
    .review-val { color: #1E293B; font-weight: 700; }
    .review-badge {
        padding: 3px 10px; border-radius: 100px; font-size: 11px; font-weight: 800;
    }
    .review-badge.green { background: rgba(16,185,129,0.1); color: #065f46; }
    .review-badge.red-b { background: rgba(215,38,56,0.1); color: var(--red); }

    /* ── Confirm checkbox ── */
    .confirm-box {
        background: linear-gradient(135deg, #0F172A, #1E293B);
        border-radius: 16px; padding: 20px 22px;
        display: flex; gap: 14px; align-items: flex-start;
        margin-bottom: 24px; cursor: pointer;
        border: 1.5px solid rgba(255,255,255,0.08);
    }
    .confirm-box input[type=checkbox] { width: 20px; height: 20px; flex-shrink: 0; margin-top: 2px; accent-color: var(--red); }
    .confirm-text { font-size: 13px; color: #CBD5E1; line-height: 1.6; }
    .confirm-text strong { color: #fff; }

    /* ── Nav buttons ── */
    .wiz-nav { display: flex; gap: 12px; margin-top: 32px; }
    .btn-back {
        flex: 1; padding: 16px; border: 1.5px solid #E2E8F0;
        border-radius: 14px; background: #fff; color: #374151;
        font-size: 15px; font-weight: 700; cursor: pointer;
        transition: all 0.2s; font-family: inherit;
    }
    .btn-back:hover { border-color: #94A3B8; background: #F8FAFC; }
    .btn-next {
        flex: 2; padding: 16px; border: none;
        border-radius: 14px; background: var(--red); color: #fff;
        font-size: 15px; font-weight: 800; cursor: pointer;
        transition: all 0.2s; font-family: inherit;
        display: flex; align-items: center; justify-content: center; gap: 8px;
        box-shadow: 0 4px 14px rgba(215,38,56,0.3);
    }
    .btn-next:hover { background: var(--red-hover); transform: translateY(-1px); }
    .btn-next:disabled { background: #CBD5E1; box-shadow: none; cursor: not-allowed; transform: none; }

    @media(max-width:600px) {
        .form-row { grid-template-columns: 1fr; }
        .blood-grid { grid-template-columns: repeat(4,1fr); gap: 8px; }
        .blood-btn { padding: 14px 4px; font-size: 15px; }
        .wiz-card { padding: 24px 18px; }
    }
</style>

<div class="wizard-wrap" x-data="donationWizard()" x-init="init()">

    {{-- Progress Bar --}}
    <div class="wiz-progress">
        <template x-for="(s, i) in steps" :key="i">
            <div class="wiz-step" :class="{ active: current === i+1, done: current > i+1 }">
                <div class="wiz-dot">
                    <template x-if="current > i+1">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                    </template>
                    <template x-if="current <= i+1">
                        <span x-text="i+1"></span>
                    </template>
                </div>
                <div class="wiz-label" x-text="s"></div>
            </div>
        </template>
    </div>

    <form id="donationForm" action="{{ route('donations.store') }}" method="POST">
        @csrf

        {{-- ═══════════════════════════════════════════ --}}
        {{-- STEP 1 · Personal Information               --}}
        {{-- ═══════════════════════════════════════════ --}}
        <div x-show="current === 1" x-transition.opacity>
            <div class="wiz-card">
                <div class="wiz-card-header">
                    <div class="wiz-card-badge">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        Step 1 of 5
                    </div>
                    <div class="wiz-card-title">Donor Registration</div>
                    <div class="wiz-card-desc">Please provide your personal information and a valid government-issued ID.</div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Full Name <span class="form-required">*</span></label>
                        <input type="text" name="name" class="form-input"
                               x-model="form.name" required
                               value="{{ auth()->user()->name }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Date of Birth <span class="form-required">*</span></label>
                        <input type="date" name="dob" class="form-input"
                               x-model="form.dob" required
                               :max="maxDob()">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Phone Number <span class="form-required">*</span></label>
                        <input type="tel" name="phone" class="form-input"
                               x-model="form.phone" required
                               placeholder="+63 9XX XXX XXXX"
                               value="{{ auth()->user()->phone ?? '' }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Address <span class="form-required">*</span></label>
                        <input type="text" name="address" class="form-input"
                               x-model="form.address" required
                               placeholder="City, Province"
                               value="{{ auth()->user()->address ?? '' }}">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Valid ID Type <span class="form-required">*</span></label>
                        <select name="id_type" class="form-input" x-model="form.id_type" required>
                            <option value="">-- Select ID type --</option>
                            <option>PhilSys / National ID</option>
                            <option>Driver's License</option>
                            <option>Philippine Passport</option>
                            <option>Voter's ID / COMELEC</option>
                            <option>SSS / GSIS ID</option>
                            <option>PhilHealth ID</option>
                            <option>Postal ID</option>
                            <option>School / Student ID</option>
                            <option>Other Government ID</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Weight (kg) <span class="form-required">*</span></label>
                        <input type="number" name="weight_kg" class="form-input"
                               x-model="form.weight_kg"
                               placeholder="Must be at least 50 kg"
                               min="30" max="200" required>
                        <p x-show="form.weight_kg && form.weight_kg < 50" style="font-size:12px;color:#D72638;margin-top:6px;font-weight:600;">
                            ⚠ You must weigh at least 50 kg to donate.
                        </p>
                    </div>
                </div>

                <div class="wiz-nav">
                    <button type="button" class="btn-next"
                            @click="goNext(1)"
                            :disabled="!step1Valid()">
                        Continue — Health Screening
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- ═══════════════════════════════════════════ --}}
        {{-- STEP 2 · Health Screening                   --}}
        {{-- ═══════════════════════════════════════════ --}}
        <div x-show="current === 2" x-transition.opacity>
            <div class="wiz-card">
                <div class="wiz-card-header">
                    <div class="wiz-card-badge">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
                        Step 2 of 5
                    </div>
                    <div class="wiz-card-title">Health Screening</div>
                    <div class="wiz-card-desc">Answer honestly. Your responses are confidential and protect both you and the recipient.</div>
                </div>

                <template x-for="(q, i) in healthQuestions" :key="i">
                    <div class="q-row"
                         :class="{ fail: health[i] === false && q.failOnNo, pass: health[i] === true && q.failOnNo, 'fail': health[i] === true && q.failOnYes, 'pass': health[i] === false && q.failOnYes }">
                        <div class="q-text" x-text="q.text"></div>
                        <div class="q-btns">
                            <button type="button" class="q-btn"
                                    :class="{ 'yes-sel': health[i] === true }"
                                    @click="health[i] = true">Yes</button>
                            <button type="button" class="q-btn"
                                    :class="{ 'no-sel': health[i] === false }"
                                    @click="health[i] = false">No</button>
                        </div>
                    </div>
                </template>

                <div x-show="healthDQ()" class="dq-alert">
                    <div class="dq-alert-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#D72638" stroke-width="2.2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    </div>
                    <div>
                        <div class="dq-alert-title">You are temporarily deferred</div>
                        <div class="dq-alert-text">Based on your answers, you are not eligible to donate at this time. Please consult the donation center staff or visit again once your condition improves. Thank you for your willingness to donate!</div>
                        <a href="{{ route('bulletin') }}" class="dq-btn">View Donation Guidelines</a>
                    </div>
                </div>

                <div class="wiz-nav">
                    <button type="button" class="btn-back" @click="current = 1">← Back</button>
                    <button type="button" class="btn-next"
                            @click="goNext(2)"
                            :disabled="!step2Valid()">
                        Continue — Eligibility Check
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- ═══════════════════════════════════════════ --}}
        {{-- STEP 3 · Eligibility / Deferral Check       --}}
        {{-- ═══════════════════════════════════════════ --}}
        <div x-show="current === 3" x-transition.opacity>
            <div class="wiz-card">
                <div class="wiz-card-header">
                    <div class="wiz-card-badge">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"/></svg>
                        Step 3 of 5
                    </div>
                    <div class="wiz-card-title">Eligibility Check</div>
                    <div class="wiz-card-desc">These questions determine if you can safely donate today. Please answer all questions.</div>
                </div>

                <template x-for="(q, i) in eligQuestions" :key="i">
                    <div class="q-row"
                         :class="{ 'fail': elig[i] === true && q.failOnYes, 'pass': elig[i] === false && q.failOnYes }">
                        <div class="q-text" x-text="q.text"></div>
                        <div class="q-btns">
                            <button type="button" class="q-btn"
                                    :class="{ 'yes-sel': elig[i] === true }"
                                    @click="elig[i] = true">Yes</button>
                            <button type="button" class="q-btn"
                                    :class="{ 'no-sel': elig[i] === false }"
                                    @click="elig[i] = false">No</button>
                        </div>
                    </div>
                </template>

                <div x-show="eligDQ()" class="dq-alert">
                    <div class="dq-alert-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#D72638" stroke-width="2.2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    </div>
                    <div>
                        <div class="dq-alert-title" x-text="eligPermDQ() ? 'Permanently Deferred' : 'Temporarily Deferred'"></div>
                        <div class="dq-alert-text" x-text="eligPermDQ() ? 'One or more of your answers indicate a permanent deferral condition. Unfortunately, you are not eligible to donate blood. Thank you for your care and concern for others.' : 'You are temporarily deferred based on your answers. You may be eligible to donate at a later date once the deferral period has passed.'"></div>
                        <a href="{{ route('bulletin') }}" class="dq-btn">View Full Guidelines</a>
                    </div>
                </div>

                <div class="wiz-nav">
                    <button type="button" class="btn-back" @click="current = 2">← Back</button>
                    <button type="button" class="btn-next"
                            @click="goNext(3)"
                            :disabled="!step3Valid()">
                        Continue — Donation Details
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- ═══════════════════════════════════════════ --}}
        {{-- STEP 4 · Donation Details                   --}}
        {{-- ═══════════════════════════════════════════ --}}
        <div x-show="current === 4" x-transition.opacity>
            <div class="wiz-card">
                <div class="wiz-card-header">
                    <div class="wiz-card-badge">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22a7 7 0 007-7c0-2-1-3.9-3-5.5S12 4 12 4s-4 2-6 5.5-3 3.5-3 5.5a7 7 0 007 7z"/></svg>
                        Step 4 of 5
                    </div>
                    <div class="wiz-card-title">Donation Details</div>
                    <div class="wiz-card-desc">Select your blood type and confirm the volume to be collected.</div>
                </div>

                <div style="margin-bottom:28px;">
                    <label class="form-label">Blood Type <span class="form-required">*</span></label>
                    <input type="hidden" name="blood_type" :value="form.blood_type">
                    <div class="blood-grid">
                        <template x-for="t in ['A+','A-','B+','B-','AB+','AB-','O+','O-']" :key="t">
                            <div class="blood-btn"
                                 :class="{ sel: form.blood_type === t }"
                                 @click="form.blood_type = t"
                                 x-text="t"></div>
                        </template>
                    </div>
                    <p x-show="!form.blood_type" style="font-size:12px;color:#D72638;margin-top:8px;font-weight:600;">
                        Please select your blood type.
                    </p>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Volume to Donate (ml) <span class="form-required">*</span></label>
                        <input type="number" name="units" class="form-input"
                               x-model="form.units" min="200" max="500" required>
                        <p style="font-size:12px;color:#64748B;margin-top:6px;">Standard whole blood donation is <strong>450 ml</strong>.</p>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Donation Date</label>
                        <input type="text" class="form-input" value="{{ now()->format('F j, Y') }}" readonly style="background:#F1F5F9; color:#64748B;">
                        <p style="font-size:12px;color:#64748B;margin-top:6px;">Today's date will be recorded automatically.</p>
                    </div>
                </div>

                <div style="background:#F8FAFC; border:1.5px solid #E2E8F0; border-radius:14px; padding:18px 20px; display:flex; gap:14px; align-items:flex-start;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0;margin-top:1px;"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    <p style="font-size:13px;color:#374151;margin:0;line-height:1.6;">
                        A trained phlebotomist will use a <strong>sterile, single-use needle</strong>. The process takes approximately <strong>5–10 minutes</strong>. You will rest for 10–15 minutes afterwards with refreshments provided.
                    </p>
                </div>

                <div class="wiz-nav">
                    <button type="button" class="btn-back" @click="current = 3">← Back</button>
                    <button type="button" class="btn-next"
                            @click="goNext(4)"
                            :disabled="!step4Valid()">
                        Review & Confirm
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- ═══════════════════════════════════════════ --}}
        {{-- STEP 5 · Review & Submit                    --}}
        {{-- ═══════════════════════════════════════════ --}}
        <div x-show="current === 5" x-transition.opacity>
            <div class="wiz-card">
                <div class="wiz-card-header">
                    <div class="wiz-card-badge">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        Step 5 of 5
                    </div>
                    <div class="wiz-card-title">Review & Submit</div>
                    <div class="wiz-card-desc">Please review all your information before submitting your donation record.</div>
                </div>

                {{-- Summary --}}
                <div class="review-section">
                    <div class="review-section-title">Personal Information</div>
                    <div class="review-row"><span class="review-key">Full Name</span><span class="review-val" x-text="form.name"></span></div>
                    <div class="review-row"><span class="review-key">Date of Birth</span><span class="review-val" x-text="form.dob"></span></div>
                    <div class="review-row"><span class="review-key">Phone</span><span class="review-val" x-text="form.phone"></span></div>
                    <div class="review-row"><span class="review-key">Address</span><span class="review-val" x-text="form.address"></span></div>
                    <div class="review-row"><span class="review-key">Valid ID Type</span><span class="review-val" x-text="form.id_type"></span></div>
                    <div class="review-row"><span class="review-key">Weight</span><span class="review-val" x-text="form.weight_kg + ' kg'"></span></div>
                </div>

                <div class="review-section">
                    <div class="review-section-title">Health & Eligibility</div>
                    <div class="review-row">
                        <span class="review-key">Health Screening</span>
                        <span class="review-badge green">✓ Passed</span>
                    </div>
                    <div class="review-row">
                        <span class="review-key">Eligibility Check</span>
                        <span class="review-badge green">✓ Eligible</span>
                    </div>
                </div>

                <div class="review-section">
                    <div class="review-section-title">Donation Details</div>
                    <div class="review-row">
                        <span class="review-key">Blood Type</span>
                        <span class="review-badge red-b" x-text="form.blood_type"></span>
                    </div>
                    <div class="review-row"><span class="review-key">Volume</span><span class="review-val" x-text="form.units + ' ml'"></span></div>
                    <div class="review-row"><span class="review-key">Donation Date</span><span class="review-val">{{ now()->format('F j, Y') }}</span></div>
                </div>

                {{-- Hidden fields for health notes --}}
                <input type="hidden" name="health_notes" :value="buildHealthNotes()">
                <input type="hidden" name="eligible" value="1">

                <label class="confirm-box">
                    <input type="checkbox" x-model="confirmed" required>
                    <div class="confirm-text">
                        <strong>I confirm that all information provided is accurate and truthful.</strong>
                        I understand that providing false information may disqualify my donation and could be harmful to blood recipients.
                        I consent to the collection and processing of my donation.
                    </div>
                </label>

                <div class="wiz-nav">
                    <button type="button" class="btn-back" @click="current = 4">← Back</button>
                    <button type="submit" class="btn-next"
                            :disabled="!confirmed"
                            style="display:flex;align-items:center;justify-content:center;gap:10px;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/></svg>
                        Submit Donation Record
                    </button>
                </div>
            </div>
        </div>

    </form>

    {{-- Back to dashboard --}}
    <div style="text-align:center; margin-top:24px;">
        <a href="{{ route('dashboard') }}" style="color:#94A3B8; text-decoration:none; font-size:13.5px; font-weight:600;">
            ← Back to Dashboard
        </a>
    </div>
</div>

<script>
function donationWizard() {
    return {
        current: 1,
        confirmed: false,
        steps: ['Registration', 'Health', 'Eligibility', 'Details', 'Review'],

        form: {
            name:       '{{ addslashes(auth()->user()->name) }}',
            dob:        '',
            phone:      '{{ addslashes(auth()->user()->phone ?? '') }}',
            address:    '{{ addslashes(auth()->user()->address ?? '') }}',
            id_type:    '',
            weight_kg:  '',
            blood_type: '{{ addslashes(auth()->user()->blood_type ?? '') }}',
            units:      450,
        },

        // --- Health screening: null = unanswered, true = yes, false = no ---
        health: Array(7).fill(null),
        healthQuestions: [
            { text: 'Are you feeling well and in good health today?',                            failOnNo: true  },
            { text: 'Do you have a fever, cough, cold, or flu symptoms right now?',              failOnYes: true },
            { text: 'Is your blood pressure within the normal range (90/60–160/100 mmHg)?',      failOnNo: true  },
            { text: 'Are you free from any active infections or skin diseases?',                 failOnNo: true  },
            { text: 'Have you slept at least 6 hours last night?',                               failOnNo: true  },
            { text: 'Did you eat a meal within the last 4 hours before coming here?',            failOnNo: true  },
            { text: 'Have you consumed alcohol in the past 24 hours?',                          failOnYes: true },
        ],

        // --- Eligibility: failOnYes = disqualifying if answered Yes ---
        elig: Array(8).fill(null),
        eligQuestions: [
            { text: 'Are you pregnant, recently gave birth, or currently breastfeeding?',                 failOnYes: true,  permanent: false },
            { text: 'Have you had a tattoo, piercing, or acupuncture in the past 12 months?',             failOnYes: true,  permanent: false },
            { text: 'Have you undergone surgery or a major dental procedure in the last 6 months?',       failOnYes: true,  permanent: false },
            { text: 'Have you received a vaccine in the last 4 weeks?',                                   failOnYes: true,  permanent: false },
            { text: 'Have you donated blood in the past 3 months?',                                       failOnYes: true,  permanent: false },
            { text: 'Are you currently taking antibiotics or blood-thinning medications?',                failOnYes: true,  permanent: false },
            { text: 'Have you ever tested positive for HIV/AIDS, Hepatitis B, or Hepatitis C?',           failOnYes: true,  permanent: true  },
            { text: 'Have you ever been diagnosed with leukemia, lymphoma, or a serious blood disorder?', failOnYes: true,  permanent: true  },
        ],

        init() {
            // pre-fill blood type radio if user has it set
        },

        maxDob() {
            const d = new Date();
            d.setFullYear(d.getFullYear() - 16);
            return d.toISOString().split('T')[0];
        },

        step1Valid() {
            return this.form.name && this.form.dob && this.form.phone &&
                   this.form.address && this.form.id_type &&
                   this.form.weight_kg && parseFloat(this.form.weight_kg) >= 50;
        },

        healthDQ() {
            return this.healthQuestions.some((q, i) => {
                if (this.health[i] === null) return false;
                return (q.failOnYes && this.health[i] === true) ||
                       (q.failOnNo  && this.health[i] === false);
            });
        },
        step2Valid() {
            const allAnswered = this.health.every(h => h !== null);
            return allAnswered && !this.healthDQ();
        },

        eligPermDQ() {
            return this.eligQuestions.some((q, i) =>
                q.permanent && q.failOnYes && this.elig[i] === true
            );
        },
        eligDQ() {
            return this.eligQuestions.some((q, i) => {
                if (this.elig[i] === null) return false;
                return q.failOnYes && this.elig[i] === true;
            });
        },
        step3Valid() {
            const allAnswered = this.elig.every(e => e !== null);
            return allAnswered && !this.eligDQ();
        },

        step4Valid() {
            return !!this.form.blood_type && this.form.units >= 200 && this.form.units <= 500;
        },

        buildHealthNotes() {
            let notes = [];
            this.healthQuestions.forEach((q, i) => {
                if (this.health[i] !== null)
                    notes.push(q.text + ' → ' + (this.health[i] ? 'Yes' : 'No'));
            });
            this.eligQuestions.forEach((q, i) => {
                if (this.elig[i] !== null)
                    notes.push(q.text + ' → ' + (this.elig[i] ? 'Yes' : 'No'));
            });
            return notes.join('\n');
        },

        goNext(step) {
            if (step === 1 && this.step1Valid())  this.current = 2;
            if (step === 2 && this.step2Valid())  this.current = 3;
            if (step === 3 && this.step3Valid())  this.current = 4;
            if (step === 4 && this.step4Valid())  this.current = 5;
        },
    }
}
</script>
</x-layout>
