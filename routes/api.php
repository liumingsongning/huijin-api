<?php

use Illuminate\Http\Request;

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    $api->group(['namespace' => 'App\Http\Controllers\Api\V1'], function ($api) {
        $api->group(['namespace'=>'\Login'],function($api){
            $api->post('login','LoginController@login');
            $api->post('sendcode','LoginController@sendPhoneCode');
            $api->post('checkcaptcha','LoginController@checkcaptcha');
            $api->post('phonebind','LoginController@phonebind');
            $api->post('checkRepetitionPhone','LoginController@checkRepetitionPhone');
            $api->post('register','LoginController@register');
            $api->post('companyRegister','LoginController@companyRegister');
        });
        $api->group(['namespace'=>'\Goods'],function($api){
            $api->resource('goods','GoodsController');
        });
        $api->group(['middleware' => 'api.auth'],function($api){
            $api->group(['namespace'=>'\Cart'],function($api){
                $api->group(['prefix'=>'cart'],function($api){
                    $api->post('add','ShoppingCartController@add');
                    $api->post('minus','ShoppingCartController@minus');
                    $api->post('plus','ShoppingCartController@plus');
                    $api->post('remove','ShoppingCartController@remove');
                    $api->post('clear','ShoppingCartController@clear');
                    $api->get('display','ShoppingCartController@display');
                    $api->post('test','ShoppingCartController@test');
                    $api->get('getAssign','ShoppingCartController@getAssign');
                });
                $api->group(['prefix'=>'BuyNowCart'],function($api){
                    $api->resource('cart','BuyNowCartController');
                });
            });

            $api->group(['namespace'=>'\Order'],function($api){
                $api->resource('order','OrderController');
                $api->post('order/add','OrderController@add');
                $api->post('order/minus','OrderController@minus');
                $api->post('order/remove','OrderController@remove');
                $api->post('order/clear','OrderController@clear');
            });

            $api->group(['namespace'=>'\User'],function($api){
                $api->get('userinfo','UserController@userinfo');
            });
           
            $api->resource('address','Address\AddressController');

            $api->group(['namespace'=>'\Register'],function($api){
                $api->get('updateCompanyPassword','RegisterControler@updateCompanyPassword');
                $api->get('bindCompany','RegisterControler@bindCompany');
            });
           
        });
    });
});
