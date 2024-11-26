<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit01f9912bb3eae28d7d969bffd4e95edb
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PhpOffice\\PhpWord\\' => 18,
            'PhpOffice\\Math\\' => 15,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PhpOffice\\PhpWord\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpoffice/phpword/src/PhpWord',
        ),
        'PhpOffice\\Math\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpoffice/math/src/Math',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit01f9912bb3eae28d7d969bffd4e95edb::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit01f9912bb3eae28d7d969bffd4e95edb::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit01f9912bb3eae28d7d969bffd4e95edb::$classMap;

        }, null, ClassLoader::class);
    }
}
