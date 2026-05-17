<x-layout>
    <style>
        .page-main-container {
            font-family: 'DM Sans', sans-serif;
            padding: 60px 20px;
            background-color: #f8fafc;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .lf-page-header {
            width: 100%;
            max-width: 1100px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
        }

        .lf-page-title {
            font-family: 'DM Sans', sans-serif;
            font-size: 28px;
            font-weight: 800;
            color: #0f172a;
            margin: 0;
            line-height: 1.2;
            letter-spacing: -0.03em;
        }

        .lf-card {
            background: white;
            border-radius: 24px;
            padding: 50px;
            box-shadow: 0 15px 35px -5px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
            width: 100%;
            max-width: 1100px;
            box-sizing: border-box;
        }

        .form-label {
            display: block;
            font-family: 'DM Sans', sans-serif;
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
            padding: 18px;
            font-family: 'DM Sans', sans-serif;
            box-sizing: border-box;
            font-size: 16px;
            outline: none;
            transition: 0.2s;
        }

        .form-input:focus {
            border-color: #3b82f6;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        }

        .custom-select-container {
            position: relative;
            width: 100%;
        }

        .custom-select-button {
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            text-align: left;
        }

        .custom-dropdown-list {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            margin-top: 10px;
            max-height: 350px;
            overflow-y: auto;
            z-index: 50;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .dropdown-group-label {
            font-family: 'DM Sans', sans-serif;
            padding: 12px 18px;
            font-size: 12px;
            font-weight: 800;
            color: #64748b;
            background: #f8fafc;
            text-transform: uppercase;
        }

        .dropdown-item {
            font-family: 'DM Sans', sans-serif;
            padding: 14px 24px;
            font-size: 15px;
            color: #334155;
            cursor: pointer;
            transition: 0.2s;
        }

        .dropdown-item:hover {
            background-color: #f1f5f9;
            color: #ef4444;
        }

        .btn-submit {
            width: 100%;
            background-color: #ef4444;
            color: white;
            border: none;
            border-radius: 12px;
            padding: 20px;
            font-family: 'DM Sans', sans-serif;
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

        [x-cloak] { display: none !important; }
    </style>

    <div class="page-main-container">
        <div class="lf-page-header">
            <h1 class="lf-page-title">Blood Request</h1>
            <div style="font-family: 'DM Sans', sans-serif; font-weight: 600; color: #64748b; font-size: 18px;">
                {{ now()->format('F j, Y') }} 
            </div>
        </div>

        <div class="lf-card">
            <h2 style="font-family: 'DM Sans', sans-serif; margin-bottom: 35px; color: #1e293b; font-weight: 700; font-size: 24px;">Patient & Request Details</h2>

            <form action="{{ route('blood-requests.store') }}" method="POST">
                @csrf

                <div style="margin-bottom: 25px;">
                    <label class="form-label">Patient Name</label>
                    <input type="text" name="patient_name" class="form-input" placeholder="Full name of the patient" required>
                </div>

                <div style="display:grid; grid-template-columns:1fr 1fr; gap:30px; margin-bottom:25px;">
                    <div x-data="{ 
                        open: false, 
                        selected: '', 
                        placeholder: 'Select Hospital',
                        hospitals: [
                            { group: 'Davao City', names: ['Southern Philippines Medical Center (SPMC)', 'Davao Doctors Hospital', 'San Pedro Hospital', 'Brokenshire Medical Center', 'Metro Davao Medical Research Center (MDMRC)', 'Ricardo Limso Medical Center'] },
                            { group: 'Davao del Norte', names: ['Davao Regional Medical Center (DRMC)', 'Tagum Doctors Hospital', 'Tagum Global Medical Center', 'Bishop Joseph Regan Memorial Hospital'] },
                            { group: 'Davao del Sur', names: ['Davao del Sur Provincial Hospital', 'Digos Doctors Hospital'] },
                            { group: 'Davao de Oro', names: ['Davao de Oro Provincial Hospital'] },
                            { group: 'Davao Oriental', names: ['Davao Oriental Provincial Medical Center'] }
                        ]
                    }" class="custom-select-container">
                        <label class="form-label">Hospital Name</label>
                        <input type="hidden" name="hospital" :value="selected" required>

                        <button type="button" @click="open = !open" class="form-input custom-select-button">
                            <span x-text="selected ? selected : placeholder" :style="selected ? 'color: #1e293b' : 'color: #94a3b8'"></span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" :style="open ? 'transform: rotate(180deg)' : ''" style="transition: 0.3s;"><polyline points="6 9 12 15 18 9"></polyline></svg>
                        </button>

                        <div x-show="open" @click.outside="open = false" x-cloak class="custom-dropdown-list">
                            <template x-for="region in hospitals" :key="region.group">
                                <div>
                                    <div class="dropdown-group-label" x-text="region.group"></div>
                                    <template x-for="name in region.names" :key="name">
                                        <div class="dropdown-item" @click="selected = name; open = false" x-text="name"></div>
                                    </template>
                                </div>
                            </template>
                        </div>
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

                <div style="display:grid; grid-template-columns:1fr 1fr; gap:30px; margin-bottom:25px;">
                    <div>
                        <label class="form-label">Units Needed (ml)</label>
                        <input type="number" name="units" class="form-input" placeholder="e.g. 450" required min="1">
                    </div>
                    <div>
                        <label class="form-label">Needed By Date</label>
                        <input type="date" name="needed_by" class="form-input" required min="{{ date('Y-m-d') }}">
                    </div>
                </div>

                <div style="margin-bottom: 25px;">
                    <label class="form-label">Priority Level</label>
                    <select name="priority" class="form-input" required>
                        <option value="Normal">Normal</option>
                        <option value="Urgent">Urgent</option>
                        <option value="Emergency">Emergency (Critical)</option>
                    </select>
                </div>

                <div style="margin-bottom: 35px;">
                    <label class="form-label">Reason for Request</label>
                    <textarea name="reason" class="form-input" style="height: 120px; resize: none;" placeholder="Medical condition or reason for request..."></textarea>
                </div>

                <button type="submit" class="btn-submit">
                    Submit Blood Request
                </button>
                
                <a href="{{ route('dashboard') }}" style="display: block; text-align: center; margin-top: 25px; color: #64748b; text-decoration: none; font-size: 15px; font-weight: 600; font-family: 'DM Sans', sans-serif;">
                    Cancel and Go Back
                </a>
            </form>
        </div>
    </div>
</x-layout>