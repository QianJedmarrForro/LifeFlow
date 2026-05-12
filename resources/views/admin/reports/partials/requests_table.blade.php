<table style="width:100%; border-collapse: collapse;">
    <thead style="background:#f8fafc;">
        <tr>
            <th style="padding:15px; text-align:left; font-size: 12px; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em;">Patient</th>
            <th style="padding:15px; text-align:left; font-size: 12px; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em;">Type</th>
            <th style="padding:15px; text-align:left; font-size: 12px; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em;">Status</th>
            <th style="padding:15px; text-align:left; font-size: 12px; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em;">Date</th>
        </tr>
    </thead>
    <tbody>
        @forelse($requests as $request)
        <tr style="border-bottom: 1px solid #f1f5f9;">
            <td style="padding:15px; font-weight: 600; color: #1e293b;">{{ $request->user->name ?? 'Unknown Patient' }}</td>
            <td style="padding:15px; font-weight: 700;">{{ $request->blood_type }}</td>
            <td style="padding:15px;">
                <span style="font-size: 10px; font-weight: 800; text-transform: uppercase; padding: 4px 10px; border-radius: 20px;
                    {{ $request->status === 'approved' ? 'background:#dcfce7; color:#166534;' : ($request->status === 'rejected' ? 'background:#fee2e2; color:#991b1b;' : 'background:#fef9c3; color:#854d0e;') }}">
                    {{ $request->status ?? 'pending' }}
                </span>
            </td>
            <td style="padding:15px; color: #94a3b8; font-size: 13px;">{{ $request->created_at->format('M d, Y') }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="4" style="padding: 30px; text-align: center; color: #94a3b8;">No requests found.</td>
        </tr>
        @endforelse
    </tbody>
</table>