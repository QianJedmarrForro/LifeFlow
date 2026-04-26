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
            font-family: 'Playfair Display', serif; /* Consistent sa imong branding */
            font-size: 32px;
            color: #1e293b;
            margin: 0;
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

        .status-tag {
            font-size: 10px;
            font-weight: 700;
            padding: 4px 8px;
            border-radius: 100px;
            text-transform: uppercase;
        }
    </style>

    <div class="page-main-container">

        <div class="lf-page-header">
            <div>
                <h1 class="lf-page-title">Management Records</h1>
                <p style="color: #64748b; font-size: 14px; margin-top: 5px;">Monitor donor activity and hospital requirements.</p>
            </div>
            <div style="font-weight: 600; color: #64748b; background: white; padding: 10px 20px; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.02);">
                {{ now()->format('F d, Y') }} 📅
            </div>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(450px, 1fr)); gap: 25px;">

            <div class="lf-card">
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
                    <h2 style="margin:0; font-size:18px; color: #1e293b;">Donor Directory</h2>
                    <span style="font-size:11px; background:#f0f9ff; color:#0369a1; padding:5px 12px; border-radius:20px; font-weight: 600;">
                        TOTAL: {{ isset($donors) ? $donors->count() : 0 }}
                    </span>
                </div>

                <div style="overflow-x: auto;">
                    <table class="lf-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Blood Type</th>
                                <th>Contact Email</th>
                                <th>Date Joined</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($donors ?? [] as $donor)
                                <tr>
                                    <td style="font-weight:600; color: #1e293b;">{{ $donor->name }}</td>
                                    <td><span class="blood-badge">{{ $donor->blood_type ?? 'N/A' }}</span></td>
                                    <td style="color: #64748b;">{{ $donor->email }}</td>
                                    <td style="font-size: 12px;">
                                        {{ $donor->created_at ? $donor->created_at->format('M d, Y') : '---' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" style="text-align:center; padding:50px; color: #94a3b8;">
                                        <div style="font-size: 24px; margin-bottom: 10px;">Empty</div>
                                        No registered donors found in the database.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="lf-card">
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
                    <h2 style="margin:0; font-size:18px; color: #1e293b;">Inventory Requests</h2>
                    <span style="font-size:11px; background:#fff1f2; color:#be123c; padding:5px 12px; border-radius:20px; font-weight: 600;">
                        PENDING: {{ isset($requests) ? $requests->count() : 0 }}
                    </span>
                </div>

                <div style="overflow-x: auto;">
                    <table class="lf-table">
                        <thead>
                            <tr>
                                <th>Hospital</th>
                                <th>Type</th>
                                <th>Qty</th>
                                <th>Priority</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($requests ?? [] as $req)
                                <tr>
                                    <td style="font-weight:600; color: #1e293b;">{{ $req->hospital }}</td>
                                    <td><span class="blood-badge" style="background:#f1f5f9; color:#475569;">{{ $req->blood_type }}</span></td>
                                    <td style="font-weight: 700;">{{ $req->units }} u</td>
                                    <td>
                                        @php
                                            $pStyle = match($req->priority) {
                                                'Emergency' => 'background:#fee2e2; color:#991b1b;',
                                                'Urgent'    => 'background:#fef3c7; color:#92400e;',
                                                default     => 'background:#dbeafe; color:#1e40af;'
                                            };
                                        @endphp
                                        <span class="status-tag" style="{{ $pStyle }}">
                                            {{ $req->priority }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" style="text-align:center; padding:50px; color: #94a3b8;">
                                        <div style="font-size: 24px; margin-bottom: 10px;">All Clear</div>
                                        There are no active blood requests at the moment.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-layout>