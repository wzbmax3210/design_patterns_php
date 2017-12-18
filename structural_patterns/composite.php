<?php

/**
 * 组合模式，文件对象例子
 */

/**
 * 规范独立对象和组合对象一定要实现的方法，保证对象有统一的访问方式
 */
abstract class FileSystem
{
    protected $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public abstract function getName();
    public abstract function getSize();
    //安全模式：接口中不提供add和remove方法，组合对象和独立对象没有统一的接口实现，要在客户端进行判断
    //透明模式：接口中提供add和remove方法，使独立对象和组合对象有统一的接口实现，但是独立对象不具备add与remove功能，实现没有意义
    //public abstract function add();
    //public abstract function remove();
}

/**
 * 组合对象：目录类
 */
class Dir extends FileSystem
{
    protected $fileSystems = array();

    //组合对象必须实现add方法
    public function add(FileSystem $fileSystem)
    {
        $key = array_search($fileSystem, $this->fileSystems);
        if ($key === FALSE) {
            $this->fileSystems[] = $fileSystem;
        }
    }

    //组合对象必须实现remove方法
    public function remove(FileSystem $fileSystem)
    {
        $key = array_search($fileSystem, $this->fileSystems);
        if ($key !== FALSE) {
            unset($this->fileSystems[$key]);
        }
    }

    public function getName()
    {
        return '目录：' . $this->name;
    }

    //计算下面所有独立对象的大小总和
    public function getSize()
    {
        $size = 0;
        foreach ($this->fileSystems as $fileSystem) {
            $size += $fileSystem->getSize();
        }

        return $size;
    }
}

/**
 * 独立对象：文本文件类
 */
class TextFile extends FileSystem
{
    public function getName()
    {
        return '文本文件：' . $this->name;
    }

    public function getSize()
    {
        return 10;
    }
}

/**
 * 独立对象：图片文件类
 */
class PhotoFile extends FileSystem
{
    public function getName()
    {
        return '图片文件：' . $this->name;
    }

    public function getSize()
    {
        return 20;
    }
}

/**
 * 独立对象：文本文件类
 */
class VideoFile extends FileSystem
{
    public function getName()
    {
        return '视频文件：' . $this->name;
    }

    public function getSize()
    {
        return 100;
    }
}

/**
 * 我们创建诸如这样的文件系统
    home
    ├─text.txt
    ├─test.png
    ├─test.mp4
    ├─source
    │  ├─text2.txt
 */
$homeDir = new Dir('home');
$homeDir->add(new TextFile('text.txt'));
$homeDir->add(new PhotoFile('test.png'));
$homeDir->add(new VideoFile('test.mp4'));
$sourceDir = new Dir('source');
$sourceDir->add(new TextFile('text2.txt'));
echo $homeDir->getName() . ' 大小：' . $homeDir->getSize(); //得到home目录大小
echo '<br/>';
echo $sourceDir->getName() . ' 大小：' . $sourceDir->getSize(); //得到home目录大小
