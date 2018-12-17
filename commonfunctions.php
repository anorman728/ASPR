<?php

/**
 * This script is loaded before everything except appsettings.php, including
 * autoload.php.  It adds useful functions, but should be added to sparingly to
 * avoid polluting the global namespace.
 */

/**
 * Log a value to the logfile (the path of which is defined in appsettings.php.
 *
 * @param   variant     $value
 * @param   string|null $name   Optional.  Won't print it if there isn't one.
 * @return  void
 */
function logIt($value, ?string $name = null) {
    logIt_Print("----" . (new DateTime())->format('Y-m-d H:i:s'), false);

    if (!is_null($name)) {
        logIt_Print('Name: ' . $name);
    }

    $type = is_object($value) ?  get_class($value) : gettype($value);
    logIt_Print('Type: ' . $type);

    logIt_Print('Value: ' . print_r($value, true));

    logIt_Print("----", false);
}


// Helper functions below this line.

/**
 * Helper function for logIt.
 *
 * @param   string      $value
 * @param   bool        $indent     Defaults to true.
 * @return  void
 */
function logIt_Print(string $value, bool $indent = true) {
    if ($indent) {
        $value = '    ' . $value;
    }
    file_put_contents(getSetting('logfile'), "\n" . $value, FILE_APPEND);
}
