<x-layout>
<div style="padding:40px; font-family: 'DM Sans', sans-serif; background-color: #f8fafc; min-height: 100vh;">
    
    <div style="margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center;">
        <div>
            <h1 style="font-size:28px; font-weight:700; color: #1e293b;">System Reports</h1>
            <p style="color:#64748b;">Full historical logs of all donations and blood requests.</p>
        </div>
        <a href="{{ route('admin.dashboard') }}" style="text-decoration: none; color: #64748b; font-weight: 600; font-size: 14px; padding: 8px 16px; border: 1px solid #e2e8f0; border-radius: 8px; background: white;">
            ← Back to Dashboard
        </a>
    </div>

    <div style="margin-bottom: 40px;">
        <h3 style="margin-bottom: 15px; color: #1e293b; font-size: 18px;">Recent Donations</h3>
        <div style="background:#fff; border-radius:12px; box-shadow:0 4px 6px rgba(0,0,0,0.05); overflow:hidden; border: 1px solid #e2e8f0;">
            <table style="width:100%; border-collapse: collapse;">
                <thead style="background:#f8fafc;">
                    <tr>
                        <th style="padding:15px; text-align:left; font-size: 12px; color: #64748b; text-transform: uppercase;">Donor</th>
                        <th style="padding:15px; text-align:left; font-size: 12px; color: #64748b; text-transform: uppercase;">Type</th>
                        <th style="padding:15px; text-align:left; font-size: 12px; color: #64748b; text-transform: uppercase;">Volume</th>
                        <th style="padding:15px; text-align:left; font-size: 12px; color: #64748b; text-transform: uppercase;">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($donations as $donation)
                    <tr style="border-bottom: 1px solid #f1f5f9;">
                        <td style="padding:15px; font-weight: 600; color: #1e293b;">{{ $donation->user->name ?? 'Deleted User' }}</td>
                        <td style="padding:15px;"><span style="color: #ef4444; font-weight: 800;">{{ $donation->blood_type }}</span></td>
                        <td style="padding:15px; color: #475569;">{{ number_format($donation->units) }} ml</td>
                        <td style="padding:15px; color: #94a3b8; font-size: 13px;">{{ $donation->created_at->format('M d, Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div>
        <h3 style="margin-bottom: 15px; color: #1e293b; font-size: 18px;">Request History</h3>
        <div style="background:#fff; border-radius:12px; box-shadow:0 4px 6px rgba(0,0,0,0.05); overflow:hidden; border: 1px solid #e2e8f0;">
            <table style="width:100%; border-collapse: collapse;">
                <thead style="background:#f8fafc;">
                    <tr>
                        <th style="padding:15px; text-align:left; font-size: 12px; color: #64748b; text-transform: uppercase;">Patient</th>
                        <th style="padding:15px; text-align:left; font-size: 12px; color: #64748b; text-transform: uppercase;">Type</th>
                        <th style="padding:15px; text-align:left; font-size: 12px; color: #64748b; text-transform: uppercase;">Status</th>
                        <th style="padding:15px; text-align:left; font-size: 12px; color: #64748b; text-transform: uppercase;">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($requests as $request)
                    <tr style="border-bottom: 1px solid #f1f5f9;">
                        <td style="padding:15px; font-weight: 600; color: #1e293b;">{{ $request->user->name ?? 'Deleted User' }}</td>
                        <td style="padding:15px; font-weight: 700;">{{ $request->blood_type }}</td>
                        <td style="padding:15px;">
                            <span style="font-size: 10px; font-weight: 800; text-transform: uppercase; padding: 4px 10px; border-radius: 20px;
                                {{ $request->status === 'approved' ? 'background:#dcfce7; color:#166534;' : ($request->status === 'rejected' ? 'background:#fee2e2; color:#991b1b;' : 'background:#fef9c3; color:#854d0e;') }}">
                                {{ $request->status ?? 'Pending' }}
                            </span>
                        </td>
                        <td style="padding:15px; color: #94a3b8; font-size: 13px;">{{ $request->created_at->format('M d, Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</x-layout>