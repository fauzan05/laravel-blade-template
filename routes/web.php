<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::view('/hello', 'hello', ['name' => 'fauzan', 'title' => 'blade test']);

Route::view('/html/encoding', 'html-encoding', ['name' => 'Fauzan']);
Route::view('/html/disable', 'disable', ['name' => 'Fauzan']);
Route::view('/unless', 'unless', ['name' => 'Susi']);
Route::view('/empty', 'issetempty', ['name' => 'Susi']);
Route::view('/env', 'env');

