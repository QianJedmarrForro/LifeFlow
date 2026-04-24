<x-layout>
    <style>
        .page-main-container {
            font-family: 'DM Sans', sans-serif;
            padding: 40px;
            background-color: #f8fafc; /* Uniform light gray background */
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
            color: #1e40af; /* Uniform blue label color */
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
        }

        .btn-submit {
            width: 100%;
            background-color: #ef4444; /* LifeFlow Red */
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
        }
    </style>

    <div class="page-main-container">
        
        <div class="lf-page-header">
            <h1 class="lf-page-title">Request Blood</h1>
            <div style="font-weight: 600; color: #64748b;">
                {{ now()->format('F d, Y') }} 🔔
            </div>
        </div>

        @if(session('success'))
            <div style="width: 100%; max-width: 800px; background: #dcfce7; color: #166534; padding: 15px; border-radius: 12px; margin-bottom: 20px; border-left: 5px solid #22c55e;">
                {{ session('success') }}
            </div>
        @endif

        <div class="lf-card">
            <h2 style="margin-top: 0; margin-bottom: 30px; font-size: 22px; color: #1e293b; border-bottom: 2px solid #f1f5f9; padding-bottom: 15px;">
                Blood Request Form
            </h2>

            <form action="{{ route('blood-requests.store') }}" method="POST">
                @csrf
                
                <div style="margin-bottom: 20px;">
                    <label class="form-label">Hospital / Clinic</label>
                    <input type="text" name="hospital" class="form-input" placeholder="e.g. Metro Medical Center" required>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                    <div>
                        <label class="form-label">Blood Type</label>
                        <select name="blood_type" class="form-input" required>
                            @foreach(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $type)
                                <option value="{{ $type }}">{{ $type }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="form-label">Units (Bags)</label>
                        <input type="number" name="units" class="form-input" value="1" min="1" required>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                    <div>
                        <label class="form-label">Priority Level</label>
                        <select name="priority" class="form-input" required>
                            <option value="Normal">Normal</option>
                            <option value="Urgent">Urgent</option>
                            <option value="Emergency">Emergency</option>
                        </select>
                    </div>
                    <div>
                        <label class="form-label">Needed By Date</label>
                        <input type="date" name="needed_by" class="form-input" required>
                    </div>
                </div>

                <div style="margin-bottom: 20px;">
                    <label class="form-label">Patient Full Name</label>
                    <input type="text" name="patient_name" class="form-input" placeholder="Enter Full Name" required>
                </div>

                <div style="margin-bottom: 30px;">
                    <label class="form-label">Reason / Diagnosis</label>
                    <textarea name="reason" class="form-input" rows="3" placeholder="Brief description..." style="resize: none;"></textarea>
                </div>

                <button type="submit" class="btn-submit">
                    Submit Request
                </button>
            </form>
        </div>
    </div>
</x-layout>