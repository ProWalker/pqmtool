<?php

namespace PQMTool;

class Psr4AutoloaderClass
{
    function register()
    {
        spl_autoload_register(function ($class) {
            // project-specific namespace prefix
            $prefix = 'PQMTool\\';
            // base directory for the namespace prefix
            $baseDir = __DIR__ . '/';
            // does the class use the namespace prefix?
            $len = strlen($prefix);
            if (strncmp($prefix, $class, $len) !== 0) {
                // no, move to the next registred atoloader
                return;
            }
            // get the relative class name
            $relativeClass = substr($class, $len);
            // replace the namespace prefix with the base directory, replace namespace
            // separators with directory separators in the relative classs name, append
            // with .php
            $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';
            // if file exists, require it
            if (file_exists($file)) {
                require $file;
            }
        });
    }
}