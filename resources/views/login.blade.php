<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | {{ config('app.name', 'Blood Bank System') }}</title>

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=Playfair+Display:wght@400;500&display=swap" rel="stylesheet"/>
    
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

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

        .bb-login-container {
            background: #fff;
            border: 1px solid #f0dcd8;
            border-radius: 24px;
            padding: 2.5rem;
            width: 100%;
            max-width: 380px;
            box-shadow: 0 8px 30px rgba(200,60,60,0.12);
            z-index: 2;
            text-align: center;
        }

        .bb-logo-wrapper {
            width: 120px;
            height: 120px;
            margin: -25px auto 5px auto;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        .bb-logo-wrapper img {
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
            position: relative; /* Added for icon positioning */
        }

        .bb-input-group label {
            font-size: 12px;
            color: #6e5c5c;
            display: block;
            margin-bottom: 4px;
        }

        .bb-input {
            width: 100%;
            padding: 12px 14px;
            border-radius: 10px;
            border: 1px solid #f0dcd8;
            font-size: 14px;
            transition: 0.2s;
        }

        /* Prevent text overlapping with the eye icon */
        .bb-input-password {
            padding-right: 42px;
        }

        .bb-input:focus {
            outline: none;
            border-color: #c44040;
            box-shadow: 0 0 0 3px rgba(196, 64, 64, 0.1);
        }

        /* Toggle Button Styles */
        .bb-toggle-btn {
            position: absolute;
            right: 12px;
            bottom: 10px;
            background: none;
            border: none;
            cursor: pointer;
            color: #8a7878;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 4px;
            transition: color 0.2s;
        }

        .bb-toggle-btn:hover { color: #c44040; }

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

        .bb-btn:hover { 
            background: #b53636;
            transform: translateY(-1px);
        }

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
            font-size: 12px;
            margin-top: 4px;
        }

        [x-cloak] { display: none !important; }
    </style>
</head>
<body>

    <div class="bb-blob-1"></div>
    <div class="bb-blob-2"></div>

    <div class="bb-login-container">

        <div class="bb-logo-wrapper">
            <x-logo />
        </div>

        <h1 class="bb-title">Welcome <span>Back</span></h1>
        <p class="bb-sub">Login to continue managing blood donations.</p>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="bb-input-group">
                <label>Email Address</label>
                <input type="email" name="email" class="bb-input" required value="{{ old('email') }}" placeholder="Enter your email">
                @error('email')
                    <div class="bb-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="bb-input-group" x-data="{ show: false }">
                <label>Password</label>
                <input :type="show ? 'text' : 'password'" 
                       name="password" 
                       class="bb-input bb-input-password" 
                       required 
                       placeholder="Enter your password">
                
                <button type="button" class="bb-toggle-btn" @click="show = !show" tabindex="-1">
                    <svg x-show="!show" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                    <svg x-show="show" x-cloak width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19m-6.72-1.07a3 3 0 11-4.24-4.24"></path>
                        <line x1="1" y1="1" x2="23" y2="23"></line>
                    </svg>
                </button>

                @error('password')
                    <div class="bb-error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="bb-btn">Login to Account</button>

            <div class="bb-footer">
                Don’t have an account?
                <a href="{{ route('register') }}">Register Here</a>
            </div>
        </form>

    </div>

</body>
</html>