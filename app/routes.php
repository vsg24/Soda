<?php

use Phroute\Phroute\RouteCollector;

$router = new RouteCollector();

/**
 * Define your routes after this comment!
 */

$router->get('/', ['\App\Controllers\HomeController', 'index']);
$router->any('/second', ['\App\Controllers\HomeController', 'second']);
$router->any('/error-test', ['\App\Controllers\HomeController', 'errorTest']);