<x-layout>
<div style="padding:40px; font-family: 'DM Sans', sans-serif; background-color: #f8fafc; min-height: 100vh;">
    
    <div style="margin-bottom: 30px;">
        <h1 style="font-size:28px; font-weight:700; color: #1e293b;">Blood Inventory</h1>
        <p style="color:#64748b;">Current stock levels calculated from total donations minus approved requests.</p>
    </div>

    <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
        @foreach($inventory as $item)
        <div style="background:#fff; padding:25px; border-radius:16px; box-shadow:0 4px 6px rgba(0,0,0,0.05); border-top: 5px solid {{ $item->status == 'Low' ? '#ef4444' : '#10b981' }};">
            <div style="display:flex; justify-content:space-between; align-items:center;">
                <h2 style="font-size:24px; font-weight:800; color:#1e293b; margin:0;">{{ $item->type }}</h2>
                <span style="font-size:10px; font-weight:800; text-transform:uppercase; padding:4px 8px; border-radius:12px; {{ $item->status == 'Low' ? 'background:#fee2e2; color:#ef4444;' : 'background:#dcfce7; color:#166534;' }}">
                    {{ $item->status }}
                </span>
            </div>
            
            <div style="margin-top:15px;">
                <div style="font-size:32px; font-weight:700; color:#1e293b;">{{ number_format($item->stock) }} <span style="font-size:14px; color:#64748b;">ml</span></div>
                
                <div style="width:100%; background:#f1f5f9; height:8px; border-radius:4px; margin-top:10px; overflow:hidden;">
                    <div style="width:{{ min(($item->stock / 5000) * 100, 100) }}%; background:{{ $item->status == 'Low' ? '#ef4444' : '#10b981' }}; height:100%;"></div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div style="margin-top:40px; background:#fff; padding:25px; border-radius:16px; border:1px solid #e2e8f0;">
        <h3 style="font-size:18px; font-weight:700; color:#1e293b; margin-bottom:10px;">Stock Management Info</h3>
        <p style="color:#64748b; font-size:14px; line-height:1.6;">
            A blood type is marked as <strong>Low</strong> if the available units fall below 2,000ml. 
            The progress bar represents capacity based on a 5,000ml target per blood type.
        </p>
    </div>
</div>
</x-layout>