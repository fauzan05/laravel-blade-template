<?php

namespace App\Providers;

use App\Models\Person;
use App\Services\SayHello;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider implements DeferrableProvider
{
    // public $singletons = [
    //     SayHello::class
    // ];
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(SayHello::class, function() {
            return new SayHello();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::directive('hello', function($name){
            return "<?php echo 'Hello ' . $name; ?>";
        });
        Blade::stringable(Person::class, function(Person $person){
            return "$person->name : $person->address";
        });
    }
}
