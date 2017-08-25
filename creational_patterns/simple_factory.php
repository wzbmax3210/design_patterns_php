<?php

/**
 * simple factory design pattern
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