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

<div class="bb-register-container">


<!-- LOGO -->
<x-logo size="90" />

<h1 class="bb-title">Create <span>Account</span></h1>
<p class="bb-sub">Join the system and start saving lives.</p>

<form method="POST" action="{{ route('register') }}">
    @csrf

    <div class="bb-input-group">
        <label>Name</label>
        <input type="text" name="name" class="bb-input" required>
        @error('name')
            <div class="bb-error">{{ $message }}</div>
        @enderror
    </div>

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

    <div class="bb-input-group">
        <label>Confirm Password</label>
        <input type="password" name="password_confirmation" class="bb-input" required>
    </div>

    <button type="submit" class="bb-btn">Register</button>

    <div class="bb-footer">
        Already have an account?
        <a href="{{ route('login') }}">Login</a>
    </div>

</form>


</div>

</body>
</html>
