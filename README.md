Andrew's Simple PHP Router
==========================

This is a skeleton of a simple router.  I've often felt that the popular MVC frameworks end up overcomplicating things-- Even after months of using them, I spend more time researching (often digging through terribly-written documentation) than actually coding.

This simply handles three parts of a typical PHP MVC framework-- Routing, autoloading, and controllers.  Everything else is up to the coder.

This is useful for small projects that don't need the enormous overhead that you'd get with the typical MVC frameworks.

Documentation is sparse right now, but you can find in-code explanations here and in routes.php and in App/SampleController.php.

One thing that's very important is that url rewriting *must* be enabled for routing to work.  This can be a pain because there are a few "gotchas" along the way, depending on the server you're using.  I'd suggest looking up how to enable url rewriting for whatever server software you're using.  The .htaccess file provided here defines rewrite rule as server.php, which loads autoload.php and routes.php.

This is currently not available in Composer.  I made this only to help in my own projects, and, unless it becomes surprisingly popular, I don't intend to submit it to composer.
