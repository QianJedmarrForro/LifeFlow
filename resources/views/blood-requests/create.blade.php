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
        transition: 0.2s;
    }

    .form-input:focus {
        border-color: #3b82f6;
        background: #fff;
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
</style>

<div class="page-main-container">
    <div class="lf-page-header">
        <h1 class="lf-page-title">Blood Request</h1>
        <div style="font-weight: 600; color: #64748b;">
            {{ now()->format('F j, Y') }} 🏥
        </div>
    </div>

    <div class="lf-card">
        <h2 style="margin-bottom: 25px; color: #1e293b; font-weight: 700;">Patient & Request Details</h2>

        <form action="{{ route('blood-requests.store') }}" method="POST">
            @csrf

            <div style="margin-bottom: 20px;">
                <label class="form-label">Patient Name</label>
                <input type="text" name="patient_name" class="form-input" placeholder="Full name of the patient" required>
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-bottom:20px;">
                <div>
                    <label class="form-label">Hospital Name</label>
                    <input type="text" name="hospital" class="form-input" placeholder="Name of hospital" required>
                </div>
                <div>
                    <label class="form-label">Blood Type Needed</label>
                    <select name="blood_type" class="form-input" required>
                        <option value="" disabled selected>Select Type</option>
                        @foreach(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $type)
                            <option value="{{ $type }}">{{ $type }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-bottom:20px;">
                <div>
                    <label class="form-label">Units Needed (ml)</label>
                    <input type="number" name="units" class="form-input" placeholder="e.g. 450" required min="1">
                </div>
                <div>
                    <label class="form-label">Needed By Date</label>
                    <input type="date" name="needed_by" class="form-input" required min="{{ date('Y-m-d') }}">
                </div>
            </div>

            <div style="margin-bottom: 20px;">
                <label class="form-label">Priority Level</label>
                <select name="priority" class="form-input" required>
                    <option value="Normal">Normal</option>
                    <option value="Urgent">Urgent</option>
                    <option value="Emergency">Emergency (Critical)</option>
                </select>
            </div>

            <div style="margin-bottom: 30px;">
                <label class="form-label">Reason for Request</label>
                <textarea name="reason" class="form-input" style="height: 100px; resize: none;" placeholder="Medical condition or reason for request..."></textarea>
            </div>

            <button type="submit" class="btn-submit">
                Submit Blood Request
            </button>
            
            <a href="{{ route('dashboard') }}" style="display: block; text-align: center; margin-top: 20px; color: #64748b; text-decoration: none; font-size: 14px; font-weight: 600;">
                Cancel and Go Back
            </a>
        </form>
    </div>
</div>
</x-layout>