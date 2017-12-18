<?php

/**
 * 单例设计模式
 */
class Singleton
{
    private static $instance = null;

    private function __construct()
    {
        var_dump('this is singleton instance');
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    //声明私有方法，禁止克隆对象
    private function __clone()
    {

    }

    //声明私有方法，禁止重建对象
    private function __wakeup()
    {

    }
}
