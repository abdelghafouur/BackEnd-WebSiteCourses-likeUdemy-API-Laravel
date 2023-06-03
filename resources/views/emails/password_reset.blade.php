<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Password Reset</title>
</head>
<body>
    <h1>Password Reset</h1>
    <p>Click the following link to reset your password:</p>
    <a href="{{ url('password/reset', $code) }}">Reset Password</a>
    <p>If you did not request a password reset, please ignore this email.</p>
</body>
</html>
