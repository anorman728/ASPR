<?php

/**
 * This file is used for system-wide global settings.
 *
 * If add a setting, be aware that keys are strings and settings must be scalar
 * or array.
 */

global $_SETTINGS;
global $_TEST_SETTINGS;

include_once(__DIR__ . '/unversioned_settings.php');
// Can now reference $unversioned_settings to put into $_SETTINGS.

$_SETTINGS = [
    'logfile' => __DIR__ . '/log',
    'pagename' => 'ASPR Skeleton Webpage.',
];

$_SETTINGS = array_merge($unversioned_settings, $_SETTINGS);

// In some very rare instances, want to use different settings for tests.
$_TEST_SETTINGS = [
    'pagename' => 'ASPR Test Webpage.',
];

$_TEST_SETTINGS = array_merge($unversioned_test_settings, $_TEST_SETTINGS);

/**
 * The function that retrieves the global settings.
 *
 *
 * @param   string  $key
 * @return  scalar
 */
function getSetting(string $key) {
    global $_SETTINGS;
    global $_TEST_SETTINGS;

    $useTest =
        ($GLOBALS['isTest'] ?? false) &&
        array_key_exists($key, $_TEST_SETTINGS) &&
        array_key_exists($key, $_SETTINGS) // Want it to be available in *both* settings and test settings.
    ;

    if ($useTest) {
        $returnVal = $_TEST_SETTINGS[$key];
    } else {
        $returnVal = $_SETTINGS[$key];
    }

    if (!is_scalar($returnVal) && !is_array($returnVal)) {
        throw new Exception('Setting cannot be non-scalar.  Found '
        . gettype($returnVal));
    }
    return $returnVal;
}
