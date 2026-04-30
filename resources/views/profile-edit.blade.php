<x-layout>
<style>
    .profile-container {
        font-family: 'DM Sans', sans-serif;
        padding: 40px;
        background-color: #f8fafc;
        min-height: 100vh;
        display: flex;
        justify-content: center;
    }
    .profile-card {
        background: white;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        border: 1px solid #e2e8f0;
        width: 100%;
        max-width: 600px;
    }
    .photo-upload-section {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-bottom: 30px;
        text-align: center;
    }
    .current-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #f1f5f9;
        margin-bottom: 15px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    .form-group {
        margin-bottom: 20px;
    }
    .form-label {
        display: block;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 8px;
        font-size: 14px;
    }
    .form-input {
        width: 100%;
        padding: 12px 16px;
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        background: #f8fafc;
        font-family: inherit;
        font-size: 15px;
        transition: 0.2s;
        box-sizing: border-box;
    }
    .form-input:focus {
        outline: none;
        border-color: #ef4444;
        background: #fff;
    }
    .btn-save {
        width: 100%;
        background: #1e293b;
        color: white;
        border: none;
        padding: 14px;
        border-radius: 10px;
        font-weight: 700;
        font-size: 16px;
        cursor: pointer;
        transition: 0.3s;
        margin-top: 10px;
    }
    .btn-save:hover {
        background: #0f172a;
        transform: translateY(-2px);
    }
</style>

<div class="profile-container">
    <div class="profile-card">
        <h2 style="margin: 0 0 10px 0; font-size: 24px; color: #1e293b;">Account Settings</h2>
        <p style="color: #64748b; margin-bottom: 30px;">Update your personal information and profile picture.</p>

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="photo-upload-section">
                @if(auth()->user()->profile_photo)
                    <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}" class="current-avatar">
                @else
                    <div class="current-avatar" style="display: flex; align-items: center; justify-content: center; background: #f1f5f9; font-size: 40px;">👤</div>
                @endif
                <label for="profile_photo" style="cursor: pointer; color: #ef4444; font-weight: 600; font-size: 14px;">Change Photo</label>
                <input type="file" name="profile_photo" id="profile_photo" style="display: none;" onchange="this.form.submit()">
            </div>

            <div class="form-group">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" class="form-input" value="{{ old('name', auth()->user()->name) }}" required>
            </div>

            <div class="form-group">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-input" value="{{ old('email', auth()->user()->email) }}" required>
            </div>

            <div class="form-group">
                <label class="form-label">New Password (leave blank to keep current)</label>
                <input type="password" name="password" class="form-input" placeholder="••••••••">
            </div>

            <button type="submit" class="btn-save">Save Changes</button>
            
            <a href="{{ route('dashboard') }}" style="display: block; text-align: center; margin-top: 20px; color: #64748b; text-decoration: none; font-size: 14px;">
                Back to Dashboard
            </a>
        </form>
    </div>
</div>
</x-layout>