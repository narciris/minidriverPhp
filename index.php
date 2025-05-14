<?php

#punto de entrada principal de la aplicacion

use Nar\MinidriverPhp\core\Router;

define('BASE_PATH', __DIR__);

if (file_exists(BASE_PATH . '/vendor/autoload.php')) {
    require_once BASE_PATH . '/vendor/autoload.php';
}
require_once BASE_PATH . '/src/core/Config.php';
require_once BASE_PATH . '/src/core/Router.php';




$router = new Router();
$router->run();
