<?php

namespace Nar\MinidriverPhp\app\controllers;

use Nar\MinidriverPhp\core\BaseController;
use Nar\MinidriverPhp\services\FilesService;

class FilesController extends  BaseController
{

    private $service;
    public function __construct()
    {
        $this->service = new FilesService();
    }

    public function upload(){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if($_SERVER['REQUEST_METHOD'] !== 'POST'){
            throw new \Exception('Request method must be POST');
        }
        error_log(print_r($_FILES, true));

        try{
           $this->service->uploadFile($_FILES['file']);
          $this->jsonSuccess(['file' => $_FILES['file']]);
        }catch (\Exception $e){
            $this->jsonError($e->getMessage());
        }
    }

}