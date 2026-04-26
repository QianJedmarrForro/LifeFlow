<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LifeFlow — Every Drop Counts</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-deep: #1A0D0D;
            --red-rich: #A92626;
            --red-deep: #5D1212;
            --accent-soft: #E5B7B7;
            --cream: #F4F1EE;
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
            min-height: 100vh;
            overflow-x: hidden;
        }

        .hero {
            text-align: center;
            max-width: 800px;
            padding: 40px;
            z-index: 2;
        }

        /* Container for your logo component */
        .logo-container {
            width: 120px;
            height: 120px;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white; /* Optional: gives a clean white base for the logo circle */
            border-radius: 50%;
            overflow: hidden; /* This forces the logo into a circle shape */
            box-shadow: 0 0 30px rgba(169, 38, 38, 0.4);
            border: 4px solid var(--red-rich);
        }

        /* Target the image inside the component */
        .logo-container img {
            width: 100%;
            height: 100%;
            object-fit: cover; 
        }

        .hero h1 {
            font-size: 4.5rem;
            font-weight: 700;
            margin: 0.5rem 0;
            letter-spacing: -3px;
        }

        .hero h1 span { color: var(--red-rich); }

        .hero p {
            font-size: 1.2rem;
            color: var(--accent-soft);
            margin-bottom: 2rem;
            line-height: 1.8;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .get-started-btn {
            display: inline-block;
            background-color: var(--red-rich);
            color: white;
            padding: 18px 48px;
            font-size: 1.1rem;
            font-weight: 700;
            text-decoration: none;
            border-radius: 50px;
            transition: all 0.4s ease;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            text-transform: uppercase;
        }

        .get-started-btn:hover {
            background-color: var(--red-deep);
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(169, 38, 38, 0.4);
        }

        .bb-stats {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-top: 3rem;
            border-top: 1px solid rgba(229, 183, 183, 0.2);
            padding-top: 2rem;
        }

        .bb-stat {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .bb-stat-num { font-size: 24px; font-weight: 700; color: var(--cream); }
        .bb-stat-label { font-size: 12px; color: var(--accent-soft); text-transform: uppercase; letter-spacing: 1px; }

        .bb-divider { width: 1px; height: 40px; background: rgba(229, 183, 183, 0.2); }

        .ambient-glow {
            position: absolute;
            width: 600px; height: 600px;
            background: radial-gradient(circle, rgba(169, 38, 38, 0.1) 0%, rgba(26, 13, 13, 0) 70%);
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1;
        }

        .copyright {
            position: absolute;
            bottom: 20px;
            font-size: 0.7rem;
            color: var(--red-deep);
            letter-spacing: 2px;
        }
    </style>
</head>
<body>
    <div class="ambient-glow"></div>
    
    <div class="hero">
        <div class="logo-container">
            <x-logo />
        </div>

        <h1>Life<span>Flow</span></h1>
        <p>A professional, centralized Blood Bank System designed to bridge the gap between donors and patients with speed and precision.</p>
        
        <a href="{{ route('register') }}" class="get-started-btn">Get Started</a>

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

    <div class="copyright">© 2026 LIFEFLOW. ALL RIGHTS RESERVED.</div>
</body>
</html>