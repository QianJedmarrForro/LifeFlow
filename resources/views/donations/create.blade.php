<x-layout>
<style>
    .page-main-container {
        font-family: 'DM Sans', sans-serif;
        padding: 40px;
        background-color: #f8fafc;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .lf-page-header {
        width: 100%;
        max-width: 800px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .lf-page-title {
        font-family: 'Serif', 'Georgia', serif;
        font-size: 36px;
        color: #1e293b;
        margin: 0;
    }

    .lf-card {
        background: white;
        border-radius: 16px;
        padding: 40px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        border: 1px solid #e2e8f0;
        width: 100%;
        max-width: 800px;
        box-sizing: border-box;
    }

    .form-label {
        display: block;
        font-weight: 700;
        color: #1e40af;
        margin-bottom: 8px;
        font-size: 13px;
        text-transform: uppercase;
    }

    .form-input {
        width: 100%;
        background: #f1f5f9;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 14px;
        font-family: inherit;
        box-sizing: border-box;
        font-size: 14px;
        outline: none;
        transition: border-color 0.2s;
    }

    .form-input:focus {
        border-color: #3b82f6;
    }

    .btn-submit {
        width: 100%;
        background-color: #ef4444;
        color: white;
        border: none;
        border-radius: 10px;
        padding: 16px;
        font-weight: 700;
        font-size: 16px;
        cursor: pointer;
        transition: 0.3s;
        margin-top: 10px;
    }

    .btn-submit:hover {
        background-color: #dc2626;
        transform: translateY(-1px);
    }

    .blood-option {
        border: 1px solid #e2e8f0;
        padding: 12px;
        text-align: center;
        border-radius: 8px;
        font-weight: 700;
        color: #ef4444;
        background: #fff;
        transition: all 0.2s ease;
        cursor: pointer;
    }

    .blood-option:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 15px rgba(0,0,0,0.08);
        border-color: #ef4444;
    }

    .blood-option.selected {
        background: #ef4444;
        color: white;
        border-color: #ef4444;
        transform: scale(1.05);
    }
</style>

<div class="page-main-container">
    <div class="lf-page-header">
        <h1 class="lf-page-title">Donation Registration</h1>
        <div style="font-weight: 600; color: #64748b;">
            {{ now()->format('F j, Y') }} 🔔
        </div>
    </div>

    <div class="lf-card">
        <h2 style="margin-bottom: 25px; color: #1e293b;">Donor Information</h2>

        <form action="{{ route('donations.store') }}" method="POST">
            @csrf

            <div style="margin-bottom: 20px;">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" class="form-input" value="{{ auth()->user()->name }}" required>
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-bottom:20px;">
                <div>
                    <label class="form-label">Date of Birth</label>
                    <input type="date" name="dob" class="form-input" required>
                </div>
                <div>
                    <label class="form-label">Address</label>
                    <input type="text" name="address" class="form-input" placeholder="City, Province" required>
                </div>
            </div>

            <div style="margin-bottom:25px;">
                <label class="form-label">Select Blood Type</label>
                <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:10px;">
                    @foreach(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $type)
                        <label>
                            <input type="radio" name="blood_type" value="{{ $type }}" required
                                style="display:none;"
                                id="type_{{ $type }}"
                                onchange="updateBloodSelection()">
                            <div class="blood-option" id="label_{{ $type }}"
                                onclick="document.getElementById('type_{{ $type }}').checked = true; updateBloodSelection();">
                                {{ $type }}
                            </div>
                        </label>
                    @endforeach
                </div>
            </div>

            <div style="margin-bottom: 25px;">
                <label class="form-label">Volume to Donate (ml)</label>
                <input type="number" name="units" class="form-input" 
                       placeholder="Standard donation is 450" value="450" min="100" max="1000" required>
                <small style="color: #64748b; font-size: 11px; margin-top: 5px; display: block;">
                    * 450ml is the standard volume for a single bag.
                </small>
            </div>

            <div style="margin-bottom:30px; background:#f8fafc; padding:15px; border-radius:10px; border:1px solid #e2e8f0;">
                <label style="display:flex; align-items:center; gap:12px; font-size:14px; cursor: pointer;">
                    <input type="checkbox" name="eligible" value="1" required style="width: 18px; height: 18px;">
                    <span>I confirm that I am in good health and meet the eligibility requirements for blood donation.</span>
                </label>
            </div>

            <button type="submit" class="btn-submit">
                Submit Donation Record
            </button>

            <a href="{{ route('dashboard') }}" style="display: block; text-align: center; margin-top: 20px; color: #64748b; text-decoration: none; font-size: 14px; font-weight: 600;">
                ← Back to Dashboard
            </a>
        </form>
    </div>
</div>

<script>
function updateBloodSelection() {
    const types = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
    types.forEach(type => {
        let radio = document.getElementById('type_' + type);
        let label = document.getElementById('label_' + type);
        if (radio && label) {
            if (radio.checked) {
                label.classList.add('selected');
            } else {
                label.classList.remove('selected');
            }
        }
    });
}
</script>
</x-layout>