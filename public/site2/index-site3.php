<?php
/**
 * Index file
 * Intercepts all requests and dispatch routes
 *
 * @category    Erdiko
 * @package     Public
 * @copyright   Copyright (c) 2016, Arroyo Labs, www.arroyolabs.com
 * @author      John Arroyo
 */

// Bootstrap your app and erdiko
include_once dirname(dirname(__DIR__))."/app/bootstrap.php";

// Manually set the context to your site
putenv("ERDIKO_CONTEXT=site3");

try {
    $routes = Erdiko::getRoutes(getenv('ERDIKO_CONTEXT'));
    Toro::serve($routes);
    echo "<h3>This is site 3!!!!!!!</h3>";

} catch (\Exception $e) {
    echo $e->getMessage();
    // @todo return a 500 error & log error
}
