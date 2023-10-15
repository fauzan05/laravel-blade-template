<!DOCTYPE html>
<html>
<head>
    <title>{{$title}}</title>
</head>
<body>
    @includeWhen($user['owner'], 'header-admin')
    <p>Selamat datang {{ $user['name'] }}</p>
</body>
</html> 