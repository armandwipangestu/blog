<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit0d0769fd2e72b544faba1ea0187649e8
{
    public static $prefixesPsr0 = array (
        'P' => 
        array (
            'Parsedown' => 
            array (
                0 => __DIR__ . '/..' . '/erusev/parsedown',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInit0d0769fd2e72b544faba1ea0187649e8::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit0d0769fd2e72b544faba1ea0187649e8::$classMap;

        }, null, ClassLoader::class);
    }
}
