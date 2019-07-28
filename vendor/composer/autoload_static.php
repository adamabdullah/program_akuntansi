<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7d10d934babcaf26f03991c41914ec87
{
    public static $prefixLengthsPsr4 = array (
        'R' => 
        array (
            'Rakit\\Validation\\' => 17,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Rakit\\Validation\\' => 
        array (
            0 => __DIR__ . '/..' . '/rakit/validation/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit7d10d934babcaf26f03991c41914ec87::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7d10d934babcaf26f03991c41914ec87::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
