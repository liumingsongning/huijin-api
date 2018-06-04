<?php
use Illuminate\Support\Facades\Redis;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});
Route::get('/test', function () {
    Redis::set('123456', '123', 'EX', 3000);
});
Route::get('/test1', function () {
    return Redis::get('123456');
});

Route::post('/webhook', 'WebhookController@pull');
