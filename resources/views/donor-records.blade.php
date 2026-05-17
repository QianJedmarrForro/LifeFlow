<x-layout>
    <style>
        .page-main-container {
            font-family: 'DM Sans', sans-serif;
            padding: 40px;
            background-color: #f8fafc;
            min-height: 100vh;
        }

        .lf-page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .lf-page-title {
            font-family: 'DM Sans', sans-serif;
            font-size: 28px;
            font-weight: 800;
            color: #0f172a;
            margin: 0;
            line-height: 1.2;
            letter-spacing: -0.03em;
        }

        .lf-card {
            background: white;
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.03);
            border: 1px solid #eef2f6;
        }

        .lf-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .lf-table th {
            text-align: left;
            font-size: 11px;
            color: #64748b;
            padding: 12px;
            border-bottom: 1px solid #f1f5f9;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .lf-table td {
            padding: 16px 12px;
            font-size: 13.5px;
            color: #334155;
            border-bottom: 1px solid #f8fafc;
        }

        .blood-badge {
            background: #fff1f2;
            color: #e11d48;
            padding: 4px 10px;
            border-radius: 6px;
            font-weight: 700;
            font-size: 12px;
        }
    </style>

    <div class="page-main-container">
        <div class="lf-page-header">
            <div>
                <h1 class="lf-page-title">{{ $heading ?? 'Donor Directory' }}</h1>
                <p style="font-family: 'DM Sans', sans-serif; color: #64748b; font-size: 14px; margin-top: 6px; font-weight: 400; letter-spacing: -0.01em; line-height: 1.6;">{{ $description ?? 'Manage and view all registered blood donors.' }}</p>
            </div>
            <div style="font-family: 'DM Sans', sans-serif; font-weight: 600; color: #64748b; background: white; padding: 10px 20px; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.02);">
                {{ now()->format('F d, Y') }} 
            </div>
        </div>

        <div class="lf-card">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
                <h2 style="margin:0; font-family: 'DM Sans', sans-serif; font-size:18px; color: #1e293b; font-weight: 700;">Registered Donors</h2>
                <span style="font-family: 'DM Sans', sans-serif; font-size:11px; background:#f0f9ff; color:#0369a1; padding:5px 12px; border-radius:20px; font-weight: 600;">
                    TOTAL: {{ count($donors) }}
                </span>
            </div>

            <div style="overflow-x: auto;">
                <table class="lf-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Blood Type</th>
                            <th>Email Address</th>
                            <th>Date Joined</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($donors as $donor)
                            <tr>
                                <td style="font-family: 'DM Sans', sans-serif; font-weight:600; color: #1e293b;">{{ $donor->name }}</td>
                                <td><span class="blood-badge">{{ $donor->blood_type ?? 'N/A' }}</span></td>
                                <td style="font-family: 'DM Sans', sans-serif; color: #64748b;">{{ $donor->email }}</td>
                                <td style="font-family: 'DM Sans', sans-serif; font-size: 12px; color: #64748b;">
                                    {{ $donor->created_at->format('M d, Y') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" style="text-align:center; padding:50px; color: #94a3b8; font-family: 'DM Sans', sans-serif;">
                                    <div style="font-size: 24px; margin-bottom: 10px;">📭</div>
                                    No registered donors found in the database.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout>