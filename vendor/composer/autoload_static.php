<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitdb87113efcfe17ea823701ad53ae97ad
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/App',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitdb87113efcfe17ea823701ad53ae97ad::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitdb87113efcfe17ea823701ad53ae97ad::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitdb87113efcfe17ea823701ad53ae97ad::$classMap;

        }, null, ClassLoader::class);
    }
}
