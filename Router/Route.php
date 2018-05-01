<?php
namespace Router;

/**
 * Route class.
 *
 * @author  Andrew Norman
 */
class Route {

    /** @var string Url regex, *without* the pattern delimiter. */
    private $urlPattern;

    /** @var int Method constant, from RouteConstants.php */
    private $method;

    /** @var string Fully-qualified classname for route to implement. */
    private $controllerClass;

    /** @var string Name action to implement. */
    private $controllerAction;


    /**
     * Setter for urlPattern.
     *
     * @param   string $input
     * @return  void
     */
    public function setUrlPattern(string $input)
    {
        $this->urlPattern = $input;
    }

    /**
     * Getter for urlPattern.
     *
     * @return  string
     */
    public function getUrlPattern(): string
    {
       return $this->urlPattern;
    }

    /**
     * Setter for method.
     *
     * @param   int $input
     * @return  void
     */
    public function setMethod(int $input)
    {
        $this->method = $input;
    }

    /**
     * Getter for method.
     *
     * @return  int
     */
    public function getMethod(): int
    {
       return $this->method;
    }

    /**
     * Setter for controllerClass.
     *
     * @param   string $input
     * @return  void
     */
    public function setControllerClass(string $input)
    {
        $this->controllerClass = $input;
    }

    /**
     * Getter for controllerClass.
     *
     * @return  string
     */
    public function getControllerClass(): string
    {
       return $this->controllerClass;
    }

    /**
     * Setter for controllerAction.
     *
     * @param   string $input
     * @return  void
     */
    public function setControllerAction(string $input)
    {
        $this->controllerAction = $input;
    }

    /**
     * Getter for controllerAction.
     *
     * @return  string
     */
    public function getControllerAction(): string
    {
       return $this->controllerAction;
    }


    /**
     * Constructor
     *
     * @param   string  $controllerClass    With fully-qualified namespace.
     * @param   string  $controllerAction
     * @return  void
     */
    public function __construct(
        string $urlPattern,
        string $urlMethod,
        string $controllerClass,
        string $controllerAction
    ) {
        $this->setUrlPattern($urlPattern);
        $this->setMethod($urlMethod);
        $this->setControllerClass($controllerClass);
        $this->setControllerAction($controllerAction);
    }

    /**
     * Get the method arguments (like get, post, etc.)
     *
     * @return  array
     */
    private function getMethodArgs(): array
    {
        if (is_null($this->getMethod())) {
            throw new \Exception("Internal error: Method cannot be null.");
        }
        parse_str(file_get_contents("php://input"), $output);
        return $output;
    }

    /**
     * Invoke the command with the expected args.
     *
     * @param   string  $urlRequest     Actual URL request.
     * @return  void
     */
    public function invoke($urlRequest)
    {
        $controllerClass = $this->getControllerClass();
        $controller = new $controllerClass();
        $controller->setMethodArgs($this->getMethodArgs());
        $controller->setUrlString($urlRequest);
        call_user_func_array(
            [$controller, $this->getControllerAction()],
            $this->getParams($urlRequest)
        );

    }

    /**
     * Extract parameters from a given request.
     *
     * @param   string  $urlRequest
     * @return  array
     */
    private function getParams(string $urlRequest)
    {
        // Get the params from the url.
        $patternUrlArr = explode('/', $this->getUrlPattern());
        $requestUrlArr = explode('/', $urlRequest);
        $params = [];
        foreach ($patternUrlArr as $key => $val) {
            if (substr($val, 0, 1) == ':') {
                $params[] = $requestUrlArr[$key];
            }
        }

        return $params;

    }

}

