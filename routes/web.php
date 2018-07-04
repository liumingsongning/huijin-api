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
Route::get('/test', 'testController@test');
Route::get('/testAlipay', 'testController@testAlipay');
Route::get('/test1', function () {
    return Redis::get('123456');
});

Route::post('/webhook', 'WebhookController@pull');

Route::get('auth/{driver}', 'Auth\SersocialiteController@redirectToProvider');
Route::get('auth/{driver}/callback', 'Auth\SersocialiteController@handleProviderCallback');


Route::get('alipay', '\App\Http\Controllers\Api\V1\Payment\PaymentController@alipay');
Route::get('return', '\App\Http\Controllers\Api\V1\Payment\PaymentController@alipayReturn');
Route::get('notify', '\App\Http\Controllers\Api\V1\Payment\PaymentController@aliPaynotify');


Route::get('testreturn', 'testController@alipayReturn');
Route::get('testnotify', 'testController@aliPaynotify');
