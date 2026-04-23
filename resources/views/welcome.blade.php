<!DOCTYPE html>

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

</body>
</html>
