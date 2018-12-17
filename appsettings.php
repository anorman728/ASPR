<?php

/**
 * This file is used for system-wide global settings.
 *
 * If add a setting, be aware that keys are strings and settings must be scalar.
 */

$_SETTINGS = [
    'logfile' => __DIR__ . '/log',
];

/**
 * The function that retrieves the global settings.
 *
 *
 * @param   string  $key
 * @return  scalar
 */
function getSetting(string $key) {
    global $_SETTINGS;
    $returnVal = $_SETTINGS[$key];
    if (!is_scalar($returnVal)) {
        throw new Exception('Setting cannot be non-scalar.  Found '
        . gettype($returnVal));
    }
    return $returnVal;
}
