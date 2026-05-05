<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | {{ config('app.name', 'Blood Bank System') }}</title>

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=Playfair+Display:wght@400;500&display=swap" rel="stylesheet"/>

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            min-height: 100vh;
            background: #fdf6f4;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'DM Sans', sans-serif;
            overflow: hidden;
        }

        /* Background blobs */
        .bb-blob-1, .bb-blob-2 {
            position: fixed;
            border-radius: 50%;
            pointer-events: none;
        }

        .bb-blob-1 {
            width: 480px; height: 480px;
            background: radial-gradient(circle, rgba(220,90,70,0.10) 0%, transparent 68%);
            top: -120px; right: -100px;
        }

        .bb-blob-2 {
            width: 320px; height: 320px;
            background: radial-gradient(circle, rgba(220,90,70,0.07) 0%, transparent 68%);
            bottom: -60px; left: -60px;
        }

        .bb-register-container {
            background: #fff;
            border: 1px solid #f0dcd8;
            border-radius: 24px;
            padding: 2.5rem;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 8px 30px rgba(200,60,60,0.12);
            z-index: 2;
            text-align: center;
        }

        .bb-logo-wrap {
            width: 100%;
            height: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: -10px auto 0.5rem;
            overflow: hidden; 
        }

        .bb-logo-wrap img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            transform: scale(1.2); 
        }

        .bb-title {
            font-family: 'Playfair Display', serif;
            font-size: 24px;
            margin-bottom: 0.4rem;
            color: #1e1a1a;
        }

        .bb-title span { color: #c44040; }

        .bb-sub {
            font-size: 13px;
            color: #8a7878;
            margin-bottom: 1.6rem;
        }

        .bb-input-group {
            text-align: left;
            margin-bottom: 1.1rem;
        }

        .bb-input-group label {
            font-size: 12px;
            color: #6e5c5c;
            display: block;
            margin-bottom: 4px;
        }

        /* --- PASSWORD TOGGLE STYLING --- */
        .bb-pass-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .bb-input {
            width: 100%;
            padding: 12px 14px;
            padding-right: 45px; /* Space for the icon */
            border-radius: 10px;
            border: 1px solid #f0dcd8;
            font-size: 14px;
            transition: 0.2s;
        }

        .bb-input:focus {
            outline: none;
            border-color: #c44040;
            box-shadow: 0 0 0 3px rgba(196, 64, 64, 0.05);
        }

        .bb-toggle-pass {
            position: absolute;
            right: 14px;
            background: none;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #8a7878;
            transition: 0.2s;
        }

        .bb-toggle-pass:hover { color: #c44040; }

        .bb-toggle-pass svg { width: 20px; height: 20px; }
        /* ------------------------------- */

        .bb-btn {
            width: 100%;
            margin-top: 0.6rem;
            background: #c44040;
            color: #fff;
            border: none;
            padding: 13px;
            border-radius: 100px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
        }

        .bb-btn:hover { background: #b53636; transform: translateY(-1px); }

        .bb-footer {
            margin-top: 1.2rem;
            font-size: 12px;
            color: #8a7878;
        }

        .bb-footer a {
            color: #c44040;
            text-decoration: none;
            font-weight: 600;
        }

        .bb-error {
            color: #c44040;
            font-size: 11px;
            margin-top: 4px;
        }
    </style>
</head>
<body>

<div class="bb-blob-1"></div>
<div class="bb-blob-2"></div>

<div class="bb-register-container">

    <div class="bb-logo-wrap">
        <x-logo />
    </div>

    <h1 class="bb-title">Create <span>Account</span></h1>
    <p class="bb-sub">Join the system and start saving lives.</p>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="bb-input-group">
            <label>Full Name</label>
            <input type="text" name="name" class="bb-input" required value="{{ old('name') }}" placeholder="John Doe">
            @error('name')
                <div class="bb-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="bb-input-group">
            <label>Email Address</label>
            <input type="email" name="email" class="bb-input" required value="{{ old('email') }}" placeholder="john@example.com">
            @error('email')
                <div class="bb-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="bb-input-group">
            <label>Password</label>
            <div class="bb-pass-wrapper">
                <input type="password" name="password" id="password" class="bb-input" required>
                <button type="button" class="bb-toggle-pass" onclick="togglePassword('password', this)">
                    <!-- Eye Icon (Open) -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                </button>
            </div>
            @error('password')
                <div class="bb-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="bb-input-group">
            <label>Confirm Password</label>
            <div class="bb-pass-wrapper">
                <input type="password" name="password_confirmation" id="password_confirmation" class="bb-input" required>
                <button type="button" class="bb-toggle-pass" onclick="togglePassword('password_confirmation', this)">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                </button>
            </div>
        </div>

        <button type="submit" class="bb-btn">Register Account</button>

        <div class="bb-footer">
            Already have an account?
            <a href="{{ route('login') }}">Login Here</a>
        </div>
    </form>
</div>

<script>
    function togglePassword(inputId, button) {
        const input = document.getElementById(inputId);
        const icon = button.querySelector('svg');
        
        if (input.type === 'password') {
            input.type = 'text';
            // Change to Eye-Slash Icon
            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />';
        } else {
            input.type = 'password';
            // Change back to Eye Icon
            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />';
        }
    }
</script>

</body>
</html>