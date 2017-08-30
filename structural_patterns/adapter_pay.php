<?php

/**
 * 适配器模式例子-支付应用
 */

//支付宝提供的接口
class AliPay
{
    //接口提供的一些方法
    public function payMethod()
    {
        echo 'this is alipay method';
    }
}

//微信提供的接口
class WechatPay
{
    //接口提供的一些方法
    public function payMethod()
    {
        echo 'this is wechatpay method';
    }
}

//所有支付类都实现这个适配器接口
interface PayAdapter
{
    //不管第三方是什么，都实现接口pay方法，统一使用
    public function pay();
}

//支付宝适配器
class AliPayAdapter implements PayAdapter
{
    private $_aliPay;

    public function __construct(AliPay $aliPay)
    {
        $this->_aliPay = $aliPay;
    }

    public function pay()
    {
        $this->_aliPay->payMethod();
    }
}

class WechatPayAdapter implements PayAdapter
{
    private $_wechatPay;

    public function __construct(WechatPay $wechatPay)
    {
        $this->_wechatPay = $wechatPay;
    }

    public function pay()
    {
        $this->_wechatPay->payMethod();
    }
}

$aliPay = new AliPayAdapter(new AliPay());
$wechatPay = new WechatPayAdapter(new WechatPay());
$aliPay->pay();
$wechatPay->pay();
