<x-layout>
 
<style>
    .dashboard-card {
        background: #fff;
        padding: 24px;
        border-radius: 12px;
        border-left: 5px solid #ef4444;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        transition: all 0.25s ease;
    }
    .dashboard-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 25px rgba(0,0,0,0.12);
    }
    .blood-card {
        background: #fff;
        padding: 20px;
        border-radius: 12px;
        text-align: center;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        border-left: 5px solid #ef4444;
        transition: all 0.25s ease;
    }
    .blood-card:hover {
        transform: translateY(-6px) scale(1.03);
        box-shadow: 0 12px 25px rgba(0,0,0,0.15);
        cursor: pointer;
    }
    .info-card {
        background: #fff;
        border-radius: 12px;
        padding: 20px;
        border: 0.5px solid #e2e8f0;
        transition: all 0.25s ease;
    }
    .info-card:hover {
        transform: translateY(-4px);
    }
    .benefit-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        margin-bottom: 12px;
    }
    .step-num {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: #ef4444;
        color: #fff;
        font-size: 13px;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .ann-item {
        padding: 14px 0;
        border-bottom: 0.5px solid #f1f5f9;
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }
    .ann-item:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }
    .ann-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        flex-shrink: 0;
        margin-top: 5px;
    }
    .tag-pill {
        font-size: 10px;
        padding: 2px 8px;
        border-radius: 20px;
        font-weight: 600;
        display: inline-block;
    }
    .profile-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #ef4444;
        background: #f1f5f9;
    }
</style>
 
<div style="font-family: 'DM Sans', sans-serif; padding: 40px; background-color: #f8fafc; min-height: 100vh;">
 
    {{-- Header --}}
    <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 5px;">
        @if(auth()->user()->profile_photo)
            <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}" class="profile-avatar">
        @else
            <div class="profile-avatar" style="display: flex; align-items: center; justify-content: center; font-size: 24px; color: #cbd5e1;">👤</div>
        @endif
        <div>
            <h1 style="font-size: 28px; font-weight: 700; margin: 0;">Welcome back, {{ auth()->user()->name }}!</h1>
            <p style="color: #666; margin: 0;">Blood Bank Overview Dashboard</p>
        </div>
    </div>
 
    {{-- Stat Cards --}}
    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-top: 25px;">
        <a href="{{ route('donors.records') }}" style="text-decoration: none;">
            <div class="dashboard-card">
                <div style="font-size: 14px; color: #888;">Total Donors</div>
                <div style="font-size: 32px; font-weight: 700; color: #1e293b;">{{ $totalDonors }}</div>
            </div>
        </a>
        <a href="{{ route('donors.records') }}" style="text-decoration: none;">
            <div class="dashboard-card">
                <div style="font-size: 14px; color: #888;">Blood Units</div>
                <div style="font-size: 32px; font-weight: 700; color: #1e293b;">{{ $totalUnits }}</div>
            </div>
        </a>
        <a href="{{ route('blood-requests.index') }}" style="text-decoration: none;">
            <div class="dashboard-card">
                <div style="font-size: 14px; color: #888;">Pending Requests</div>
                <div style="font-size: 32px; font-weight: 700; color: #1e293b;">{{ $pendingRequests }}</div>
            </div>
        </a>
    </div>
 
    {{-- Announcements Card --}}
    <div style="background: #fff; border-radius: 16px; border-left: 5px solid #ef4444; padding: 24px; margin-top: 32px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
        <div style="margin-bottom: 16px;">
            <h2 style="font-size: 18px; font-weight: 700; color: #1e293b; margin-bottom: 2px;">Announcements</h2>
            <p style="font-size: 12px; color: #94a3b8;">Latest updates, alerts, and notices</p>
        </div>
 
        @forelse($announcements as $ann)
            @php
                $tagStyles = [
                    'urgent' => ['bg' => '#FCEBEB', 'color' => '#A32D2D', 'dot' => '#ef4444'],
                    'notice' => ['bg' => '#FAEEDA', 'color' => '#633806', 'dot' => '#EF9F27'],
                    'info'   => ['bg' => '#E6F1FB', 'color' => '#0C447C', 'dot' => '#378ADD'],
                    'event'  => ['bg' => '#EAF3DE', 'color' => '#27500A', 'dot' => '#639922'],
                ];
                $style = $tagStyles[$ann->tag] ?? $tagStyles['info'];
            @endphp
            <div class="ann-item">
                <div class="ann-dot" style="background: {{ $style['dot'] }};"></div>
                <div>
                    <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 4px; flex-wrap: wrap;">
                        <span style="font-size: 14px; font-weight: 700; color: #1e293b;">{{ $ann->title }}</span>
                        <span class="tag-pill" style="background: {{ $style['bg'] }}; color: {{ $style['color'] }};">{{ $ann->tag }}</span>
                    </div>
                    <div style="font-size: 12px; color: #64748b; line-height: 1.6;">{{ $ann->body }}</div>
                    <div style="font-size: 11px; color: #94a3b8; margin-top: 4px;">{{ \Carbon\Carbon::parse($ann->date)->format('M d, Y') }}</div>
                </div>
            </div>
        @empty
            <p style="font-size: 13px; color: #94a3b8; text-align: center; padding: 24px 0;">No announcements yet.</p>
        @endforelse
    </div>
 
    {{-- What is a Blood Bank --}}
    <div style="margin-top: 32px; background: #fff; border-radius: 16px; border: 0.5px solid #e2e8f0; padding: 28px;">
        <div style="display: flex; align-items: flex-start; gap: 20px; flex-wrap: wrap;">
            <div style="flex: 1; min-width: 220px;">
                <span style="display: inline-block; font-size: 11px; font-weight: 600; padding: 3px 10px; border-radius: 20px; background: #FCEBEB; color: #A32D2D; margin-bottom: 10px;">What is a blood bank?</span>
                <h2 style="font-size: 20px; font-weight: 700; color: #1e293b; margin-bottom: 10px; line-height: 1.4;">A lifesaving bridge between donors and patients</h2>
                <p style="font-size: 13px; color: #64748b; line-height: 1.7;">A blood bank collects, tests, processes, and stores donated blood. It ensures that safe, compatible blood is always available when surgeries, emergencies, or medical treatments require it — 24 hours a day, every day.</p>
            </div>
            <div style="display: flex; flex-direction: column; gap: 10px; min-width: 200px; flex: 1;">
                <div style="display: flex; align-items: center; gap: 10px; padding: 12px; background: #f8fafc; border-radius: 10px;">
                    <div class="step-num">1</div>
                    <div>
                        <div style="font-size: 13px; font-weight: 600; color: #1e293b;">Collect</div>
                        <div style="font-size: 12px; color: #64748b;">Blood drawn from eligible donors</div>
                    </div>
                </div>
                <div style="display: flex; align-items: center; gap: 10px; padding: 12px; background: #f8fafc; border-radius: 10px;">
                    <div class="step-num">2</div>
                    <div>
                        <div style="font-size: 13px; font-weight: 600; color: #1e293b;">Screen & test</div>
                        <div style="font-size: 12px; color: #64748b;">Safety and compatibility checks</div>
                    </div>
                </div>
                <div style="display: flex; align-items: center; gap: 10px; padding: 12px; background: #f8fafc; border-radius: 10px;">
                    <div class="step-num">3</div>
                    <div>
                        <div style="font-size: 13px; font-weight: 600; color: #1e293b;">Store & supply</div>
                        <div style="font-size: 12px; color: #64748b;">Distributed to hospitals in need</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 
    {{-- Why Blood Banks Matter --}}
    <div style="margin-top: 32px;">
        <h2 style="font-size: 20px; font-weight: 700; margin-bottom: 15px; color: #1e293b;">Why blood banks matter</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); gap: 14px;">
            <div class="info-card">
                <div class="benefit-icon" style="background: #FCEBEB;">🚑</div>
                <div style="font-size: 14px; font-weight: 700; color: #1e293b; margin-bottom: 6px;">Emergency readiness</div>
                <div style="font-size: 12px; color: #64748b; line-height: 1.6;">Trauma, accidents, and surgery patients depend on instant access to the right blood type.</div>
            </div>
            <div class="info-card">
                <div class="benefit-icon" style="background: #EAF3DE;">🧬</div>
                <div style="font-size: 14px; font-weight: 700; color: #1e293b; margin-bottom: 6px;">Chronic disease support</div>
                <div style="font-size: 12px; color: #64748b; line-height: 1.6;">Patients with sickle cell, thalassemia, or cancer require regular transfusions to stay alive.</div>
            </div>
            <div class="info-card">
                <div class="benefit-icon" style="background: #E6F1FB;">🤱</div>
                <div style="font-size: 14px; font-weight: 700; color: #1e293b; margin-bottom: 6px;">Maternal health</div>
                <div style="font-size: 12px; color: #64748b; line-height: 1.6;">Prevents maternal death from hemorrhage — one of the leading causes of childbirth mortality.</div>
            </div>
            <div class="info-card">
                <div class="benefit-icon" style="background: #FAEEDA;">🔬</div>
                <div style="font-size: 14px; font-weight: 700; color: #1e293b; margin-bottom: 6px;">Quality assurance</div>
                <div style="font-size: 12px; color: #64748b; line-height: 1.6;">Rigorous testing for HIV, Hepatitis B/C, and other pathogens ensures transfusion safety.</div>
            </div>
        </div>
    </div>
 
    {{-- Did You Know --}}
    <div style="margin-top: 32px; background: #fff; border-radius: 16px; border: 0.5px solid #e2e8f0; padding: 24px;">
        <h2 style="font-size: 18px; font-weight: 700; color: #1e293b; margin-bottom: 16px;">Did you know?</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(140px, 1fr)); gap: 12px;">
            <div style="text-align: center; padding: 16px; background: #f8fafc; border-radius: 10px;">
                <div style="font-size: 24px; font-weight: 700; color: #ef4444;">Every 2s</div>
                <div style="font-size: 12px; color: #64748b; margin-top: 4px;">someone needs blood globally</div>
            </div>
            <div style="text-align: center; padding: 16px; background: #f8fafc; border-radius: 10px;">
                <div style="font-size: 24px; font-weight: 700; color: #ef4444;">3 lives</div>
                <div style="font-size: 12px; color: #64748b; margin-top: 4px;">saved per single donation</div>
            </div>
            <div style="text-align: center; padding: 16px; background: #f8fafc; border-radius: 10px;">
                <div style="font-size: 24px; font-weight: 700; color: #ef4444;">42 days</div>
                <div style="font-size: 12px; color: #64748b; margin-top: 4px;">max storage for red blood cells</div>
            </div>
            <div style="text-align: center; padding: 16px; background: #f8fafc; border-radius: 10px;">
                <div style="font-size: 24px; font-weight: 700; color: #ef4444;">O−</div>
                <div style="font-size: 12px; color: #64748b; margin-top: 4px;">universal donor — rarest need</div>
            </div>
        </div>
    </div>
 
    {{-- Quick Actions --}}
    <div style="margin-top: 32px;">
        <h2 style="font-size: 20px; font-weight: 700; margin-bottom: 15px;">Quick Actions</h2>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <a href="{{ route('donations.index') }}" style="text-decoration: none;">
                <div class="dashboard-card" style="display: flex; align-items: center; justify-content: space-between;">
                    <div>
                        <div style="font-size: 18px; font-weight: 700; color: #1e293b;">Want to Donate?</div>
                        <div style="font-size: 13px; color: #64748b;">Register as a donor and save lives today.</div>
                    </div>
                    <div style="font-size: 22px;">🩸</div>
                </div>
            </a>
            <a href="{{ route('blood-requests.index') }}" style="text-decoration: none;">
                <div class="dashboard-card" style="display: flex; align-items: center; justify-content: space-between;">
                    <div>
                        <div style="font-size: 18px; font-weight: 700; color: #1e293b;">Want to Request?</div>
                        <div style="font-size: 13px; color: #64748b;">Submit a request for blood units.</div>
                    </div>
                    <div style="font-size: 22px;">📋</div>
                </div>
            </a>
        </div>
    </div>
 
    {{-- Blood Types --}}
    <div style="margin-top: 40px;">
        <h2 style="font-size: 20px; font-weight: 700; margin-bottom: 15px;">Blood Types in System</h2>
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 15px;">
            @forelse($bloodTypes as $type)
                <a href="{{ route('donors.records') }}" style="text-decoration: none;">
                    <div class="blood-card">
                        <div style="font-size: 22px; font-weight: 700; color: #ef4444;">{{ $type->blood_type }}</div>
                        <div style="font-size: 14px; color: #333; font-weight: 600;">{{ $type->total }} donors</div>
                    </div>
                </a>
            @empty
                <div style="color: #888; grid-column: span 4;">No blood types available yet.</div>
            @endforelse
        </div>
    </div>
 
</div>
 
</x-layout>