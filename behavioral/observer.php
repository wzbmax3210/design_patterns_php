<?php
/**
 * 观察者模式：订单例子
 * 观察者模式，也称发布-订阅模式，定义了一个被观察者和多个观察者的、一对多的对象关系。
 * 在被观察者状态发生变化的时候，它的所有观察者都会收到通知，并自动更新。
 * 观察者模式通常用在实时事件处理系统、组件间解耦、数据库驱动的消息队列系统，同时也是MVC设计模式中的重要组成部分。
 */

//被观察者接口
interface Observable
{
    //注册观察者
    public function attach(Observer $observer);
    //移除观察者
    public function detach(Observer $observer);
    //触发通知方法
    public function notify();
}

//观察者接口
interface Observer
{
    //接到通知后的处理
    public function update(Observable $observable);
}

class Order implements Observable
{
    //保存观察者状态
    private $observers = array();
    private $state;

    public function attach(Observer $observer)
    {
        $key = array_search($observer, $this->observers);
        if ($key === false) {
            $this->observers[] = $observer;
        }
    }

    public function detach(Observer $observer)
    {
        $key = array_search($observer, $this->observers);
        if ($key !== false) {
            unset($this->observers[$key]);
        }
    }

    public function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }

    //订单状态有变化时发送通知
    public function addOrder()
    {
        $this->state = 1;
        $this->notify();
    }

    //提供给观察者获取被观察者（订单）的状态
    public function getState()
    {
        return $this->state;
    }
}

/**
 * 观察者：邮件通知
 */
class Email implements Observer
{
    public function update(Observable $observable)
    {
        $state = $observable->getState();
        if ($state) {
            echo '发送邮件：下订单成功！';
        } else {
            echo '发送邮件：下订单失败！';
        }
    }
}

/**
 * 观察者：短信通知
 */
class Message implements Observer
{
    public function update(Observable $observable)
    {
        $state = $observable->getState();
        if ($state) {
            echo '发送短信：下订单成功！';
        } else {
            echo '发送短信：下订单失败！';
        }
    }
}

/**
 * 观察者：记录日志
 */
class Log implements Observer
{
    public function update(Observable $observable)
    {
        echo '生成一个日志记录';
    }
}

//创建被观察者对象：订单对象
$order = new Order();
//创建观察者对象：邮件对象，短信对象，日志对象
$email = new Email();
$message = new Message();
$log = new Log();
//注册观察者
$order->attach($email);
$order->attach($message);
$order->attach($log);
$order->addOrder(); //添加订单，会通知到所有观察者

echo '<br/>';

$order->detach($log); //移除观察者：日志对象
$order->addOrder();

//新增观察者创建一个新的类
class Alert implements Observer
{
    public function update(Observable $observable)
    {
        echo '系统消息：您的订单有更新了！';
    }
}

$alert = new Alert();
$order->attach($alert);
