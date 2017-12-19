<?php
/**
 * 策略模式：主要用来分离算法，通过环境类来管理调用不同的策略，增加策略直接编写新的策略类
 */

//输出的接口，统一调用
interface OutputStrategy
{
    public function render($array);
}

class SerializeStrategy implements OutputStrategy
{
    public function render($array)
    {
        return serialize($array);
    }
}

class JsonStrategy implements OutputStrategy
{
    public function render($array)
    {
        return json_encode($array);
    }
}

class ArrayStrategy implements OutputStrategy
{
    public function render($array)
    {
        return $array;
    }
}

//环境类
class Output
{
    private $outputStrategy;

    //传入的参数要是策略接口或者子类
    public function __construst(OutputStrategy $outputStrategy)
    {
        $this->outputStrategy = $outputStrategy;
    }

    public function outputRender($array)
    {
        $this->outputStrategy->render($array);
    }
}

$array = ['a', 'b', 'c'];

//返回json输出
$output = new Output(new JsonStrategy());
var_dump($output->render($array));

//返回序列化输出
$output = new Output(new SerializeStrategy());
var_dump($output->render($array));
