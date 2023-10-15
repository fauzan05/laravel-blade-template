<?php

namespace Tests\Feature;

use App\Models\Person;
use App\Services\SayHello;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Blade;
use Tests\TestCase;

class HelloTest extends TestCase
{
    public function testHello()
    {
        $this->get('/hello')
            ->assertSeeText('Hello fauzan');
    }

    public function testHelloView()
    {
        $this->view('hello', ['name' => 'fauzan', 'title' => 'blade test'])
            ->assertSeeText('Hello fauzan');
    }

    // public function testDisableBlade()
    // {
    //     $this->view('disable', ['name' => 'Fauzan'])
    //         ->assertSeeText('jika ingin mendisable blade, maka tambahkan @ {{$name}} atau menambahkan @if(isset($name)) Fauzan @endif')
    //         ->assertSeeText('Disable Blade');
    // }
    public function testEnv()
    {
        $this->view('env')
            ->assertSeeText('This is test environment');
    } 

    public function testLayout()
    {
        $this->view('include', [])
            ->assertSeeText('This is header')
            ->assertSeeText('selamat datang di belajar view laravel');
        $this->view('include', ['title' => 'ini adalah title'])
            ->assertSeeText('ini adalah title')
            ->assertSeeText('selamat datang di belajar view laravel');
    }

    // public function testIncludeCondition()
    // {
    //     $this->view('include-condition', ['user' => [
    //         'name' => 'Fauzan Nur Hidayat',
    //         'owner' => true
    //     ],
    //         'title' => 'Halaman include condition',
    //         ])->assertSeeText('Selamat Datang owner')
    //             ->assertSeeText('selamat datang Fauzan Nur Hidayat')
    //             ->assertSeeText('ini adalah halaman owner')
    //             ->assertSeeText('Halaman include condition');
    // }

    public function testEach()
    {
        $this->view('each', ['users' => [
        [
            'name' => 'fauzan',
            'hobbies' => ['Coding', 'Gaming']
        ],
        [
            'name' => 'sofia',
            'hobbies' => ['Reading', 'Swimming']
        ]]])->assertSeeInOrder(['.red', 'fauzan', 'Coding', 'Gaming', 'sofia', 'Reading', 'Swimming']);
    }

    public function testForm()
    {
        $this->view('form', ['user' => [
            'premium' => true,
            'name' => 'fauzan',
            'admin' => true
        ]])
            ->assertSee('checked')
            ->assertSee('fauzan')
            ->assertDontSee('readonly');
    }
    
    public function testCSRF()
    {
        $this->view('csrf', [])
            ->assertSee('_token');
    }

    public function testValidationErrors()
    {
        $errors = [
            'name' => 'Name is required',
            'password' => 'Password is required'
        ];
        $this->withViewErrors($errors)
            ->view('error', [])
            ->assertSeeText('Name is required')
            ->assertSeeText('Password is required');
    }

    public function testStack()
    {
        $this->view('stack', [])
            ->assertSeeInOrder([
                'third.js',
                'first.js',
                'second.js'
            ]);
    }

    public function testParent()
    {
        $this->view('child', [])
            ->assertSeeText('Nama Aplikasi : Halaman Utama')
            ->assertSeeText('Deskripsi Header')
            ->assertSeeText('Ini adalah isi kontennya');
    }

    public function testParent1()
    {
        $this->view('child1', [])
            ->assertSeeText('Header by Child')
            ->assertSeeText('Nama Aplikasi : Halaman Utama')
            ->assertSeeText('Default Header')
            ->assertSeeText('Default Content');
    }

    public function testServiceInjection()
    {
        $this->view('service-injection', ['name' => 'fauzan'])
            ->assertSeeText('Hello fauzan');
    }

    public function testSingletonServiceInjection()
    {
        // $this->app->singleton(SayHello::class, function(){
        //     return new SayHello();
        // });

        $sayHello1 = $this->app->make(SayHello::class);
        $sayHello2 = $this->app->make(SayHello::class);
        self::assertSame($sayHello1, $sayHello2);
    }

    public function testInlineBladeTemplate()
    {
        $response = Blade::render('Hello {{$name}}', ['name' => 'fauzan']);
            self::assertEquals($response, 'Hello fauzan');
    }

    public function testExtendingBlade()
    {
        $this->view('extending', ['name' => 'fauzan'])
            ->assertSeeText('Hello fauzan');
    }
    
    public function testEcho()
    {
        $person = new Person();
        $person->name = 'fauzan';
        $person->address = 'kebumen';

        $this->view('echo', ['objPerson' => $person])
                ->assertSeeText('fauzan : kebumen');
    }
}
