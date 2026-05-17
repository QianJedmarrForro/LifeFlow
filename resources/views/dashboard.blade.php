<x-layout :hasUnreadNotifications="$hasUnreadNotifications" :notificationsList="$notificationsList">
    <style>
        .reward-toast {
            position: fixed;
            bottom: 24px;
            right: 24px;
            background: #ffffff;
            border: 1px solid rgba(229, 231, 235, 0.9);
            border-radius: 18px;
            box-shadow: 0 20px 40px rgba(15, 23, 42, 0.16);
            padding: 18px 20px;
            display: flex;
            align-items: center;
            gap: 14px;
            opacity: 0;
            transform: translateY(20px) scale(0.98);
            transition: transform 0.25s ease, opacity 0.25s ease;
            z-index: 9999;
        }
        .reward-toast.show {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
        .reward-bag {
            width: 46px;
            height: 46px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%);
            color: white;
            font-size: 24px;
            box-shadow: inset 0 -8px 0 rgba(255,255,255,0.18), 0 12px 25px rgba(0,0,0,0.16);
            animation: floatBag 2.4s ease-in-out infinite;
        }
        .reward-toast h4 {
            margin: 0;
            font-size: 15px;
            color: #111827;
            font-weight: 800;
        }
        .reward-toast p {
            margin: 0;
            color: #4b5563;
            font-size: 13px;
            line-height: 1.4;
        }
        @keyframes floatBag {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-6px); }
        }

        .reward-modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.55);
            backdrop-filter: blur(2px);
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.25s ease, visibility 0.25s ease;
            z-index: 9998;
        }
        .reward-modal-overlay.open {
            opacity: 1;
            visibility: visible;
        }
        .reward-modal {
            position: fixed;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%) scale(0.96);
            width: min(540px, calc(100% - 32px));
            background: #ffffff;
            border-radius: 24px;
            padding: 24px;
            box-shadow: 0 16px 40px rgba(15, 23, 42, 0.16);
            transition: transform 0.28s ease, opacity 0.28s ease, visibility 0.28s ease;
            opacity: 0;
            visibility: hidden;
            z-index: 9999;
        }
        .reward-modal.open {
            transform: translate(-50%, -50%) scale(1);
            opacity: 1;
            visibility: visible;
        }
        .reward-modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            margin-bottom: 20px;
        }
        .reward-modal-header h3 {
            margin: 0;
            font-size: 18px;
            color: #111827;
        }
        .reward-modal-close {
            width: 36px;
            height: 36px;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            background: #f8fafc;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: #374151;
            font-weight: 700;
        }
        .reward-progress-track {
            width: 100%;
            background: #f8fafc;
            border-radius: 999px;
            height: 16px;
            overflow: hidden;
            margin-top: 18px;
        }
        .reward-progress-fill {
            height: 100%;
            width: 0;
            background: linear-gradient(90deg, #dc2626 0%, #ef4444 100%);
            transition: width 0.4s ease;
        }
        .status-action {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            color: #10b981;
            font-weight: 700;
            font-size: 12px;
        }
        .status-action span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 28px;
            height: 28px;
            border-radius: 10px;
            background: rgba(16, 185, 129, 0.12);
            color: #10b981;
            font-size: 16px;
        }
    </style>

    <div style="max-width: 1200px; margin: 0 auto; font-family: 'DM Sans', sans-serif;">
        
        {{-- SUCCESS NOTIFICATION --}}
        @if(session('success'))
            <div style="background-color: #ecfdf5; border-left: 5px solid #10b981; padding: 16px; margin-bottom: 25px; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); display: flex; align-items: center; animation: slideDown 0.5s ease-out;">
                <div style="background-color: #10b981; color: white; width: 28px; height: 28px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 15px; font-weight: bold; flex-shrink: 0;">
                    ✓
                </div>
                <div>
                    <p style="color: #065f46; font-weight: 800; margin: 0; font-size: 14px;">LifeFlow!</p>
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

        @if(session('reward'))
            @push('toasts')
                <div id="reward-toast" class="reward-toast toast-notify" style="border-color: #f97316;">
                    <span style="display:inline-flex;align-items:center;"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#f97316" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg></span>
                    <div>
                        <h4 style="margin: 0 0 4px; font-size: 14px; color: #111827; font-weight: 800;">Reward Earned</h4>
                        <p style="margin: 0; color: #4b5563; font-size: 13px;">You gained one point! Your donation was recorded. Keep going to unlock more rewards.</p>
                    </div>
                </div>
            @endpush
        @endif

        <div style="margin-bottom: 40px; display: flex; justify-content: space-between; align-items: flex-end;">
            <div>
                <h1 style="font-size: 32px; font-weight: 800; color: #1a1a1a; margin: 0;">Welcome, {{ auth()->user()->name }} </h1>
                <p style="color: #64748b; margin-top: 8px;">Your donor activity and health overview at a glance.</p>
            </div>
            <div style="text-align: right;">
                <span style="display: block; font-size: 12px; color: #94a3b8; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;">Current Status</span>
                <div class="status-action" id="rewards-trigger">
                    <span><svg width="18" height="18" viewBox="0 0 24 24" fill="#C0392B" style="vertical-align:middle;"><path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z"/></svg></span>
                    <div>Donation Rewards</div>
                </div>
                <span style="display:block; margin-top: 6px; color: #22c55e; font-weight: 700;">● Active Donor</span>
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
                <div style="font-size: 36px; font-weight: 800; color: #1a1a1a;">{{ $pendingRequests }}</div>
                <div style="margin-top: 10px; font-size: 12px;">
                    @if($pendingRequests > 0)
                        <span style="color: #f59e0b;">Waiting for approval</span>
                    @elseif($activeRequestStatus === 'approved')
                        <span style="color: #16a34a;">Approved</span>
                    @elseif($activeRequestStatus === 'rejected')
                        <span style="color: #ef4444;">Rejected</span>
                    @else
                        <span style="color: #94a3b8;">No active requests</span>
                    @endif
                </div>
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
                                <th style="text-align: left; padding: 12px 24px;">Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($donationHistory as $donation)
                            <tr>
                                <td style="padding: 16px 24px; font-size: 14px; font-weight: 600;">{{ $donation->created_at->format('M d, Y') }}</td>
                                <td style="padding: 16px 24px;"><span style="background: #fee2e2; color: #C0392B; padding: 4px 8px; border-radius: 6px; font-weight: 800; font-size: 12px;">{{ $donation->blood_type }}</span></td>
                                <td style="padding: 16px 24px; font-size: 14px; color: #64748b;">{{ $donation->units }}ml</td>
                                <td style="padding: 16px 24px;"><span style="color: #10b981; font-weight: 700; font-size: 12px;">Completed</span></td>
                                <td style="padding: 16px 24px;">
                                    <a href="{{ route('donations.show', $donation->id) }}"
                                       style="display:inline-flex; align-items:center; gap:5px; background:#F1F5F9; color:#374151; text-decoration:none; padding:6px 14px; border-radius:8px; font-size:12px; font-weight:700; transition:background 0.2s;"
                                       onmouseover="this.style.background='#E2E8F0'" onmouseout="this.style.background='#F1F5F9'">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                        View
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="5" style="padding: 40px; text-align: center; color: #94a3b8;">No donations recorded yet.</td></tr>
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
                        <div style="position: absolute; right: -10px; bottom: -10px; opacity: 0.1;"><svg width="80" height="80" viewBox="0 0 24 24" fill="white"><path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z"/></svg></div>
                    @endif
                </div>
                @endforeach
            </div>

        </div>
    </div>

    <div id="reward-modal-overlay" class="reward-modal-overlay"></div>
    <div id="reward-modal" class="reward-modal" aria-hidden="true">
        <div class="reward-modal-header">
            <div>
                <h3>Donation Rewards</h3>
                <p style="margin: 6px 0 0; color: #6b7280; font-size: 13px; max-width: 360px;">Track your progress, points, and how close you are to the next reward milestone.</p>
            </div>
            <button id="reward-modal-close" class="reward-modal-close">✕</button>
        </div>
        <div style="display: flex; gap: 18px; align-items: center; margin-bottom: 20px;">
            <div class="reward-bag" style="width: 62px; height: 62px; font-size: 28px;"><svg width="28" height="28" viewBox="0 0 24 24" fill="white"><path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z"/></svg></div>
            <div>
                <div style="font-size: 15px; font-weight: 800; color: #111827;">{{ $totalDonations }} donation{{ $totalDonations == 1 ? '' : 's' }} completed</div>
                <div style="font-size: 13px; color: #6b7280; margin-top: 6px;">You've earned {{ $totalDonations }} point{{ $totalDonations == 1 ? '' : 's' }} so far.</div>
            </div>
        </div>
        <div style="font-size: 13px; color: #6b7280; margin-bottom: 10px; display: flex; justify-content: space-between; align-items: center;">
            <span>Progress to {{ $donationMilestone }} donations</span>
            <span>{{ $donationProgress }}%</span>
        </div>
        <div class="reward-progress-track">
            <div id="reward-progress-fill" class="reward-progress-fill" style="width: {{ $donationProgress }}%;"></div>
        </div>
    </div>
</x-layout>

@push('notifications')
    @if($notificationsList->isEmpty())
        <div style="padding: 12px; color: var(--text-muted); font-size: 13px; text-align: center;">
            No new notifications.
        </div>
    @else
        @foreach($notificationsList as $notification)
            <div style="padding: 10px; border-radius: 8px; margin-bottom: 6px; font-size: 13px; background: {{ $notification->is_read ? 'rgba(255,255,255,0.02)' : 'rgba(215,38,56,0.1)' }}; border-left: 3px solid {{ $notification->status == 'approved' ? '#10B981' : '#EF4444' }}; transition: 0.2s;">
                <div style="font-weight: 700; color: #FFFFFF; display: flex; justify-content: space-between; align-items: center;">
                    <span>Blood Request {{ ucfirst($notification->status) }}</span>
                    @if(!$notification->is_read)
                        <span style="width: 6px; height: 6px; background: var(--red); border-radius: 50%;"></span>
                    @endif
                </div>
                <p style="color: #94A3B8; margin-top: 2px; line-height: 1.4;">
                    Your request for <strong>{{ $notification->blood_type }}</strong> blood ({{ $notification->bags }} {{ Str::plural('bag', $notification->bags) }}) has been {{ $notification->status }}.
                </p>
                <span style="font-size: 10px; color: #64748B; display: block; margin-top: 4px;">
                    {{ $notification->updated_at->diffForHumans() }}
                </span>
            </div>
        @endforeach
    @endif
@endpush

<script>
(function() {
    const trigger = document.getElementById('rewards-trigger');
    const overlay = document.getElementById('reward-modal-overlay');
    const modal = document.getElementById('reward-modal');
    const closeBtn = document.getElementById('reward-modal-close');
    const toast = document.getElementById('reward-toast');

    function openModal() {
        if(overlay && modal) {
            overlay.classList.add('open');
            modal.classList.add('open');
            modal.setAttribute('aria-hidden', 'false');
        }
    }
    function closeModal() {
        if(overlay && modal) {
            overlay.classList.remove('open');
            modal.classList.remove('open');
            modal.setAttribute('aria-hidden', 'true');
        }
    }

    if (trigger) {
        trigger.addEventListener('click', openModal);
    }
    if (closeBtn) {
        closeBtn.addEventListener('click', closeModal);
    }
    if (overlay) {
        overlay.addEventListener('click', function(event) {
            if (event.target === overlay) {
                closeModal();
            }
        });
    }
    if (toast) {
        requestAnimationFrame(() => {
            toast.classList.add('show');
        });
        setTimeout(() => {
            toast.classList.remove('show');
        }, 4000);
    }
})();
</script>