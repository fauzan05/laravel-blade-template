<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Disable Blade</title>
</head>
<body>
    jika ingin mendisable blade, maka tambahkan @
    @{{$name}}
    atau menambahkan 
    @@if(isset($name))
    {{$name}}
    @@endif
</body>
</html>