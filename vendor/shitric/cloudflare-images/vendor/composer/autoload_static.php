<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2e5f80f6b79efe7c0a3c151ed22a2852
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Shitric\\CloudFlare\\' => 19,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Shitric\\CloudFlare\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit2e5f80f6b79efe7c0a3c151ed22a2852::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit2e5f80f6b79efe7c0a3c151ed22a2852::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit2e5f80f6b79efe7c0a3c151ed22a2852::$classMap;

        }, null, ClassLoader::class);
    }
}