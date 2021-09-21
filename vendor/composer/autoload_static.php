<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd28b8a72375a2f7fd041557dc02a2677
{
    public static $prefixLengthsPsr4 = array (
        'R' => 
        array (
            'Runone\\SqlMonitor\\' => 18,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Runone\\SqlMonitor\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd28b8a72375a2f7fd041557dc02a2677::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd28b8a72375a2f7fd041557dc02a2677::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitd28b8a72375a2f7fd041557dc02a2677::$classMap;

        }, null, ClassLoader::class);
    }
}
