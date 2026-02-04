<div style="max-width:600px;margin:auto;font-family:Arial,sans-serif;color:#333;">

    <div style="padding:15px 0;text-align:center;border-bottom:1px solid #eee;">
        <h2 style="margin:0;letter-spacing:1px;color:#b056d5;">
            {{config('app.name')}}
        </h2>
    </div>

    <div style="padding:20px;">
        <p>Dear {{ $user->name }},</p>

        <p>
            This is to inform you that your account details have been updated by an administrator.
        </p>

        @if($passwordChanged)
        <p style="color:#b00020;">
            <strong>Security Notice:</strong> Your account password has been changed by Admin.
        </p>
        @endif

        <p>
            <strong>Change details:</strong><br>
            Updated by: {{ $admin->name }} ( {{ $admin->role }} )<br>
            Date & Time: {{ now()->format('d M Y, h:i A') }}
        </p>

        <p>
            If you have any questions or concerns, please contact Admin.
        </p>
    </div>

    <!-- Footer -->
    <div style="padding:15px;font-size:12px;color:#777;border-top:1px solid #eee;text-align:center;">
        © {{ date('Y') }} matrix.2ic<br>
        <a href="{{ config('app.url') }}" style="color:green">{{ config('app.url') }}</a>
    </div>

</div>