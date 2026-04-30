<x-layout>
    <div style="max-width: 900px; margin: 0 auto; font-family: 'DM Sans', sans-serif;">
        
        <div style="margin-bottom: 40px;">
            <h1 style="font-size: 32px; font-weight: 800; color: #1a1a1a; margin: 0;">Profile Settings</h1>
            <p style="color: #64748b; margin-top: 8px;">Manage your account information and medical donor details.</p>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 30px;">
            
            <div>
                <div style="background: #0A0A0A; padding: 40px; border-radius: 24px; text-align: center; border: 1px solid rgba(192, 57, 43, 0.3);">
                    <div style="position: relative; display: inline-block; margin-bottom: 20px;">
                        <div style="width: 120px; height: 120px; border-radius: 50%; background: #1a1a1a; border: 4px solid var(--red); overflow: hidden; display: flex; align-items: center; justify-content: center;">
                            @if(auth()->user()->profile_photo)
                                <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}" style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                                <span style="font-size: 40px; color: #fff;">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</span>
                            @endif
                        </div>
                    </div>
                    <h3 style="color: #fff; margin: 0; font-size: 20px;">{{ auth()->user()->name }}</h3>
                    <p style="color: #A0A0A0; font-size: 14px; margin-top: 5px;">{{ auth()->user()->email }}</p>
                    
                    <div style="margin-top: 25px; background: rgba(192, 57, 43, 0.1); padding: 15px; border-radius: 12px; border: 1px solid rgba(192, 57, 43, 0.2);">
                        <div style="color: var(--red); font-weight: 800; font-size: 24px;">{{ auth()->user()->blood_type ?? '??' }}</div>
                        <div style="color: #A0A0A0; font-size: 11px; text-transform: uppercase; font-weight: 700; letter-spacing: 1px;">Verified Blood Type</div>
                    </div>
                </div>
            </div>

            <div style="background: #fff; padding: 40px; border-radius: 24px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div style="margin-bottom: 25px;">
                        <label style="display: block; font-weight: 700; font-size: 14px; margin-bottom: 8px; color: #1e293b;">Profile Photo</label>
                        <input type="file" name="profile_photo" style="font-size: 13px; color: #64748b;">
                        <p style="font-size: 11px; color: #94a3b8; margin-top: 5px;">Recommended: Square JPG or PNG. Max 2MB.</p>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 25px;">
                        <div>
                            <label style="display: block; font-weight: 700; font-size: 14px; margin-bottom: 8px; color: #1e293b;">Full Name</label>
                            <input type="text" name="name" value="{{ auth()->user()->name }}" style="width: 100%; padding: 12px; border-radius: 10px; border: 1px solid #e2e8f0; background: #f8fafc;">
                        </div>
                        <div>
                            <label style="display: block; font-weight: 700; font-size: 14px; margin-bottom: 8px; color: #1e293b;">Blood Type</label>
                            <select name="blood_type" style="width: 100%; padding: 12px; border-radius: 10px; border: 1px solid #e2e8f0; background: #f8fafc;">
                                @foreach(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $type)
                                    <option value="{{ $type }}" {{ auth()->user()->blood_type == $type ? 'selected' : '' }}>{{ $type }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div style="margin-bottom: 30px;">
                        <label style="display: block; font-weight: 700; font-size: 14px; margin-bottom: 8px; color: #1e293b;">Email Address</label>
                        <input type="email" name="email" value="{{ auth()->user()->email }}" style="width: 100%; padding: 12px; border-radius: 10px; border: 1px solid #e2e8f0; background: #f8fafc;">
                    </div>

                    <div style="border-top: 1px solid #f1f5f9; padding-top: 30px; display: flex; justify-content: flex-end; gap: 15px;">
                        <a href="{{ route('dashboard') }}" style="padding: 12px 24px; border-radius: 10px; text-decoration: none; color: #64748b; font-weight: 600; font-size: 14px;">Cancel</a>
                        <button type="submit" style="background: #0A0A0A; color: #fff; padding: 12px 30px; border: none; border-radius: 10px; font-weight: 700; cursor: pointer; border: 1px solid var(--red);">Save Changes</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-layout>