<?php
// Everything needed for phpunit bootstrapping.

// Almost never add anything to GLOBALS.
$GLOBALS['isTest'] = true;

include_once(__DIR__ . '/settings.php');

include_once(__DIR__ . '/commonfunctions.php');

include_once(__DIR__ . '/autoload.php');
