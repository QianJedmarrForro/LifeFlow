<x-layout>

<div style="padding:40px;font-family:DM Sans;">

    @php
        $users = \App\Models\User::count();
        $donations = \App\Models\Donation::count();
        $requests = \App\Models\BloodRequest::count();

        $bloodRequests = \App\Models\BloodRequest::latest()->get();
    @endphp

    <h1 style="font-size:28px;font-weight:700;">
        Admin Dashboard
    </h1>

    <p style="color:#666;">
        Welcome, {{ auth()->user()->name }}
    </p>

    <div style="margin-top:30px;display:grid;grid-template-columns:repeat(3,1fr);gap:20px;">

        <div style="background:#fff;padding:20px;border-radius:12px;box-shadow:0 4px 6px rgba(0,0,0,0.05);">
            <h3>Total Users</h3>
            <p style="font-size:24px;font-weight:700;">
                {{ $users }}
            </p>
        </div>

        <div style="background:#fff;padding:20px;border-radius:12px;box-shadow:0 4px 6px rgba(0,0,0,0.05);">
            <h3>Total Donations</h3>
            <p style="font-size:24px;font-weight:700;">
                {{ $donations }}
            </p>
        </div>

        <div style="background:#fff;padding:20px;border-radius:12px;box-shadow:0 4px 6px rgba(0,0,0,0.05);">
            <h3>Blood Requests</h3>
            <p style="font-size:24px;font-weight:700;">
                {{ $requests }}
            </p>
        </div>

    </div>

    <div style="margin-top:40px;">

        <h2 style="font-size:20px;font-weight:700;margin-bottom:15px;">
            Blood Requests Management
        </h2>

        <table style="width:100%;background:#fff;border-radius:12px;overflow:hidden;">
            <tr style="background:#f1f5f9;">
                <th style="padding:12px;text-align:left;">User</th>
                <th>Blood Type</th>
                <th>Status</th>
                <th>Action</th>
            </tr>

            @foreach($bloodRequests as $req)
            <tr>

                <td style="padding:12px;">
                    {{ $req->user->name ?? 'Unknown' }}
                </td>

                <td>
                    {{ $req->blood_type }}
                </td>

                <td>
                    @if($req->status === 'pending')
                        <span style="color:orange;font-weight:700;">Pending</span>
                    @elseif($req->status === 'approved')
                        <span style="color:green;font-weight:700;">Approved</span>
                    @else
                        <span style="color:red;font-weight:700;">Rejected</span>
                    @endif
                </td>

                <td style="display:flex;gap:8px;padding:10px;">

                    <form method="POST" action="{{ route('admin.request.approve', $req->id) }}">
                        @csrf
                        <button style="background:green;color:white;border:none;padding:6px 10px;border-radius:6px;">
                            Approve
                        </button>
                    </form>

                    <form method="POST" action="{{ route('admin.request.reject', $req->id) }}">
                        @csrf
                        <button style="background:red;color:white;border:none;padding:6px 10px;border-radius:6px;">
                            Reject
                        </button>
                    </form>

                </td>

            </tr>
            @endforeach

        </table>

    </div>

</div>

</x-layout>