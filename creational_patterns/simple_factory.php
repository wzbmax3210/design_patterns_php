<?php

/**
 * 简单工厂
 */
class SimpleFactory
{
    /**
     * @description
     * @author wuzhibo
     * @param null $className
     * @return null
     */
    public static function build($className = null)
    {
        if ($className && class_exists($className)) {
            return new $className();
        }

        return null;
    }
}

//$object = SimpleFactory::build($className);