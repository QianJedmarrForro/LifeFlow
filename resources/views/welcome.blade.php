<!DOCTYPE html>
<<<<<<< HEAD
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LifeFlow — Every Drop Counts</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        :root {
            /* Palette Colors */
            --bg-deep: #1A0D0D;      /* Far right of your palette */
            --red-rich: #A92626;     /* Middle rich red */
            --red-deep: #5D1212;     /* Dark maroon */
            --accent-soft: #E5B7B7;  /* Soft dusty rose */
            --cream: #F4F1EE;        /* Soft off-white */
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'DM Sans', sans-serif;
            background-color: var(--bg-deep);
            color: var(--cream);
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            overflow: hidden;
        }

        .hero {
            text-align: center;
            max-width: 800px;
            padding: 40px;
            z-index: 2;
        }

        /* Logo Branding */
        .logo-area {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .logo-circle {
            width: 100px;
            height: 100px;
            background: var(--red-rich);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 0 30px rgba(169, 38, 38, 0.3);
        }

        .hero h1 {
            font-size: 4.5rem;
            font-weight: 700;
            margin: 0.5rem 0;
            letter-spacing: -3px;
            color: var(--cream);
        }

        .hero h1 span {
            color: var(--red-rich);
        }

        .hero p {
            font-size: 1.2rem;
            color: var(--accent-soft);
            margin-bottom: 3rem;
            line-height: 1.8;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .get-started-btn {
            display: inline-block;
            background-color: var(--red-rich);
            color: white;
            padding: 20px 56px;
            font-size: 1.1rem;
            font-weight: 700;
            text-decoration: none;
            border-radius: 50px; /* Pill shape for modern look */
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .get-started-btn:hover {
            background-color: var(--red-deep);
            transform: scale(1.05);
            box-shadow: 0 15px 35px rgba(169, 38, 38, 0.4);
        }

        /* Soft glowing background element */
        .ambient-glow {
            position: absolute;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(169, 38, 38, 0.08) 0%, rgba(26, 13, 13, 0) 70%);
            z-index: 1;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .copyright {
            position: absolute;
            bottom: 30px;
            font-size: 0.8rem;
            color: var(--red-deep);
            letter-spacing: 1px;
        }
    </style>
</head>
<body>
    <div class="ambient-glow"></div>
    
    <div class="hero">
        <div class="logo-area">
            <div class="logo-circle">
                <svg width="50" height="50" viewBox="0 0 24 24" fill="white">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                </svg>
            </div>
        </div>

        <h1>Life<span>Flow</span></h1>
        <p>A professional, centralized Blood Bank System designed to bridge the gap between donors and patients with speed and precision.</p>
        
        <a href="{{ route('register') }}" class="get-started-btn">
            Get Started
        </a>
    </div>
=======

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>{{ config('app.name', 'Blood Bank System') }}</title>

{{-- Google Fonts --}}

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
      position: relative;
      overflow: hidden;
    }

    /* Background blobs */
    .bb-blob-1 {
      position: fixed;
      width: 480px; height: 480px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(220,90,70,0.10) 0%, transparent 68%);
      top: -120px; right: -100px;
      pointer-events: none;
    }

    .bb-blob-2 {
      position: fixed;
      width: 320px; height: 320px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(220,90,70,0.07) 0%, transparent 68%);
      bottom: -60px; left: -60px;
      pointer-events: none;
    }

    .bb-center {
      display: flex;
      flex-direction: column;
      align-items: center;
      z-index: 2;
      text-align: center;
      padding: 3rem 2.5rem;
      max-width: 480px;
    }

    /* LOGO STYLE (used by component) */
    .bb-logo-wrap {
      background: #fff;
      border: 1px solid #f0dcd8;
      border-radius: 32px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 1.8rem;
      box-shadow: 0 4px 24px rgba(200,60,60,0.10);
    }

    .bb-tag {
      font-size: 11px;
      font-weight: 500;
      letter-spacing: 0.16em;
      text-transform: uppercase;
      color: #c44040;
      background: rgba(196,64,64,0.08);
      border: 1px solid rgba(196,64,64,0.18);
      border-radius: 100px;
      padding: 5px 14px;
      margin-bottom: 1.1rem;
    }

    .bb-headline {
      font-family: 'Playfair Display', serif;
      font-size: 36px;
      font-weight: 400;
      color: #1e1a1a;
      line-height: 1.2;
      margin: 0 0 0.7rem;
      letter-spacing: -0.01em;
    }

    .bb-headline span { color: #c44040; }

    .bb-sub {
      font-size: 14px;
      color: #8a7878;
      max-width: 340px;
      line-height: 1.7;
      margin: 0 0 2rem;
    }

    .bb-cta {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: #c44040;
      color: #fff;
      font-family: 'DM Sans', sans-serif;
      font-size: 14px;
      font-weight: 500;
      padding: 13px 28px;
      border-radius: 100px;
      border: none;
      cursor: pointer;
      letter-spacing: 0.02em;
      text-decoration: none;
      box-shadow: 0 4px 16px rgba(196,64,64,0.22);
      transition: background 0.2s, transform 0.15s;
    }

    .bb-cta:hover { background: #b53636; transform: translateY(-1px); }

    .bb-stats {
      display: flex;
      gap: 2rem;
      margin-top: 2.5rem;
      border-top: 1px solid #f0dcd8;
      padding-top: 1.8rem;
    }

    .bb-stat {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 3px;
    }

    .bb-stat-num { font-size: 20px; font-weight: 500; color: #1e1a1a; }
    .bb-stat-label { font-size: 11px; color: #b09090; letter-spacing: 0.06em; }

    .bb-divider {
      width: 1px; height: 32px;
      background: #f0dcd8;
      align-self: center;
    }
  </style>

</head>
<body>

  <div class="bb-blob-1"></div>
  <div class="bb-blob-2"></div>

  <div class="bb-center">

<!-- LOGO COMPONENT -->
<x-logo size="108" />

<div class="bb-tag">Blood Bank System</div>

<h1 class="bb-headline">
  Donate blood.<br>
  <span>Save lives.</span>
</h1>

<p class="bb-sub">
  A centralized platform for fast, safe, and efficient blood donation and transfusion management.
</p>

<a href="{{ route('login') }}" class="bb-cta">
  Get Started
  <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
    <path d="M3 8h10M9 4l4 4-4 4" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>
</a>

<div class="bb-stats">
  <div class="bb-stat">
    <span class="bb-stat-num">500+</span>
    <span class="bb-stat-label">Donors</span>
  </div>
  <div class="bb-divider"></div>
  <div class="bb-stat">
    <span class="bb-stat-num">8</span>
    <span class="bb-stat-label">Blood Types</span>
  </div>
  <div class="bb-divider"></div>
  <div class="bb-stat">
    <span class="bb-stat-num">24/7</span>
    <span class="bb-stat-label">Available</span>
  </div>
</div>

  </div>
>>>>>>> 58c3432d420dc84ee163b92c146a70f92eb3db40

    <div class="copyright">© 2026 LIFEFLOW. ALL RIGHTS RESERVED.</div>
</body>
</html>
