<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite79e38a4d679e9b073e3c4905a4d6f05
{
    public static $prefixLengthsPsr4 = array (
        'Y' => 
        array (
            'YallowCom\\WhatsappApi\\' => 22,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'YallowCom\\WhatsappApi\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInite79e38a4d679e9b073e3c4905a4d6f05::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite79e38a4d679e9b073e3c4905a4d6f05::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInite79e38a4d679e9b073e3c4905a4d6f05::$classMap;

        }, null, ClassLoader::class);
    }
}
