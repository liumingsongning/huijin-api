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

Route::get('/', function () {
    // return view('welcome');
    dd(1);
});
Route::get('/test', function () {
    // return view('welcome');
    dd(9);
});
Route::post('/webhook', function () {
    // echo exec('whoami') ;
    $path=base_path();
    $data = shell_exec('ls -l');
    echo $data;
    $data2=shell_exec("sudo cd {$path} && /usr/bin/git reset --hard origin/master && /usr/bin/git clean -f && /usr/bin/git pull 2>&1");
    echo 111111111111111111111111;
    echo 'zheshi'.$data2;
    // // dd($output);
    // return ['success'=>$data];

});
