<?php /** @noinspection PhpIncludeInspection */

if (!file_exists($file = __DIR__ . '/../vendor/autoload.php')) {
    throw new RuntimeException('Install dependencies to run this script.');
} else {
    require_once $file;
}

use Soda\Core\Presentation\View;
use Illuminate\Database\Capsule\Manager as Capsule;

// setup Illuminate\Database
$capsule = new Capsule;
$capsule->addConnection([
    "driver" => SQL_DB_DRIVER_TYPE,
    "host" => SQL_DB_HOST,
    "database" => "acl",
    "username" => SQL_DB_USERNAME,
    "password" => SQL_DB_PASSWORD
]);
// make this Capsule instance available globally.
$capsule->setAsGlobal();
// setup the Eloquent ORM.
$capsule->bootEloquent();
//

/**
 * Load the required configuration file
 */
if (!file_exists($file = __DIR__ . '/../app.config.php')) {
    throw new RuntimeException('The main.php config file must exist in /config');
} else {
    require_once $file;
    if(PRETTY_ERROR_PAGES && ENVIRONMENT == 'dev') {
        $whoops = new \Whoops\Run;
        $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
        if (Whoops\Util\Misc::isAjaxRequest()) {
            $whoops->pushHandler(new \Whoops\Handler\JsonResponseHandler);
        }
        $whoops->register();
    }
}

if(!file_exists(PROJECT_ROOT_ABS_PATH . '/wwwroot/cache')) {
    mkdir(PROJECT_ROOT_ABS_PATH . '/wwwroot/cache');
}
require_once PROJECT_ROOT_ABS_PATH . '/app/utils/helpers.php';

@ini_set("suhosin.session.cryptdocroot", "Off");
@ini_set("suhosin.cookie.cryptdocroot", "Off");
@ini_set("session.cookie_domain", "." . MAIN_DOMAIN);
@session_start();

if(!GZIP_ENABLED || !ob_start("ob_gzhandler")) ob_start();

/**
 * Capture incoming requests, extract request parameters
 */
$request = Symfony\Component\HttpFoundation\Request::createFromGlobals();
$view = new View();

/**
 * Routes and routing config
 */
require_once PROJECT_ROOT_ABS_PATH . '/app/routes.php';
$dispatcher = new Phroute\Phroute\Dispatcher($router->getData());
try
{
    $response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
} catch (Phroute\Phroute\Exception\HttpRouteNotFoundException $e) {
    // not found
    header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
    die($view->getViewEngineInstance()->render('error.404'));
} catch (\Exception $e) {
    // server error
    if(PRETTY_ERROR_PAGES && ENVIRONMENT == 'prod') {
        header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error');
        die($view->getViewEngineInstance()->render('error.500'));
    } else {
        throw $e;
    }
}

/**
 * Flush the output
 */
@ob_flush();