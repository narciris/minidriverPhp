<?php

define('BASE_PATH', __DIR__);
#punto de entrada principal de la aplicacion
if (file_exists(BASE_PATH . '/vendor/autoload.php')) {
    require_once BASE_PATH . '/vendor/autoload.php';
}
use Dotenv\Dotenv;
use Nar\MinidriverPhp\core\Router;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();
foreach ($_ENV as $key => $value) {
    putenv("$key=$value");
}
require_once BASE_PATH . '/src/core/Config.php';
require_once BASE_PATH . '/src/core/Router.php';




$router = new Router();
$router->run();
