<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitae23d34fdaa77ce4fce34befc89014d0
{
    public static $prefixLengthsPsr4 = array (
        'a' => 
        array (
            'app\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitae23d34fdaa77ce4fce34befc89014d0::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitae23d34fdaa77ce4fce34befc89014d0::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitae23d34fdaa77ce4fce34befc89014d0::$classMap;

        }, null, ClassLoader::class);
    }
}
