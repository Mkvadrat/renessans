<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit011f1d2c05ab24e4c40584e35d911d00
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'CBR\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'CBR\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit011f1d2c05ab24e4c40584e35d911d00::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit011f1d2c05ab24e4c40584e35d911d00::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}