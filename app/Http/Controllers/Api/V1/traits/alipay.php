<?php
namespace App\Http\Controllers\Api\V1\traits;
use Omnipay\Omnipay;

trait alipay{
    public function getAlipayObj(){
        $gateway = Omnipay::create('Alipay_LegacyExpress');
        $gateway->setSellerEmail(config('alipay.SellerEmail'));
        $gateway->setPartner(config('alipay.Partner'));
        $gateway->setKey(config('alipay.Key'));;
        $gateway->setReturnUrl(config('alipay.ReturnUrl'));
        $gateway->setNotifyUrl(config('alipay.NotifyUrl'));
        return $gateway;
    }
}