<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2b9899a0dcc0e85e6c405bb11e1fc011
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Core\\' => 5,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Core\\' => 
        array (
            0 => __DIR__ . '/../..' . '/core',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit2b9899a0dcc0e85e6c405bb11e1fc011::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit2b9899a0dcc0e85e6c405bb11e1fc011::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
