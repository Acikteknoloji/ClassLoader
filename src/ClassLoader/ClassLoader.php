<?php namespace AcikTeknoloji;

class ClassLoader {

    protected static $directories = array();

    public static function load($class)
    {

        $class = static::normalize($class);

        foreach (static::$directories as $directory)
        {
            if (file_exists($file = $directory.DIRECTORY_SEPARATOR.$class))
            {
                require_once $file;

                return true;
            }
        }

        return false;

    }

    public static function normalize($class)
    {
        if($class[0] == "\\")
            $class = substr($class, 1);

        return str_replace(array("\\", "_"), DIRECTORY_SEPARATOR, $class).".php";
    }

    public static function register()
    {
        spl_autoload_register(array("\AcikTeknoloji\ClassLoader", "load"));
    }

    public static function addDirectories($directories)
    {
        static::$directories = array_unique(array_merge(static::$directories, (array) $directories));
    }

}