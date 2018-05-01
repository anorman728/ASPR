<?php

spl_autoload_register('default_autoload');

function default_autoload ($classname) {
    // if the class where already loaded. should not happen
    if (class_exists($classname)) {
        return true;
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
