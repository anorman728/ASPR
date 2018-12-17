<?php

// Namespaces are handled by autoload.php.
use Router\Router;

// It's unlikely that you'll want to change this.
$router = new Router($_SERVER['REDIRECT_URL'], $_SERVER['REQUEST_METHOD']);

// Below, we're defining routes.

// This routes the root directory to the "home" method of "App\SampleController."
// There is nothing passed from the browser, so we'll use a GET instead of a POST.
$router->get('/', 'App\SampleController', 'home');

// This routes a POST request to the sample controller.  It won't work without a
// POST request.
$router->post('/postMethod', 'App\SampleController', 'postMethod');

// This routes an argument in the URL to the controller method.
$router->get('/usingAnArgument/:arg', 'App\SampleController', 'usingAnArgument');

// This routes to an action that logs something.
$router->get('/loggingSomething', 'App\SampleController', 'loggingSomething');

// These three examples should get you started.  In addition to "get" and
// "post", you can use the "head", "put", and "delete" http methods.

// Lastly, you can add an instance of the route class manually using
// $router->manualRoute($routeObj).  This would be useful if you want to extend
// the route class and use a specially-customized route to the router.

// But what about static files?  You can disable url-rewriting in a particular
// folder by putting an .htaccess file in that folder that contains
// "RewriteEngine off."  The "static" folder here is an example.  In this
// folder, I can put, say, 'HatersGonnaHate.gif', and then reach it in the
// browser with example.com/static/HatersGonnaHate.gif.'

try {
    $router->routeMe();
} catch (\Throwable $t) {
    // We can put any failure logic here that we like.  In this case, I'll just
    // print out the exception so I can see it.
    print_r("<pre>");
    print_r($t);
    print_r("</pre>");
}
