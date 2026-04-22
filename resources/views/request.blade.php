<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Blood</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #1a1a2e;
            color: #fff;
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 180px;
            background-color: #111;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px 10px;
            gap: 10px;
            min-height: 100vh;
        }

        .logo {
            width: 80px;
            margin-bottom: 10px;
        }

        .search-bar {
            display: flex;
            align-items: center;
            background: #222;
            border-radius: 20px;
            padding: 5px 10px;
            width: 100%;
            margin-bottom: 10px;
        }

        .search-bar input {
            background: transparent;
            border: none;
            outline: none;
            color: #ccc;
            font-size: 13px;
            width: 100%;
        }

        .nav-btn {
            width: 100%;
            padding: 10px;
            border-radius: 20px;
            border: none;
            background: #2a2a2a;
            color: #ccc;
            font-size: 13px;
            width: 100%;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            display: block;
        }

        .nav-btn.active {
            background: #e53935;
            color: #fff;
        }

        .nav-btn:hover {
            background: #444;
        }

        .logout-btn {
            margin-top: auto;
            width: 100%;
            padding: 10px;
            border-radius: 20px;
            border: none;
            background: #2a2a2a;
            color: #ccc;
            font-size: 13px;
            cursor: pointer;
        }

        /* Main Content */
        .main {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .content {
            flex: 1;
            background: #f87171;
            padding: 30px;
            border-radius: 20px;
            margin: 15px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .header h1 {
            font-size: 36px;
            font-weight: bold;
            color: #111;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 15px;
            color: #111;
            font-size: 14px;
        }

        .columns {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-card {
            background: #fff;
            border-radius: 15px;
            padding: 25px;
        }

        .form-card h2 {
            font-size: 18px;
            font-weight: bold;
            color: #111;
            margin-bottom: 20px;
            border-bottom: 2px solid #111;
            padding-bottom: 5px;
            display: inline-block;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            color: #333;
            margin-bottom: 5px;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px 14px;
            border-radius: 10px;
            border: none;
            background: #e0e0e0;
            font-size: 13px;
            color: #333;
            outline: none;
        }

        .form-group textarea {
            height: 80px;
            resize: none;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .submit-btn {
            width: 100%;
            padding: 12px;
            background: #e53935;
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 10px;
        }

        .submit-btn:hover {
            background: #c62828;
        }

        .pending-card {
            background: #fff;
            border-radius: 15px;
            padding: 25px;
        }

        .pending-card h2 {
            font-size: 18px;
            font-weight: bold;
            color: #111;
            margin-bottom: 20px;
            border-bottom: 2px solid #111;
            padding-bottom: 5px;
            display: inline-block;
        }

        .pending-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        .pending-table th {
            text-align: center;
            padding: 8px 5px;
            color: #555;
            font-weight: 600;
            border-bottom: 1px solid #eee;
        }

        .pending-table td {
            text-align: center;
            padding: 10px 5px;
            border-bottom: 1px solid #f0f0f0;
            color: #333;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            border-radius: 8px;
            padding: 10px 15px;
            margin-bottom: 15px;
            font-size: 13px;
        }

        footer {
            background: #e53935;
            text-align: center;
            padding: 12px;
            font-size: 13px;
            color: #fff;
        }
    </style>
</head>
<body>

    <aside class="sidebar">
        <img src="{{ asset('images/logo.png') }}" alt="LifeFlow Logo" class="logo">

        <div class="search-bar">
            <input type="text" placeholder="Search...">
            <span>&#128269;</span>
        </div>

        <a href="{{ url('/home') }}" class="nav-btn">Home</a>
        <a href="{{ url('/donate') }}" class="nav-btn">Donate Blood</a>
        <a href="{{ route('request.index') }}" class="nav-btn active">Request Blood</a>
        <a href="{{ route('donor.records') }}" class="nav-btn">Donor Records</a>
        <a href="{{ route('about') }}" class="nav-btn">About Us</a>
        <a href="{{ route('contact') }}" class="nav-btn">Contact Us</a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </aside>

    <div class="main">
        <div class="content">

            <div class="header">
                <h1>Request Blood</h1>
                <div class="header-right">
                    <span>{{ now()->format('F d, Y') }}</span>
                    <span>&#128276;</span>
                </div>
            </div>

            @if(session('success'))
                <div class="alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="columns">
                <div class="form-card">
                    <h2>Blood Request Form</h2>
                    <form action="{{ route('request.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Patient Name</label>
                            <input type="text" name="patient_name" placeholder="Enter patient's full name" required>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label>Blood Type Required</label>
                                <select name="blood_type" required>
                                    <option value="" disabled selected>Select Type</option>
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Units Needed (ml)</label>
                                <input type="number" name="units" placeholder="e.g. 500" min="1" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Hospital Name/Address</label>
                            <input type="text" name="hospital" placeholder="Name of hospital" required>
                        </div>

                        <div class="form-group">
                            <label>Reason for Request</label>
                            <textarea name="reason" placeholder="State the medical emergency..." required></textarea>
                        </div>

                        <button type="submit" class="submit-btn">SUBMIT REQUEST</button>
                    </form>
                </div>

                <div class="pending-card">
                    <h2>Recent Requests</h2>
                    <table class="pending-table">
                        <thead>
                            <tr>
                                <th>Patient Name</th>
                                <th>Blood Type</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Juan Dela Cruz</td>
                                <td>O+</td>
                                <td style="color: #f59e0b; font-weight: bold;">Pending</td>
                            </tr>
                            <tr>
                                <td>Maria Clara</td>
                                <td>AB-</td>
                                <td style="color: #e53935; font-weight: bold;">Emergency</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <footer>
            &copy; 2026 LifeFlow. All Rights Reserved.
        </footer>
    </div>

</body>
</html>