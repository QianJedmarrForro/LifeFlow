<!DOCTYPE html>
<<<<<<< HEAD
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LifeFlow - Login</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'DM Sans', sans-serif;
            display: flex;
            height: 100vh;
            background-color: #f8f5f2;
        }

        /* Left Side: Branding */
        .brand-section {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
            text-align: center;
        }

        .logo-box {
            background-color: #a82424;
            width: 80px;
            height: 80px;
            border-radius: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
            box-shadow: 0 10px 20px rgba(168, 36, 36, 0.2);
        }

        .logo-box svg { width: 40px; fill: white; }

        .brand-name {
            font-size: 32px;
            font-weight: 700;
            color: #4a1a1a;
            margin: 0;
        }

        .brand-tagline {
            color: #666;
            max-width: 350px;
            margin-top: 15px;
            line-height: 1.6;
            font-size: 14px;
        }

        /* Right Side: Form */
        .form-section {
            width: 450px;
            background-color: #1a0f0f;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 0 60px;
            color: white;
        }

        .form-header h2 { font-size: 32px; margin-bottom: 5px; }
        .form-header p { color: #888; font-size: 12px; margin-bottom: 30px; text-transform: uppercase; letter-spacing: 1px; }

        .toggle-container {
            display: flex;
            background: #2a1a1a;
            padding: 5px;
            border-radius: 10px;
            margin-bottom: 30px;
        }

        .toggle-btn {
            flex: 1;
            padding: 10px;
            text-align: center;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            border-radius: 8px;
            transition: 0.3s;
        }

        .toggle-btn.active { background: #e6b8b8; color: #1a0f0f; }
        .toggle-btn.inactive { color: #888; }

        .input-group { margin-bottom: 15px; }
        
        .input-field {
            width: 100%;
            background: #2a1a1a;
            border: 1px solid #3d2a2a;
            border-radius: 8px;
            padding: 15px;
            color: white;
            font-family: inherit;
            box-sizing: border-box;
            outline: none;
        }

        .input-field:focus { border-color: #a82424; }

        .btn-proceed {
            width: 100%;
            background-color: #a82424;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 15px;
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
            margin-top: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: 0.3s;
        }

        .btn-proceed:hover { background-color: #cc2d2d; }

        .error-msg {
            background: rgba(255, 0, 0, 0.1);
            color: #ff6b6b;
            padding: 10px;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 20px;
            border: 1px solid rgba(255, 0, 0, 0.2);
        }
    </style>
</head>
<body>

    <div class="brand-section">
        <div class="logo-box">
            <svg viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
        </div>
        <h1 class="brand-name">LifeFlow</h1>
        <p class="brand-tagline">A professional, centralized blood bank system designed for efficiency and life-saving speed.</p>
    </div>

    <div class="form-section">
        <div class="form-header">
            <h2>Welcome Back</h2>
            <p>Secure Member Access</p>
        </div>

        <div class="toggle-container">
            <a href="{{ route('login') }}" class="toggle-btn active">Login</a>
            <a href="{{ route('register') }}" class="toggle-btn inactive">Register</a>
        </div>

        @if($errors->any())
            <div class="error-msg">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <div class="input-group">
                <input type="email" name="email" class="input-field" placeholder="Email Address" required value="{{ old('email') }}">
            </div>
            <div class="input-group">
                <input type="password" name="password" class="input-field" placeholder="Password" required>
            </div>

            <button type="submit" class="btn-proceed">Proceed</button>
        </form>

        <p style="text-align: center; font-size: 12px; color: #888; margin-top: 25px;">
            New to the system? <a href="{{ route('register') }}" style="color: #e6b8b8; text-decoration: none; font-weight: 600;">Create Account</a>
        </p>
    </div>

</body>
</html>
=======

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | {{ config('app.name', 'Blood Bank System') }}</title>

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

    .bb-logo-wrap {
        background: #fff;
        border: 1px solid #f0dcd8;
        border-radius: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.2rem;
        box-shadow: 0 4px 20px rgba(200,60,60,0.10);
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

    .bb-input {
        width: 100%;
        padding: 12px 14px;
        border-radius: 10px;
        border: 1px solid #f0dcd8;
        font-size: 14px;
    }

    .bb-input:focus {
        outline: none;
        border-color: #c44040;
    }

    .bb-btn {
        width: 100%;
        margin-top: 0.6rem;
        background: #c44040;
        color: #fff;
        border: none;
        padding: 13px;
        border-radius: 100px;
        font-size: 14px;
        cursor: pointer;
    }

    .bb-btn:hover { background: #b53636; }

    .bb-footer {
        margin-top: 1.2rem;
        font-size: 12px;
        color: #8a7878;
    }

    .bb-footer a {
        color: #c44040;
        text-decoration: none;
        font-weight: 500;
    }

    .bb-error {
        color: #c44040;
        font-size: 12px;
        margin-top: 4px;
    }
</style>

</head>
<body>

<div class="bb-blob-1"></div>
<div class="bb-blob-2"></div>

<div class="bb-login-container">

<!-- LOGO COMPONENT -->
<x-logo size="90" class="mb-2" />

<h1 class="bb-title">Welcome <span>Back</span></h1>
<p class="bb-sub">Login to continue managing blood donations.</p>

<form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="bb-input-group">
        <label>Email</label>
        <input type="email" name="email" class="bb-input" required>
        @error('email')
            <div class="bb-error">{{ $message }}</div>
        @enderror
    </div>

    <div class="bb-input-group">
        <label>Password</label>
        <input type="password" name="password" class="bb-input" required>
        @error('password')
            <div class="bb-error">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="bb-btn">Login</button>

    <div class="bb-footer">
        Don’t have an account?
        <a href="{{ route('register') }}">Register</a>
    </div>

</form>

</div>

</body>
</html>
>>>>>>> 58c3432d420dc84ee163b92c146a70f92eb3db40
