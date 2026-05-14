<x-layout>
<style>
    /* Screen Styles */
    .search-input:focus { border-color: #ef4444 !important; outline: none; box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1); }
    .suggestion-item:hover { background-color: #f1f5f9; color: #ef4444; }

    .floating-print-btn {
        position: fixed;
        bottom: 30px;
        right: 30px;
        z-index: 1000;
        background: #1e293b;
        color: white;
        padding: 15px 25px;
        border-radius: 50px;
        border: none;
        cursor: pointer;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 10px;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.3);
        transition: all 0.3s ease;
    }

    .floating-print-btn:hover {
        transform: translateY(-5px);
        background: #334155;
    }

    /* Print Styles - FIXED PARA DILI MAPUTOL ANG TABLE */
    @media print {
        nav, .sidebar, .no-print, header, footer, .navbar, aside, .floating-print-btn { 
            display: none !important; 
        }

        body, .lf-main, main, .container { 
            margin: 0 !important; 
            padding: 0 !important; 
            width: 100% !important;
            height: auto !important;
            overflow: visible !important;
            background: white !important;
        }

        .report-container { 
            box-shadow: none !important; 
            border: none !important; 
            padding: 0 !important;
            width: 100% !important;
        }

        /* Pugson ang container nga ipakita tanan sulod (no scroll) */
        #donationsTableContainer, #requestsTableContainer {
            max-height: none !important;
            height: auto !important;
            overflow: visible !important;
            border: none !important;
            box-shadow: none !important;
        }

        table { 
            width: 100% !important; 
            border-collapse: collapse !important;
            page-break-inside: auto;
        }
        
        tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }

        th, td { 
            border: 1px solid #e2e8f0 !important; 
            padding: 10px !important;
        }
    }
</style>

<div class="report-container" style="padding:40px; font-family: 'DM Sans', sans-serif; background-color: #f8fafc; min-height: 100vh;">
    
    <div class="no-print" style="margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px;">
        <div>
            <h1 style="font-size:28px; font-weight:700; color: #1e293b;">System Reports</h1>
            <p style="color:#64748b;">Full historical logs of all donations and blood requests.</p>
        </div>
        
        <div style="display: flex; gap: 12px; align-items: center;">
            <div style="position: relative;">
                <span style="position: absolute; left: 12px; top: 10px; color: #94a3b8;">🔍</span>
                <input type="text" id="liveSearch" autocomplete="off" placeholder="Search name or blood type..." 
                    style="padding: 10px 10px 10px 35px; border-radius: 8px; border: 1px solid #e2e8f0; width: 280px; font-size: 14px;" class="search-input">
                
                <div id="searchSuggestions" style="display: none; position: absolute; top: 45px; left: 0; width: 100%; background: white; border: 1px solid #e2e8f0; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); z-index: 1000; max-height: 200px; overflow-y: auto;">
                </div>
            </div>

            <a href="{{ route('admin.dashboard') }}" style="text-decoration: none; color: #64748b; font-weight: 600; font-size: 14px; padding: 10px 16px; border: 1px solid #e2e8f0; border-radius: 8px; background: white;">
                ← Back
            </a>
        </div>
    </div>

    <div id="reportContent">
        <div style="margin-bottom: 40px;">
            <h3 style="margin-bottom: 15px; color: #1e293b; font-size: 18px; display:flex; align-items:center; gap:8px;"><svg width="18" height="18" viewBox="0 0 24 24" fill="#ef4444"><path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z"/></svg> Recent Donations</h3>
            <div id="donationsTableContainer" style="background:#fff; border-radius:12px; box-shadow:0 4px 6px rgba(0,0,0,0.05); overflow:hidden; border: 1px solid #e2e8f0;">
                @include('admin.reports.partials.donations_table')
            </div>
        </div>

        <div>
            <h3 style="margin-bottom: 15px; color: #1e293b; font-size: 18px;">📋 Request History</h3>
            <div id="requestsTableContainer" style="background:#fff; border-radius:12px; box-shadow:0 4px 6px rgba(0,0,0,0.05); overflow:hidden; border: 1px solid #e2e8f0;">
                @include('admin.reports.partials.requests_table')
            </div>
        </div>
    </div>
</div>

<button onclick="window.print()" class="floating-print-btn no-print">
    <span style="font-size: 20px;">🖨️</span>
    <span>Print Report</span>
</button>

<script>
    const searchInput = document.getElementById('liveSearch');
    const suggestionBox = document.getElementById('searchSuggestions');

    searchInput.addEventListener('input', function(e) {
        let query = e.target.value;

        fetch(`{{ route('admin.reports') }}?query=${query}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('donationsTableContainer').innerHTML = data.donations;
            document.getElementById('requestsTableContainer').innerHTML = data.requests;

            if (query.length > 0 && data.suggestions && data.suggestions.length > 0) {
                let html = '';
                data.suggestions.forEach(item => {
                    html += `<div class="suggestion-item" style="padding: 10px 15px; cursor: pointer; border-bottom: 1px solid #f8fafc; font-size: 13px;" onclick="selectSuggestion('${item}')">${item}</div>`;
                });
                suggestionBox.innerHTML = html;
                suggestionBox.style.display = 'block';
            } else {
                suggestionBox.style.display = 'none';
            }
        });
    });

    function selectSuggestion(value) {
        searchInput.value = value;
        suggestionBox.style.display = 'none';
        searchInput.dispatchEvent(new Event('input'));
    }

    document.addEventListener('click', function(e) {
        if (!searchInput.contains(e.target) && !suggestionBox.contains(e.target)) {
            suggestionBox.style.display = 'none';
        }
    });
</script>
</x-layout>