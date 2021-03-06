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
            $api->resource('unique','UniqueController');
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
                $api->get('orderGoodgetUniqueGood','OrderController@orderGoodgetUniqueGood');
            });

            $api->group(['namespace'=>'\User'],function($api){
                $api->get('userinfo','UserController@userinfo');
            });
           
            $api->group(['namespace'=>'\UniqueGoodMarket'],function($api){
                $api->post('resale\publish','UniqueGoodMarketController@publish');
                $api->resource('uniqueGoodMartet','UniqueGoodMarketController');
            });
           
            $api->resource('address','Address\AddressController');
            $api->resource('UserCreditedAccount','UserCreditedAccount\UserCreditedAccountController');
            $api->get('ownerCreditedAccount','UserCreditedAccount\UserCreditedAccountController@ownerCreditedAccount');

            $api->group(['namespace'=>'\Register'],function($api){
                $api->post('updateCompanyPassword','RegisterController@updateCompanyPassword');
                $api->post('bindCompany','RegisterController@bindCompany');
            });

            $api->group(['namespace'=>'\Qiniu'],function($api){
                $api->post('base64Upload','QiniuController@base64Upload');
                $api->post('upload','QiniuController@upload');
            });
           
        });
    });
});
