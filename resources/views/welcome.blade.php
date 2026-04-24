<!DOCTYPE html>
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

    <div class="copyright">© 2026 LIFEFLOW. ALL RIGHTS RESERVED.</div>
</body>
</html>