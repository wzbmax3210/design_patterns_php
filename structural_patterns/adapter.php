<?php

/**
 * 适配器模式
 */

/**
 * 应用类
 */
class Sample
{
    //向外提供的方法，可能伴随更新而改变
    public function sampleMethod()
    {
        echo '应用的方法';
    }
}

/**
 * 应用适配器接口
 */
interface Adapter
{
    public function adapterMethod();
}

/**
 * 适配器类，调用该类获得应用方法，应用方法更新做出修改，在该类就该即可
 */
class SimpleAdapter implements Adapter
{
    private $_adapter;

    public function __construct(Sample $sample)
    {
        $this->_adapter = $sample;
    }

    public function adapterMethod()
    {
        $this->_adapter->sampleMethod();
    }
}

$sampleAdapter = new SimpleAdapter(new Sample);
$sampleAdapter->adapterMethod();