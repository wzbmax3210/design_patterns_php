<?php

/**
 * 单例应用-数据库连接
 */
class SingletonDatabase
{
    private static $_instance;
    private $_db;

    private function __construct($config = array())
    {
        $dsn = "mysql:host={$config['host']};dbname={$config['dbname']}";
        $this->_db = new PDO($dsn, $config['username'], $config['password']);
    }

    public static function getInstance($config = array())
    {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self($config);
        }

        return self::$_instance;
    }

    //获得mysql连接对象
    public function getDb()
    {
        return $this->_db;
    }

    //自定义fetchAll方法
    public function fetchAll()
    {

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

$config = array(
    'dbname' => 'zftest',
    'host' => 'localhost',
    'username' => 'root',
    'password' => ''
);

//$db1,$db2,$db3都是指向同一个对象
$db1 = SingletonDatabase::getInstance($config);

$db2 = SingletonDatabase::getInstance($config);

$db3 = SingletonDatabase::getInstance($config);
