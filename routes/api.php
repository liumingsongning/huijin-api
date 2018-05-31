<?php

use Illuminate\Http\Request;

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    $api->group(['namespace' => 'App\Http\Controllers\Api\V1'], function ($api) {
        $api->group(['namespace'=>'\Login'],function($api){
            $api->post('login','LoginController@login');
            $api->post('sendcode','LoginController@sendPhoneCode');
        });
        $api->group(['namespace'=>'\Goods'],function($api){
            $api->resource('goods','GoodsController');
        });
        // $api->group(['middleware' => 'api.auth','namespace'=>'\Login'],function($api){
        //     $api->post('test','LoginController@login');
        // });
    });
});
