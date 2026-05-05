<x-layout>
    <div style="max-width: 1200px; margin: 0 auto; font-family: 'DM Sans', sans-serif;">
        
        {{-- SUCCESS NOTIFICATION --}}
        @if(session('success'))
            <div style="background-color: #ecfdf5; border-left: 5px solid #10b981; padding: 16px; margin-bottom: 25px; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); display: flex; align-items: center; animation: slideDown 0.5s ease-out;">
                <div style="background-color: #10b981; color: white; width: 28px; height: 28px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 15px; font-weight: bold; flex-shrink: 0;">
                    ✓
                </div>
                <div>
                    <p style="color: #065f46; font-weight: 800; margin: 0; font-size: 14px;">Donate Success!</p>
                    <p style="color: #047857; margin: 0; font-size: 13px;">{{ session('success') }}</p>
                </div>
            </div>

            <style>
                @keyframes slideDown {
                    from { opacity: 0; transform: translateY(-10px); }
                    to { opacity: 1; transform: translateY(0); }
                }
            </style>
        @endif

        <div style="margin-bottom: 40px; display: flex; justify-content: space-between; align-items: flex-end;">
            <div>
                <h1 style="font-size: 32px; font-weight: 800; color: #1a1a1a; margin: 0;">Welcome back, {{ auth()->user()->name }} 👋</h1>
                <p style="color: #64748b; margin-top: 8px;">Your donor activity and health overview at a glance.</p>
            </div>
            <div style="text-align: right;">
                <span style="display: block; font-size: 12px; color: #94a3b8; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;">Current Status</span>
                <span style="color: #22c55e; font-weight: 700;">● Active Donor</span>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 24px; margin-bottom: 40px;">
            <div style="background: white; padding: 24px; border-radius: 20px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
                <div style="color: #64748b; font-size: 14px; font-weight: 600; margin-bottom: 10px;">Total Donations</div>
                <div style="font-size: 36px; font-weight: 800; color: #1a1a1a;">{{ $totalDonations }}</div>
                <div style="margin-top: 10px; font-size: 12px; color: #10b981;">+1 this month</div>
            </div>

            <div style="background: white; padding: 24px; border-radius: 20px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
                <div style="color: #64748b; font-size: 14px; font-weight: 600; margin-bottom: 10px;">Volume Contributed</div>
                <div style="font-size: 36px; font-weight: 800; color: #C0392B;">{{ $totalUnits }}<span style="font-size: 16px; color: #94a3b8; margin-left: 5px;">ml</span></div>
                <div style="margin-top: 10px; font-size: 12px; color: #94a3b8;">{{ $totalUnits / 450 >= 1 ? floor($totalUnits / 450) . ' Lives Saved' : 'First donation goal' }}</div>
            </div>

            <div style="background: white; padding: 24px; border-radius: 20px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
                <div style="color: #64748b; font-size: 14px; font-weight: 600; margin-bottom: 10px;">Active Requests</div>
                <div style="font-size: 36px; font-weight: 800; color: #1a1a1a;">{{ $totalRequests }}</div>
                <div style="margin-top: 10px; font-size: 12px; color: #f59e0b;">Waiting for approval</div>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 32px;">
            
            <div>
                <div style="background: white; border-radius: 24px; border: 1px solid #e2e8f0; overflow: hidden; margin-bottom: 32px;">
                    <div style="padding: 24px; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center;">
                        <h3 style="font-weight: 800; font-size: 18px;">Recent Donations</h3>
                        <a href="{{ route('donations.create') }}" style="color: #C0392B; font-size: 13px; font-weight: 700; text-decoration: none;">+ Add New</a>
                    </div>
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead style="background: #f8fafc; font-size: 11px; text-transform: uppercase; color: #64748b;">
                            <tr>
                                <th style="text-align: left; padding: 12px 24px;">Date</th>
                                <th style="text-align: left; padding: 12px 24px;">Type</th>
                                <th style="text-align: left; padding: 12px 24px;">Volume</th>
                                <th style="text-align: left; padding: 12px 24px;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($donationHistory as $donation)
                            <tr>
                                <td style="padding: 16px 24px; font-size: 14px; font-weight: 600;">{{ $donation->created_at->format('M d, Y') }}</td>
                                <td style="padding: 16px 24px;"><span style="background: #fee2e2; color: #C0392B; padding: 4px 8px; border-radius: 6px; font-weight: 800; font-size: 12px;">{{ $donation->blood_type }}</span></td>
                                <td style="padding: 16px 24px; font-size: 14px; color: #64748b;">{{ $donation->units }}ml</td>
                                <td style="padding: 16px 24px;"><span style="color: #10b981; font-weight: 700; font-size: 12px;">Completed</span></td>
                            </tr>
                            @empty
                            <tr><td colspan="4" style="padding: 40px; text-align: center; color: #94a3b8;">No donations recorded yet.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div style="background: white; border-radius: 24px; border: 1px solid #e2e8f0; overflow: hidden;">
                    <div style="padding: 24px; border-bottom: 1px solid #f1f5f9;">
                        <h3 style="font-weight: 800; font-size: 18px;">Blood Requests</h3>
                    </div>
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead style="background: #f8fafc; font-size: 11px; text-transform: uppercase; color: #64748b;">
                            <tr>
                                <th style="text-align: left; padding: 12px 24px;">Patient</th>
                                <th style="text-align: left; padding: 12px 24px;">Hospital</th>
                                <th style="text-align: left; padding: 12px 24px;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($requestHistory as $req)
                            <tr>
                                <td style="padding: 16px 24px;">
                                    <div style="font-weight: 700; font-size: 14px;">{{ $req->patient_name }}</div>
                                    <div style="font-size: 11px; color: #94a3b8;">{{ $req->blood_type }} Needed</div>
                                </td>
                                <td style="padding: 16px 24px; font-size: 14px; color: #64748b;">{{ $req->hospital }}</td>
                                <td style="padding: 16px 24px;">
                                    <span style="padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: 800; text-transform: uppercase; 
                                        @if($req->status == 'pending') background: #fef9c3; color: #854d0e; @elseif($req->status == 'approved') background: #dcfce7; color: #166534; @else background: #fee2e2; color: #991b1b; @endif">
                                        {{ $req->status }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="3" style="padding: 40px; text-align: center; color: #94a3b8;">No blood requests found.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div style="display: flex; flex-direction: column; gap: 24px;">
                @foreach($announcements as $ann)
                <div style="background: {{ $ann->tag == 'urgent' ? '#C0392B' : '#0A0A0A' }}; padding: 24px; border-radius: 24px; color: white; position: relative; overflow: hidden;">
                    <div style="font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; color: rgba(255,255,255,0.6); margin-bottom: 10px;">{{ $ann->tag }} • {{ $ann->date }}</div>
                    <h4 style="font-size: 18px; font-weight: 700; margin-bottom: 8px;">{{ $ann->title }}</h4>
                    <p style="font-size: 13px; line-height: 1.6; color: rgba(255,255,255,0.8);">{{ $ann->body }}</p>
                    @if($ann->tag == 'urgent')
                        <div style="position: absolute; right: -10px; bottom: -10px; font-size: 80px; opacity: 0.1;">🩸</div>
                    @endif
                </div>
                @endforeach
            </div>

        </div>
    </div>
</x-layout>