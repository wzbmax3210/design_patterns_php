<?php

/**
 * 单例设计模式
 */
class Singleton
{
    private static $instance = null;

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function __construct()
    {
        var_dump('this is singleton instance');
    }

    private function __clone()
    {

    }

    private function __wakeup()
    {

    }
}

$instance = Singleton::getInstance();