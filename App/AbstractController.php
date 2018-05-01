<?php
namespace App;

/**
 * This is an abstract class that should be the parent class of all controllers.
 *
 * @author  Andrew Norman
 */
class AbstractController {

    private $methodArgs;

    private $urlString;

    /**
     * Get method args.
     */
    public function getMethodArgs()
    {
        return $this->methodArgs;
    }

    /**
     * Set method args.
     *
     * @return  void
     */
    public function setMethodArgs($testArr)
    {
        $this->methodArgs = $testArr;
    }

    /**
     * Setter for urlString.
     *
     * @param   string $input
     * @return  void
     */
    public function setUrlString(string $input)
    {
        $this->urlString = $input;
    }

    /**
     * Getter for urlString.
     *
     * @return  string
     */
    public function getUrlString(): string
    {
       return $this->urlString;
    }

}

