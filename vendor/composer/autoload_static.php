<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit58ab0714e33ffd1c87ebf6bfbee88fe8
{
    public static $prefixLengthsPsr4 = array (
        'B' => 
        array (
            'Basic\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Basic\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit58ab0714e33ffd1c87ebf6bfbee88fe8::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit58ab0714e33ffd1c87ebf6bfbee88fe8::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
