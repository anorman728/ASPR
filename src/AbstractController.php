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

    private $layout = '/Layouts/default';

    private $layoutVars = [];

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

    /**
     * Setter for layout.
     *
     * @param   string $input
     * @return  void
     */
    public function setLayout(string $input)
    {
        $this->layout = $input;
    }

    /**
     * Getter for layout.
     *
     * @return  string
     */
    public function getLayout(): string
    {
       return $this->layout;
    }
    /**
     * Setter for layoutVars.
     *
     * @param   array $input
     * @return  void
     */
    public function setLayoutVars(array $input)
    {
        $this->layoutVars = $input;
    }

    /**
     * Getter for layoutVars.
     *
     * @return  array
     */
    public function getLayoutVars(): array
    {
       return $this->layoutVars;
    }


    /**
     * Get file data into variable, as if include had an output.
     *
     * @param   string      $filename
     * @param   array       $vars       Variables to pass to file.
     * @return  string
     */
    protected function pullView(string $filename, array $vars = []): string
    {
        ob_start();
        require(__DIR__ . "$filename.php");
        return ob_get_clean();
    }

    /**
     * Print body (as input) using the defined layout.
     *
     * Layout is defined on a per-class basis and defaults to defaultlayout.php.
     *
     * This uses layoutVars, common values to appear in every page.
     * SetLayoutVars can be called from the child class's constructor (or
     * anywhere, really).
     *
     * @param   string      $body
     * @return  void
     */
    protected function printToLayout(string $body)
    {
        $vars = array_merge(['body' => $body], $this->getLayoutVars());
        $html = $this->pullView($this->getLayout(), $vars);
        print_r($html);
    }

}

