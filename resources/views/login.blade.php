<!DOCTYPE html>
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