<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>IssetEmpty</title>
</head>
<body>
        @isset($name)
            Hello, my name is {{$name}}
        @endisset
        <br>
        @empty($name)
            I dont have a name
        @endempty
</body>
</html>