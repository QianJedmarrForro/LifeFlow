<x-layout>

<div style="padding:40px;font-family:DM Sans;">

    <h1 style="font-size:28px;font-weight:700;">Profile Settings</h1>

    <div style="margin-top:25px;background:#fff;border-radius:12px;box-shadow:0 4px 6px rgba(0,0,0,0.05);overflow:hidden;">

        <table style="width:100%;border-collapse:collapse;">

            <tr style="background:#f5f5f5;">
                <th style="text-align:left;padding:15px;">Field</th>
                <th style="text-align:left;padding:15px;">Value</th>
            </tr>

            <tr>
                <td style="padding:15px;border-top:1px solid #eee;">Name</td>
                <td style="padding:15px;border-top:1px solid #eee;">
                    {{ auth()->user()->name }}
                </td>
            </tr>

            <tr>
                <td style="padding:15px;border-top:1px solid #eee;">Email</td>
                <td style="padding:15px;border-top:1px solid #eee;">
                    {{ auth()->user()->email }}
                </td>
            </tr>

            <tr>
                <td style="padding:15px;border-top:1px solid #eee;">Role</td>
                <td style="padding:15px;border-top:1px solid #eee;">
                    {{ auth()->user()->role }}
                </td>
            </tr>

        </table>

    </div>

    <div style="margin-top:20px;">
        <a href="{{ route('profile.edit') }}"
           style="background:#C0392B;color:#fff;padding:10px 15px;border-radius:8px;text-decoration:none;">
            Edit Profile
        </a>
    </div>

</div>

</x-layout>