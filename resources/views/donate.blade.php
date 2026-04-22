<x-layout>

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">

<style>
    .lf-wrap {
        font-family: 'DM Sans', sans-serif;
        background: #fff5f5;
        border-radius: 24px;
        overflow: hidden;
        max-width: 680px;
        margin: 2rem auto;
        border: 0.5px solid #f0c0c0;
        box-shadow: 0 10px 25px -5px rgba(0,0,0,0.05);
    }

    .lf-header {
        background: linear-gradient(135deg, #c0392b 0%, #e74c3c 60%, #ff6b6b 100%);
        padding: 2.5rem 2rem 2.5rem;
        text-align: center;
        position: relative;
    }

    .lf-header::after {
        content: '';
        position: absolute;
        bottom: -1px; left: 0; right: 0;
        height: 32px;
        background: #fff5f5;
        clip-path: ellipse(55% 100% at 50% 100%);
    }

    .lf-badge {
        display: inline-block;
        font-size: 11px;
        background: rgba(255,255,255,0.2);
        color: #fff;
        padding: 4px 14px;
        border-radius: 20px;
        letter-spacing: 2px;
        text-transform: uppercase;
        margin-bottom: 10px;
    }

    .lf-title {
        font-family: 'Playfair Display', serif;
        font-size: 32px;
        color: #fff;
        margin: 0;
        letter-spacing: -0.5px;
    }

    .lf-sub {
        color: rgba(255,255,255,0.8);
        font-size: 14px;
        margin-top: 6px;
    }

    .lf-body {
        padding: 1rem 2rem 2.5rem;
        background: #fff5f5;
    }

    .lf-section-label {
        font-size: 11px;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: #c0392b;
        font-weight: 600;
        margin: 1.5rem 0 0.75rem;
        border-bottom: 1px solid #f5c6c6;
        padding-bottom: 4px;
    }

    .lf-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }

    .lf-field {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .lf-field.full {
        grid-column: 1 / -1;
    }

    .lf-label {
        font-size: 12px;
        font-weight: 500;
        color: #7a3030;
        letter-spacing: 0.3px;
    }

    .lf-input, .lf-select {
        background: #fff;
        border: 1px solid #f0c0c0;
        border-radius: 10px;
        height: 42px;
        padding: 0 14px;
        font-family: 'DM Sans', sans-serif;
        font-size: 14px;
        color: #333;
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
        width: 100%;
        box-sizing: border-box;
    }

    .lf-input:focus, .lf-select:focus {
        border-color: #e74c3c;
        box-shadow: 0 0 0 3px rgba(231,76,60,0.12);
    }

    .lf-select {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%23c0392b' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 14px center;
        padding-right: 36px;
    }

    .blood-type-grid {
        display: grid;
        grid-template-columns: repeat(8, 1fr);
        gap: 6px;
    }

    .blood-btn {
        height: 40px;
        border: 1.5px solid #f0c0c0;
        border-radius: 8px;
        background: #fff;
        font-family: 'DM Sans', sans-serif;
        font-size: 13px;
        font-weight: 600;
        color: #7a3030;
        cursor: pointer;
        transition: all 0.15s;
    }

    .blood-btn:hover {
        border-color: #e74c3c;
        color: #e74c3c;
    }

    .blood-btn.selected {
        background: #e74c3c;
        border-color: #e74c3c;
        color: #fff;
        box-shadow: 0 4px 10px rgba(231,76,60,0.3);
    }

    .lf-agree {
        display: flex;
        align-items: center;
        gap: 12px;
        background: #fff;
        border: 1px solid #f0c0c0;
        border-radius: 12px;
        padding: 14px 16px;
        margin-top: 1.5rem;
        cursor: pointer;
        transition: background 0.2s;
    }

    .lf-agree:hover { background: #fffcfc; }

    .lf-agree-text {
        font-size: 13px;
        color: #555;
        font-weight: 500;
    }

    .lf-submit {
        width: 100%;
        height: 54px;
        margin-top: 1.5rem;
        background: linear-gradient(135deg, #c0392b, #e74c3c);
        color: #fff;
        border: none;
        border-radius: 14px;
        font-family: 'Playfair Display', serif;
        font-size: 18px;
        letter-spacing: 0.5px;
        cursor: pointer;
        transition: transform 0.1s, opacity 0.2s;
        box-shadow: 0 6px 15px rgba(192, 57, 43, 0.3);
    }

    .lf-submit:hover { opacity: 0.95; }
    .lf-submit:active { transform: scale(0.98); }

    .lf-footer {
        background: #c0392b;
        padding: 15px;
        text-align: center;
        font-size: 12px;
        color: rgba(255,255,255,0.9);
        letter-spacing: 0.5px;
    }

    @media (max-width: 540px) {
        .lf-row { grid-template-columns: 1fr; }
        .blood-type-grid { grid-template-columns: repeat(4, 1fr); }
    }
</style>

<div class="lf-wrap">

    {{-- Header --}}
    <div class="lf-header">
        <div class="lf-badge">LifeFlow</div>
        <h1 class="lf-title">Donor Information</h1>
        <p class="lf-sub">Every donation saves up to 3 lives</p>
    </div>

    {{-- Body --}}
    <div class="lf-body">

        @if (session('success'))
            <div style="background: #d4edda; color: #155724; border: 1px solid #c3e6cb; border-radius: 10px; padding: 12px 16px; margin-bottom: 1rem; font-size: 14px;">
                ✓ {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('donate.submit') }}" method="POST">
            @csrf

            <div class="lf-section-label">Personal details</div>
            <div class="lf-row">
                <div class="lf-field full">
                    <label class="lf-label" for="name">Full name</label>
                    <input class="lf-input" type="text" id="name" name="name"
                        placeholder="e.g. Maria Santos"
                        value="{{ old('name') }}" required>
                </div>

                <div class="lf-field">
                    <label class="lf-label" for="dob">Date of birth</label>
                    <input class="lf-input" type="date" id="dob" name="dob"
                        value="{{ old('dob') }}" required>
                </div>

                <div class="lf-field">
                    <label class="lf-label" for="address">Address</label>
                    <input class="lf-input" type="text" id="address" name="address"
                        placeholder="City, Province"
                        value="{{ old('address') }}">
                </div>
            </div>

            <div class="lf-section-label">Contact</div>
            <div class="lf-row">
                <div class="lf-field">
                    <label class="lf-label" for="email_type">Email type</label>
                    <select class="lf-select" id="email_type" name="email_type">
                        <option value="">Select...</option>
                        <option value="personal" {{ old('email_type') == 'personal' ? 'selected' : '' }}>Personal</option>
                        <option value="work" {{ old('email_type') == 'work' ? 'selected' : '' }}>Work</option>
                    </select>
                </div>

                <div class="lf-field">
                    <label class="lf-label" for="email">Email address</label>
                    <input class="lf-input" type="email" id="email" name="email"
                        placeholder="you@email.com"
                        value="{{ old('email') }}" required>
                </div>

                <div class="lf-field">
                    <label class="lf-label" for="phone_type">Phone type</label>
                    <select class="lf-select" id="phone_type" name="phone_type">
                        <option value="">Select...</option>
                        <option value="mobile" {{ old('phone_type') == 'mobile' ? 'selected' : '' }}>Mobile</option>
                        <option value="landline" {{ old('phone_type') == 'landline' ? 'selected' : '' }}>Landline</option>
                    </select>
                </div>

                <div class="lf-field">
                    <label class="lf-label" for="phone">Phone number</label>
                    <input class="lf-input" type="tel" id="phone" name="phone"
                        placeholder="+63 9XX XXX XXXX"
                        value="{{ old('phone') }}">
                </div>
            </div>

            <div class="lf-section-label">Blood type</div>
            <div class="blood-type-grid">
                @foreach (['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $type)
                    <button type="button" class="blood-btn {{ old('blood_type') == $type ? 'selected' : '' }}"
                        data-val="{{ $type }}">{{ $type }}</button>
                @endforeach
            </div>
            <input type="hidden" id="blood_type" name="blood_type" value="{{ old('blood_type') }}">

            <label class="lf-agree">
                <input type="checkbox" name="eligible" id="eligible" required
                    style="width:18px;height:18px;accent-color:#e74c3c;flex-shrink:0;">
                <span class="lf-agree-text">I confirm that I am healthy and eligible to donate blood</span>
            </label>

            <button type="submit" class="lf-submit">
                Submit Donation Request
            </button>

        </form>
    </div>

    <div class="lf-footer">© 2026 LifeFlow. All Rights Reserved.</div>

</div>

<script>
    document.querySelectorAll('.blood-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.blood-btn').forEach(function(b) {
                b.classList.remove('selected');
            });
            btn.classList.add('selected');
            document.getElementById('blood_type').value = btn.dataset.val;
        });
    });
</script>

</x-layout>