<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit708f7e86bc3eb4b1be07d75d24b2af53
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInit708f7e86bc3eb4b1be07d75d24b2af53', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit708f7e86bc3eb4b1be07d75d24b2af53', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit708f7e86bc3eb4b1be07d75d24b2af53::getInitializer($loader));

        $loader->register(true);

        $includeFiles = \Composer\Autoload\ComposerStaticInit708f7e86bc3eb4b1be07d75d24b2af53::$files;
        foreach ($includeFiles as $fileIdentifier => $file) {
            composerRequire708f7e86bc3eb4b1be07d75d24b2af53($fileIdentifier, $file);
        }

        return $loader;
    }
}

/**
 * @param string $fileIdentifier
 * @param string $file
 * @return void
 */
function composerRequire708f7e86bc3eb4b1be07d75d24b2af53($fileIdentifier, $file)
{
    if (empty($GLOBALS['__composer_autoload_files'][$fileIdentifier])) {
        $GLOBALS['__composer_autoload_files'][$fileIdentifier] = true;

        require $file;
    }
}
