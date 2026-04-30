<x-layout>
<div style="padding:40px; font-family: 'DM Sans', sans-serif; background-color: #f8fafc; min-height: 100vh;">
    
    <div style="margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center;">
        <div>
            <h1 style="font-size:28px; font-weight:700; color: #1e293b;">User Management</h1>
            <p style="color:#64748b;">A complete list of all registered donors and staff members.</p>
        </div>
        <a href="{{ route('admin.dashboard') }}" style="text-decoration: none; color: #64748b; font-weight: 600; font-size: 14px;">
            ← Back to Dashboard
        </a>
    </div>

    <div style="background:#fff; border-radius:16px; box-shadow:0 4px 6px rgba(0,0,0,0.05); overflow:hidden; border: 1px solid #e2e8f0;">
        <table style="width:100%; border-collapse: collapse;">
            <thead>
                <tr style="background:#f8fafc; border-bottom: 1px solid #e2e8f0;">
                    <th style="padding:18px; text-align:left; font-size: 12px; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px;">Name</th>
                    <th style="padding:18px; text-align:left; font-size: 12px; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px;">Email</th>
                    <th style="padding:18px; text-align:left; font-size: 12px; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px;">Role</th>
                    <th style="padding:18px; text-align:left; font-size: 12px; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px;">Joined Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr style="border-bottom: 1px solid #f1f5f9; transition: background 0.2s;" onmouseover="this.style.backgroundColor='#fcfdfe'" onmouseout="this.style.backgroundColor='transparent'">
                    <td style="padding:18px;">
                        <div style="font-weight: 600; color: #1e293b;">{{ $user->name }}</div>
                    </td>
                    <td style="padding:18px; color: #64748b; font-size: 14px;">
                        {{ $user->email }}
                    </td>
                    <td style="padding:18px;">
                        <span style="font-size: 10px; font-weight: 800; text-transform: uppercase; padding: 5px 12px; border-radius: 20px;
                            {{ $user->role === 'admin' ? 'background:#dbeafe; color:#1e40af;' : 'background:#f1f5f9; color:#475569;' }}">
                            {{ $user->role ?? 'User' }}
                        </span>
                    </td>
                    <td style="padding:18px; color: #94a3b8; font-size: 14px;">
                        {{ $user->created_at->format('M d, Y') }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</x-layout>