<x-layout>

<div style="padding:40px;font-family:DM Sans;">

    <h1 style="font-size:28px;font-weight:700;">Edit Profile</h1>

    @if(session('success'))
        <div style="margin-top:15px;color:green;font-weight:600;">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}"
          style="margin-top:25px;background:#fff;border-radius:12px;overflow:hidden;box-shadow:0 4px 6px rgba(0,0,0,0.05);">

        @csrf

        <table style="width:100%;border-collapse:collapse;">

            <tr style="background:#f5f5f5;">
                <th style="text-align:left;padding:15px;">Field</th>
                <th style="text-align:left;padding:15px;">Input</th>
            </tr>

            <tr>
                <td style="padding:15px;border-top:1px solid #eee;">Name</td>
                <td style="padding:15px;border-top:1px solid #eee;">
                    <input type="text" name="name"
                           value="{{ auth()->user()->name }}"
                           style="width:100%;padding:10px;border:1px solid #ddd;border-radius:6px;">
                </td>
            </tr>

            <tr>
                <td style="padding:15px;border-top:1px solid #eee;">Email</td>
                <td style="padding:15px;border-top:1px solid #eee;">
                    <input type="email" name="email"
                           value="{{ auth()->user()->email }}"
                           style="width:100%;padding:10px;border:1px solid #ddd;border-radius:6px;">
                </td>
            </tr>

            <tr>
                <td style="padding:15px;border-top:1px solid #eee;">New Password</td>
                <td style="padding:15px;border-top:1px solid #eee;">
                    <input type="password" name="password"
                           placeholder="Leave blank to keep current password"
                           style="width:100%;padding:10px;border:1px solid #ddd;border-radius:6px;">
                </td>
            </tr>

        </table>

        <div style="padding:15px;">
            <button type="submit"
                    style="background:#C0392B;color:#fff;padding:10px 20px;border:none;border-radius:8px;">
                Save Changes
            </button>
        </div>

    </form>

</div>

</x-layout>