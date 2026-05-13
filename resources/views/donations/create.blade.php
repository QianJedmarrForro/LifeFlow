<x-layout>
<style>
    .page-main-container {
        font-family: 'DM Sans', sans-serif;
        padding: 60px 20px; /* Gidugangan ang padding sa taas/ubos */
        background-color: #f8fafc;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .lf-page-header {
        width: 100%;
        max-width: 1100px; /* Gidako para parehas sa pikas */
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 40px;
    }

    .lf-page-title {
        font-family: 'Serif', 'Georgia', serif;
        font-size: 42px; /* Gidako ang title font */
        color: #1e293b;
        margin: 0;
    }

    .lf-card {
        background: white;
        border-radius: 24px; /* Mas rounded */
        padding: 50px; /* Gidako ang internal padding */
        box-shadow: 0 15px 35px -5px rgba(0, 0, 0, 0.05);
        border: 1px solid #e2e8f0;
        width: 100%;
        max-width: 1100px; /* Card width match na sa request form */
        box-sizing: border-box;
    }

    .form-label {
        display: block;
        font-weight: 700;
        color: #1e40af;
        margin-bottom: 12px;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .form-input {
        width: 100%;
        background: #f1f5f9;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 18px; /* Mas dako nga input height */
        font-family: inherit;
        box-sizing: border-box;
        font-size: 16px; /* Gidako ang font size sa input */
        outline: none;
        transition: 0.2s;
    }

    .form-input:focus {
        border-color: #3b82f6;
        background: #fff;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
    }

    .btn-submit {
        width: 100%;
        background-color: #ef4444;
        color: white;
        border: none;
        border-radius: 12px;
        padding: 20px; /* Dako nga button */
        font-weight: 700;
        font-size: 18px;
        cursor: pointer;
        transition: 0.3s;
        margin-top: 20px;
    }

    .btn-submit:hover {
        background-color: #dc2626;
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(220, 38, 38, 0.3);
    }

    /* Blood Grid Section */
    .blood-option {
        border: 1px solid #e2e8f0;
        padding: 20px; /* Mas dako nga box para sa blood type */
        text-align: center;
        border-radius: 12px;
        font-weight: 700;
        font-size: 18px;
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
        <div style="font-weight: 600; color: #64748b; font-size: 18px;">
            {{ now()->format('F j, Y') }} 🔔
        </div>
    </div>

    <div class="lf-card">
        <h2 style="margin-bottom: 35px; color: #1e293b; font-weight: 700; font-size: 24px;">Donor Information</h2>

        <form action="{{ route('donations.store') }}" method="POST">
            @csrf

            <div style="margin-bottom: 25px;">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" class="form-input" value="{{ auth()->user()->name }}" required>
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:30px; margin-bottom:25px;">
                <div>
                    <label class="form-label">Date of Birth</label>
                    <input type="date" name="dob" class="form-input" required>
                </div>
                <div>
                    <label class="form-label">Address</label>
                    <input type="text" name="address" class="form-input" placeholder="City, Province" required>
                </div>
            </div>

            <div style="margin-bottom:30px;">
                <label class="form-label">Select Blood Type</label>
                <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:15px;">
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

            <div style="margin-bottom: 30px;">
                <label class="form-label">Volume to Donate (ml)</label>
                <input type="number" name="units" class="form-input" 
                       placeholder="Standard donation is 450" value="450" min="100" max="1000" required>
                <small style="color: #64748b; font-size: 13px; margin-top: 10px; display: block;">
                    * 450ml is the standard volume for a single bag.
                </small>
            </div>

            <div style="margin-bottom:35px; background:#f8fafc; padding:20px; border-radius:15px; border:1px solid #e2e8f0;">
                <label style="display:flex; align-items:center; gap:15px; font-size:16px; cursor: pointer;">
                    <input type="checkbox" name="eligible" value="1" required style="width: 22px; height: 22px;">
                    <span>I confirm that I am in good health and meet the eligibility requirements for blood donation.</span>
                </label>
            </div>

            <button type="submit" class="btn-submit">
                Submit Donation Record
            </button>

            <a href="{{ route('dashboard') }}" style="display: block; text-align: center; margin-top: 25px; color: #64748b; text-decoration: none; font-size: 15px; font-weight: 600;">
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