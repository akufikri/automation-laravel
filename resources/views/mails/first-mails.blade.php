<!DOCTYPE html>
<html>

<head>
    <title>{{ config('app.name') }} - Go Tax</title>
</head>

<body>
    <p>Name: {{ $pengguna['name'] }}</p>
    <p>Email: {{ $pengguna['email'] }}</p>
    <p>Subject: {{ $pengguna['subject'] }}</p>
    <p>Message: {{ $pengguna['message'] }}</p>
</body>

</html>
