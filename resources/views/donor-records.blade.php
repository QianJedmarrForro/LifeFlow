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
            font-family: 'Georgia', serif;
            font-size: 36px;
            color: #1e293b;
            margin: 0;
        }

        .lf-card {
            background: white;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            border: 1px solid #e2e8f0;
        }

        .lf-table {
            width: 100%;
            border-collapse: collapse;
        }

        .lf-table th {
            text-align: left;
            font-size: 11px;
            color: #1e40af;
            padding: 12px;
            border-bottom: 2px solid #f1f5f9;
            text-transform: uppercase;
        }

        .lf-table td {
            padding: 14px 12px;
            font-size: 13px;
            color: #334155;
            border-bottom: 1px solid #f1f5f9;
        }

        .blood-badge {
            background: #fee2e2;
            color: #ef4444;
            padding: 3px 8px;
            border-radius: 4px;
            font-weight: 700;
            font-size: 12px;
        }

        .status-tag {
            font-size: 10px;
            font-weight: 800;
            padding: 3px 6px;
            border-radius: 4px;
            text-transform: uppercase;
        }
    </style>

    <div class="page-main-container">

        <div class="lf-page-header">
            <h1 class="lf-page-title">Management Records</h1>
            <div style="font-weight: 600; color: #64748b;">
                {{ now()->format('F d, Y') }} 🔔
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 25px;">

            <!-- DONORS -->
            <div class="lf-card">
                <div style="display:flex; justify-content:space-between; margin-bottom:20px;">
                    <h2 style="margin:0; font-size:18px;">Donor Information</h2>
                    <span style="font-size:11px; background:#eff6ff; color:#1e40af; padding:4px 8px; border-radius:20px;">
                        Total: {{ $donors->count() ?? 0 }}
                    </span>
                </div>

                <table class="lf-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Contact</th>
                            <th>Date Joined</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($donors ?? [] as $donor)
                            <tr>
                                <td style="font-weight:600;">{{ $donor->name }}</td>
                                <td><span class="blood-badge">{{ $donor->blood_type }}</span></td>
                                <td>{{ $donor->email }}</td>
                                <td>
                                    {{ optional($donor->created_at)->format('M d, Y') ?? 'N/A' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" style="text-align:center; padding:40px;">
                                    No donors found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- REQUESTS -->
            <div class="lf-card">
                <div style="display:flex; justify-content:space-between; margin-bottom:20px;">
                    <h2 style="margin:0; font-size:18px;">Active Requests</h2>
                    <span style="font-size:11px; background:#fff1f2; color:#be123c; padding:4px 8px; border-radius:20px;">
                        Total: {{ $requests->count() ?? 0 }}
                    </span>
                </div>

                <table class="lf-table">
                    <thead>
                        <tr>
                            <th>Hospital</th>
                            <th>Type</th>
                            <th>Units</th>
                            <th>Priority</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($requests ?? [] as $req)
                            <tr>
                                <td style="font-weight:600;">{{ $req->hospital }}</td>
                                <td><span class="blood-badge">{{ $req->blood_type }}</span></td>
                                <td>{{ $req->units }}</td>
                                <td>
                                    @php
                                        $pColor = match($req->priority) {
                                            'Emergency' => ['bg' => '#fee2e2', 'text' => '#991b1b'],
                                            'Urgent' => ['bg' => '#fef3c7', 'text' => '#92400e'],
                                            default => ['bg' => '#dbeafe', 'text' => '#1e40af'],
                                        };
                                    @endphp

                                    <span class="status-tag"
                                          style="background:{{ $pColor['bg'] }}; color:{{ $pColor['text'] }};">
                                        {{ $req->priority }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" style="text-align:center; padding:40px;">
                                    No requests found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-layout>