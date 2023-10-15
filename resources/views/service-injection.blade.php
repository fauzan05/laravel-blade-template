<html>
    <body>
        @inject('service', 'App\Services\SayHello')
        <h2>{{ $service->sayHello($name) }}</h2>
    </body>
</html>