<?php

namespace Nar\MinidriverPhp\core;
class Router
{
    private $controller;
    private $method;
    private $params = [];

    public function __construct()
    {
        $url = $this->parseUrl();

        if (isset($url[0]) && file_exists(CONTROLLERS_PATH . ucfirst($url[0]) . 'Controller.php')) {
            $controllerName = ucfirst($url[0]) . 'Controller';
        } else {
            $controllerName = 'HomeController';
        }

        $controllerClass = 'Nar\\MinidriverPhp\\app\\controllers\\' . $controllerName;
        $this->controller = new $controllerClass();


        $this->controller = new $this->controller();

        /**
         * DEterminar el metodo y establecer metodo por defecto
         */
        if (isset($url[1]) && method_exists($this->controller, $url[1])) {
            $this->method = $url[1];
            unset($url[1]);
        } else {

            $this->method = 'index';
        }

        $this->params = $url ? array_values($url) : [];
    }

    public function run()
    {
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    private function parseUrl()
    {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
        return [];
    }
}