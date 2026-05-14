{{-- If profile photos don't show, run: php artisan storage:link --}}
<x-layout>
    <div style="max-width: 900px; margin: 0 auto; font-family: 'DM Sans', sans-serif; padding: 20px;">
        
        <div style="margin-bottom: 40px;">
            <h1 style="font-size: 32px; font-weight: 800; color: #1a1a1a; margin: 0;">Profile Settings</h1>
            <p style="color: #64748b; margin-top: 8px;">Manage your account information and medical donor details.</p>
        </div>

        @if(session('success'))
            <div style="background:#ecfdf5; border-left:4px solid #10b981; padding:12px 16px; border-radius:8px; margin-bottom:24px; color:#065f46; font-weight:600; font-size:14px;">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div style="background:#fef2f2; border-left:4px solid #ef4444; padding:12px 16px; border-radius:8px; margin-bottom:24px; color:#991b1b; font-weight:600; font-size:14px;">
                {{ session('error') }}
            </div>
        @endif
        @if($errors->any())
            <div style="background:#fef2f2; border-left:4px solid #ef4444; padding:12px 16px; border-radius:8px; margin-bottom:24px; color:#991b1b; font-size:13px;">
                <strong style="font-weight:700;">Please fix the following:</strong>
                <ul style="margin:8px 0 0 16px; padding:0;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 30px;">
            
            <!-- Left Side: Profile Card -->
            <div>
                <div style="background: #0A0A0A; padding: 40px; border-radius: 24px; text-align: center; border: 1px solid rgba(192, 57, 43, 0.3); position: sticky; top: 20px;">
                    <div style="position: relative; display: inline-block; margin-bottom: 20px;">
                        <div id="profile-avatar-container" style="width: 120px; height: 120px; border-radius: 50%; background: #1a1a1a; border: 4px solid #C0392B; overflow: hidden; display: flex; align-items: center; justify-content: center;">
                            {{-- Check if user has photo AND the file actually exists in storage --}}
                            @if(auth()->user()->profile_photo)
                                <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}" 
                                     style="width: 100%; height: 100%; object-fit: cover;"
                                     onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                <span style="display: none; font-size: 40px; color: #fff;">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</span>
                            @else
                                <span style="font-size: 40px; color: #fff;">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</span>
                            @endif
                        </div>
                    </div>
                    <h3 style="color: #fff; margin: 0; font-size: 20px;">{{ auth()->user()->name }}</h3>
                    <p style="color: #A0A0A0; font-size: 14px; margin-top: 5px;">{{ auth()->user()->email }}</p>
                    
                    <div style="margin-top: 25px; background: rgba(192, 57, 43, 0.1); padding: 15px; border-radius: 12px; border: 1px solid rgba(192, 57, 43, 0.2);">
                        {{-- Shows blood type from DB, defaults to ?? if null --}}
                        <div style="color: #C0392B; font-weight: 800; font-size: 24px;">{{ auth()->user()->blood_type ?? '??' }}</div>
                        <div style="color: #A0A0A0; font-size: 11px; text-transform: uppercase; font-weight: 700; letter-spacing: 1px;">Verified Blood Type</div>
                    </div>
                </div>
            </div>

            <!-- Right Side: Edit Form -->
            <div style="background: #fff; padding: 40px; border-radius: 24px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div style="margin-bottom: 25px;">
                        <label style="display: block; font-weight: 700; font-size: 14px; margin-bottom: 8px; color: #1e293b;">Update Profile Photo</label>
                        <input type="file" name="profile_photo" id="profile_photo" accept="image/*" style="display: none;">
                        <button type="button" id="upload-btn" style="background: #f8fafc; color: #64748b; border: 1px solid #e2e8f0; padding: 12px 16px; border-radius: 10px; cursor: pointer; font-size: 13px; width: 100%; text-align: left;">Choose File</button>
                        <p style="font-size: 11px; color: #94a3b8; margin-top: 5px;">Recommended: Square JPG or PNG. Max 2MB.</p>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 25px;">
                        <div>
                            <label style="display: block; font-weight: 700; font-size: 14px; margin-bottom: 8px; color: #1e293b;">Full Name</label>
                            <input type="text" name="name" value="{{ auth()->user()->name }}" required style="width: 100%; padding: 12px; border-radius: 10px; border: 1px solid #e2e8f0; background: #f8fafc;">
                        </div>
                        <div>
                            <label style="display: block; font-weight: 700; font-size: 14px; margin-bottom: 8px; color: #1e293b;">Blood Type</label>
                            <select name="blood_type" style="width: 100%; padding: 12px; border-radius: 10px; border: 1px solid #e2e8f0; background: #f8fafc;">
                                <option value="" disabled {{ is_null(auth()->user()->blood_type) ? 'selected' : '' }}>Select Type</option>
                                @foreach(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $type)
                                    <option value="{{ $type }}" {{ auth()->user()->blood_type == $type ? 'selected' : '' }}>{{ $type }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div style="margin-bottom: 30px;">
                        <label style="display: block; font-weight: 700; font-size: 14px; margin-bottom: 8px; color: #1e293b;">Email Address</label>
                        <input type="email" name="email" value="{{ auth()->user()->email }}" required style="width: 100%; padding: 12px; border-radius: 10px; border: 1px solid #e2e8f0; background: #f8fafc;">
                    </div>

                    <div style="margin-bottom: 30px;">
                        <label style="display: block; font-weight: 700; font-size: 14px; margin-bottom: 8px; color: #1e293b;">New Password <span style="color:#94a3b8; font-weight:400;">(leave blank to keep current)</span></label>
                        <input type="password" name="password" placeholder="••••••••" style="width: 100%; padding: 12px; border-radius: 10px; border: 1px solid #e2e8f0; background: #f8fafc;">
                    </div>

                    <div style="border-top: 1px solid #f1f5f9; padding-top: 30px; display: flex; justify-content: flex-end; gap: 15px;">
                        <a href="{{ route('dashboard') }}" style="padding: 12px 24px; border-radius: 10px; text-decoration: none; color: #64748b; font-weight: 600; font-size: 14px;">Cancel</a>
                        <button type="submit" style="background: #0A0A0A; color: #fff; padding: 12px 30px; border: none; border-radius: 10px; font-weight: 700; cursor: pointer; border: 1px solid #C0392B;">Save Changes</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-layout>

<script>
document.getElementById('upload-btn').addEventListener('click', function() {
    document.getElementById('profile_photo').click();
});

document.getElementById('profile_photo').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const btn = document.getElementById('upload-btn');
    if (file) {
        btn.textContent = file.name;
        // Existing preview code
        const reader = new FileReader();
        reader.onload = function(e) {
            const container = document.getElementById('profile-avatar-container');
            const img = container.querySelector('img');
            if (img) {
                img.src = e.target.result;
                img.style.display = 'block';
                const span = container.querySelector('span');
                if (span) span.style.display = 'none';
            } else {
                const span = container.querySelector('span');
                const newImg = document.createElement('img');
                newImg.src = e.target.result;
                newImg.style = "width: 100%; height: 100%; object-fit: cover;";
                container.replaceChild(newImg, span);
            }
        };
        reader.readAsDataURL(file);
    } else {
        btn.textContent = 'Choose File';
    }
});
</script>