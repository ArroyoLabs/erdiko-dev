<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit0867795aaa1f622a1792d192a7a528f6
{
    public static $prefixLengthsPsr4 = array (
        'e' => 
        array (
            'erdiko\\wordpress\\' => 17,
            'erdiko\\core\\' => 12,
        ),
        'P' => 
        array (
            'Psr\\Log\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'erdiko\\wordpress\\' => 
        array (
            0 => __DIR__ . '/..' . '/erdiko/wordpress/src',
        ),
        'erdiko\\core\\' => 
        array (
            0 => __DIR__ . '/..' . '/erdiko/core/src',
        ),
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
    );

    public static $prefixesPsr0 = array (
        'P' => 
        array (
            'Parsedown' => 
            array (
                0 => __DIR__ . '/..' . '/erusev/parsedown',
            ),
        ),
        'M' => 
        array (
            'Mustache' => 
            array (
                0 => __DIR__ . '/..' . '/mustache/mustache/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit0867795aaa1f622a1792d192a7a528f6::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit0867795aaa1f622a1792d192a7a528f6::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit0867795aaa1f622a1792d192a7a528f6::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}