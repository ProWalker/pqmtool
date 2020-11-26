<?php

namespace Nik;

class Psr4AutoloaderClass
{
    function register()
    {
        spl_autoload_register(function ($class) {
            // print_r($class . "\n");
            // project-specific namespace prefix
            $prefix = 'Nik\\';
            // base directory for the namespace prefix
            $baseDir = __DIR__ . '/';
            // print_r($baseDir . "\n");
            // does the class use the namespace prefix?
            $len = strlen($prefix);
            if (strncmp($prefix, $class, $len) !== 0) {
                // no, move to the next registred atoloader
                return;
            }
            // get the relative class name
            $relativeClass = substr($class, $len);
            // print_r($relativeClass . "\n");
            // replace the namespace prefix with the base directory, replace namespace
            // separators with directory separators in the relative classs name, append
            // with .php
            $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';
            // print_r($file . "\n");
            // if file exists, require it
            if (file_exists($file)) {
                require $file;
            }
        });
    }
}