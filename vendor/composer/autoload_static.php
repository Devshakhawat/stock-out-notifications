<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit422b02faa40de496e4867294c4deb453
{
    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'Wpcommerz\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Wpcommerz\\' => 
        array (
            0 => __DIR__ . '/../..' . '/includes',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit422b02faa40de496e4867294c4deb453::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit422b02faa40de496e4867294c4deb453::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit422b02faa40de496e4867294c4deb453::$classMap;

        }, null, ClassLoader::class);
    }
}
