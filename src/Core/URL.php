<?php


namespace mvc_simple_example\core;


class URL
{
    /**
     * @param string $path
     * @return string
     */

    public static function url($path='')
    {
        if(empty($path)){
            return App::get('configs/app')['HomeBase'];
        }
        return App::get('configs/app')['HomeBase'].ltrim($path,'/');
    }
}