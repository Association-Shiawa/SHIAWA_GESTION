<?php

/**
 * Cette classe permet d'importer de manière automatisée les classes dans le projet
 *
 * @author moule
 */
class Autoloader
{
    public static function register()
    {
        spl_autoload_register(function ($class) {
            $file = __DIR__."/".$class.'.class.php';
            if (file_exists($file)) {
                require $file;
                return true;
            }
            return false;
        });
    }
}
