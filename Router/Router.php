<?php
namespace Router;

/**
 * Rudimentary routing class.
 *
 * A few notes about the controller classes:
 *  1.  They don't need to actually be controllers in an MVC style, and they
 *      don't depend on any particular MVC style.
 *  2.  They're the ones responsible for printing information to the browser
 *      (possibly by using a view class).
 *
 * @author  Andrew Norman
 */
class Router {

    /** @var string Url request */
    private $urlRequest;

    /** @var string Method */
    private $method;

    /** @var int Integer representation of method, from RouteConstants. */
    private $methodInt;

    /** @var array Routes.  (Doesn't use getters and setters.) */
    private $route;

    /** @var string Location of folder of static directory. */
    private $staticDir;

    /**
     * Set manually to true if want to throw exception if more than one route
     * matches.  If false, Router object will use the last match.  (Defaults to
     * false.)
     *
     * @var bool
     */
    public $throwExceptionOnMultipleMatches = false;


    /**
     * Setter for urlRequest.
     *
     * @param   string $input
     * @return  void
     */
    public function setUrlRequest(string $input)
    {
        $this->urlRequest = $input;
    }

    /**
     * Getter for urlRequest.
     *
     * @return  string
     */
    public function getUrlRequest(): string
    {
       return $this->urlRequest;
    }

    /**
     * Setter for route.
     *
     * @param   Route $input
     * @return  void
     */
    public function setRoute(Route $input)
    {
        if ($this->throwExceptionOnMultipleMatches && !is_null($this->route)) {
            throw new \Exception("Multiple matches for request.");
        }
        $this->route = $input;
    }

    /**
     * Getter for route.
     *
     * @return  Route
     */
    public function getRoute()
    {
       return $this->route;
    }

    /**
     * Setter for method.
     *
     * @param   string $input
     * @return  void
     */
    public function setMethod(string $input)
    {
        $this->method = $input;
        $this->setMethodIntFromString($input);
    }

    /**
     * Getter for method.
     *
     * @return  string
     */
    public function getMethod(): string
    {
       return $this->method;
    }

    /**
     * Setter for methodInt using the string representation.
     *
     * @param   string $input
     * @return  void
     */
    public function setMethodIntFromString(string $input)
    {
        switch ($input) {
            case 'GET':
                $this->methodInt = RouteConstants::METHOD_GET;
                break;
            case 'POST':
                $this->methodInt = RouteConstants::METHOD_POST;
                break;
            case 'HEAD':
                $this->methodInt = RouteConstants::METHOD_HEAD;
                break;
            case 'PUT':
                $this->methodInt = RouteConstants::METHOD_PUT;
                break;
            case 'DELETE':
                $this->methodInt = RouteConstants::METHOD_DELETE;
                break;
            default:
                throw new \Exception("Unhandled method type: $input.");
        }
    }

    /**
     * Getter for methodInt.
     *
     * @return  int
     */
    public function getMethodInt(): int
    {
       return $this->methodInt;
    }


    /**
     * Constructor
     *
     * @param   string  $urlRequest
     * @param   string  $method
     * @return  void
     */
    public function __construct(string $urlRequest, string $method)
    {
        $this->setUrlRequest($urlRequest);
        $this->setMethod($method);
    }

    /**
     * Add a get method to the routes.  (If there aren't any arguments passed
     * from browser, use this.)
     *
     * @param   string      $urlRoutePattern    Regex.  No delimiters!
     * @param   string      $controllerClass    Fully-qualified.
     * @param   string      $controllerMethod
     * @return  void
     */
    public function get(
        string $urlRoutePattern,
        string $controllerClass,
        string $controllerMethod
    ) {
        $this->setRouteHelper($urlRoutePattern, RouteConstants::METHOD_GET, $controllerClass, $controllerMethod);
    }

    /**
     * Add a post method to the routes.
     *
     * @param   string  $urlRoutePattern    Regex.  No delimiters!
     * @param   string  $controllerClass    Fully-qualified.
     * @param   string  $controllerMethod
     * @return  void
     */
    public function post(
        string $urlRoutePattern,
        string $controllerClass,
        string $controllerMethod
    ) {
        $this->setRouteHelper($urlRoutePattern, RouteConstants::METHOD_POST, $controllerClass, $controllerMethod);
    }

    /**
     * Add a head method to the routes.
     *
     * @param   string  $urlRoutePattern    Regex.  No delimiters!
     * @param   string  $controllerClass    Fully-qualified
     * @param   string  $controllerMethod
     * @return  void
     */
    public function head(
        string $urlRoutePattern,
        string $controllerClass,
        string $controllerMethod
    ) {
        $this->setRouteHelper($urlRoutePattern, RouteConstants::METHOD_HEAD, $controllerClass, $controllerMethod);
    }

    /**
     * Add a put method to the routes.
     *
     * @param   string  $urlRoutePattern    Regex.  No delimiters!
     * @param   string  $controllerClass    Fully-qualified
     * @param   string  $controllerMethod
     * @return  void
     */
    public function put(
        string $urlRoutePattern,
        string $controllerClass,
        string $controllerMethod
    ) {
        $this->setRouteHelper($urlRoutePattern, RouteConstants::METHOD_PUT, $controllerClass, $controllerMethod);
    }

    /**
     * Add a delete method to the routes.
     *
     * @param   string  $urlRoutePattern    Regex.  No delimiters!
     * @param   string  $controllerClass    Fully-qualified
     * @param   string  $controllerMethod
     * @return  void
     */
    public function delete(
        string $urlRoutePattern,
        string $controllerClass,
        string $controllerMethod
    ) {
        $this->setRouteHelper($urlRoutePattern, RouteConstants::METHOD_DELETE, $controllerClass, $controllerMethod);
    }

    /**
     * Helper function to add an arbitrary Route object to the array.
     *
     * Note: Decided not to throw exception if controller and/or action do not
     * exist, because it can be helpful to add routes now and add controllers
     * later.
     *
     * @param   string  $urlRoute
     * @param   string  $urlMethod
     * @param   string  $controllerClass
     * @param   string  $controllerMethod
     * @return  void
     * @throws  Exception                   If Route already exists.
     */
    private function setRouteHelper(
        string $urlRoutePattern,
        string $urlMethod,
        string $controllerClass,
        string $controllerMethod
    ) {
        if ($this->isMatch($urlRoutePattern) && $this->getMethodInt() == $urlMethod) {
            $this->setRoute(new Route(
                $urlRoutePattern,
                $urlMethod,
                $controllerClass,
                $controllerMethod
            ));
        }

    }

    /**
     * Add a new route directly to the routes array.  (This can be useful for
     * custom routes, extended from the route class.)
     *
     * ALL properties of the route class must be defined manually before this
     * function is used.  A route added using this method is not modified by the
     * router in any way-- Only the invoke function is used.
     *
     * @param   Router\Route    $route
     * @return  void
     */
    public function manualRoute($route) {
        if (!($route instanceof Route)) {
            throw new \Exception('A manually-added route must be an instance of route or a child-class of route.');
        }
        if ($this->isMatch($route->getUrlPattern()) && $this->getMethodInt() == $route->getMethod()) {
            $this->setRoute($route);
        }
    }

    /**
     * Invoke the action requested by the server.
     *
     * @return  void
     * @throws  Exception       If route does not exist.
     */
    public function routeMe()
    {
        if (is_null($this->getRoute())) {
            throw new \Exception("Route not found: {$this->getUrlRequest()} using {$this->getMethod()}.");
        }

        $this->getRoute()->invoke($this->getUrlRequest());

    }

    /**
     * Check if passed string is a match for this route.
     *
     * @param   string  $requestUrl
     * @return  bool
     */
    private function isMatch(string $patternUrl): bool
    {
        return ((bool) preg_match(
            ":^{$this->stripParams($patternUrl)}(/)?$:",
            $this->getUrlRequest()
        ));
    }

    /**
     * Get the url pattern with parameters replaced with non-greedy wildcards.
     *
     * @param   string      $patternUrl
     * @return  string
     */
    private function stripParams(string $patternUrl): string
    {
        $patternDumArr = explode('/', $patternUrl);
        foreach ($patternDumArr as $key => $val) {
            if (substr($val, 0, 1) == ':') {
                $patternDumArr[$key] = '.*?';
            }
        }
        $pattern = implode('/', $patternDumArr);
        return $pattern;

    }

}

