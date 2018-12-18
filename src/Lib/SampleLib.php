<?php

namespace App\Lib;

/**
 * This is a sample library.  The Lib directory is used for any classes that you
 * need that doesn't quite fit one of the MVC categories.  (I think it's
 * technically part of the model, though.)
 *
 * @author  Andrew Norman
 */
class SampleLib
{
    /**
     * Sample function for SampleLib for SampleGreenEggs and SampleHam.
     *
     * @param   int $arg1
     * @param   int $arg2
     * @return  int
     */
    public function addSample(int $arg1, int $arg2): int
    {
        return $arg1 + $arg2;
    }
}
