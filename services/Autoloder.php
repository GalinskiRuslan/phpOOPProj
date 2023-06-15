<?php
class Autoloder
{
    private $dir = [
        'modules', 'services'
    ];
    public function loadClass($className)
    {
        /* foreach ($this->dir as $dir) {
            $file = dirname(__DIR__) . '/' . $dir . '/' . $className . '.php';
            
        } */
        $file = str_replace(['App\\', '\\'], [dirname(__DIR__) . '/', '/'], $className . '.php');
        if (file_exists($file)) {
            include_once $file;
            return;
        }
    }
}
