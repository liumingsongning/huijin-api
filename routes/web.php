<?php

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

use Illuminate\Http\Request;

Route::get('/', function () {
    // return view('welcome');
    dd(1);
});
Route::get('/test', function () {
    // return view('welcome');
    dd(9);
});
Route::post('/webhook', function (Request $request) {
    
    $path=base_path();
    shell_exec("cd {$path} && sudo /usr/bin/git reset --hard origin/master && sudo /usr/bin/git clean -f && sudo /usr/bin/git pull 2>&1");
    return $request;
});
