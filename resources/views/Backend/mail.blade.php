
<p><b>Dear {{ $user->userName }},</b></p>
<p>Your account has been created, please click below link and activate your account</p>
<h3><a href="{{ route('verify', $user->email_varified_token) }}">Click here</a></h3>
