<?php

namespace Nar\MinidriverPhp\core;
class BaseController
{
    protected $model;
    protected $viewPath;

    /**
     * Constructor del controlador base
     * @param object $model Modelo asociado al controlador
     * @param string $viewPath Ruta a las vistas
     */
    public function __construct($model = null, $viewPath = 'views/') {
        $this->model = $model;
        $this->viewPath = $viewPath;
    }

    /**
     * Renderizar una vista
     * @param string $view Nombre de la vista
     * @param array $data Datos para pasar a la vista
     * @return void
     */
    protected function render($view, $data = []) {
        // Convertimos el array asociativo en variables
        extract($data);

        // Incluimos la vista
        $viewFile = $this->viewPath . $view . '.php';

        if (file_exists($viewFile)) {
            require_once $viewFile;
        } else {
            die("Vista no encontrada: {$viewFile}");
        }
    }

    /**
     * Redireccionar a otra URL
     * @param string $url URL de destino
     * @return void
     */
    protected function redirect($url) {
        header("Location: {$url}");
        exit;
    }


}