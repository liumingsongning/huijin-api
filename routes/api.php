<?php

use Illuminate\Http\Request;

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    $api->group(['namespace' => 'App\Http\Controllers\Api\V1'], function ($api) {
        $api->group(['namespace'=>'\Login'],function($api){
            $api->post('login','LoginController@login');
            $api->post('sendcode','LoginController@sendPhoneCode');
            $api->post('checkcaptcha','LoginController@checkcaptcha');
        });
        $api->group(['namespace'=>'\Goods'],function($api){
            $api->resource('goods','GoodsController');
        });
        $api->group(['middleware' => 'api.auth'],function($api){
            $api->group(['namespace'=>'\Cart'],function($api){
                $api->resource('cart','ShoppingCartController');
                $api->post('cart/add','ShoppingCartController@add');
                $api->post('cart/minus','ShoppingCartController@minus');
                $api->post('cart/remove','ShoppingCartController@remove');
                $api->post('cart/clear','ShoppingCartController@clear');
            });

            $api->group(['namespace'=>'\Order'],function($api){
                $api->resource('order','OrderController');
                $api->post('order/add','OrderController@add');
                $api->post('order/minus','OrderController@minus');
                $api->post('order/remove','OrderController@remove');
                $api->post('order/clear','OrderController@clear');
            });
           
            $api->resource('address','Address\AddressController');
           
        });
    });
});
