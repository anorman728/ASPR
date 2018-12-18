<?php

spl_autoload_register('default_autoload');

function default_autoload ($classname) {
    // If the class were already loaded.  Should not happen.
    if (class_exists($classname)) {
        return true;
    }

    // Replace 'App' with 'src'.
    if (substr($classname, 0, 3) == 'App') {
        $classname = 'src' . substr($classname, 3);
    }
    // Replace 'Test' with 'tests'
    if (substr($classname, 0, 4) == 'Test') {
        $classname = 'tests' . substr($classname, 4);
    }

    // Works for PEAR style class names and namespaced class names
    $path = str_replace(
        '\\',
        '/',
        $classname
    ) . '.php';

    if (file_exists(__DIR__ . "/$path")) {
        include_once $path;
        return true;
    }

    return false;
}

include_once(__DIR__ . '/vendor/autoload.php');
