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

include_once dirname(__DIR__)."/bootstrap.php";
define('ERDIKO_CONTEXT', 'default'); // switch context for multi-site abilities

try {
    $routes = Erdiko::getRoutes(ERDIKO_CONTEXT);
    Toro::serve($routes);

} catch (\Exception $e) {
    echo $e->getMessage();
    // @todo return a 500 error & log error
}
