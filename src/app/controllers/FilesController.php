<?php

namespace Nar\MinidriverPhp\app\controllers;

use Nar\MinidriverPhp\core\BaseController;
use Nar\MinidriverPhp\services\FilesService;

class AwsController extends  BaseController
{

    private $service;
    public function __construct()
    {
        $this->service = new FilesService();
    }

    public function upload(){
        if($_SERVER['REQUEST_METHOD'] !== 'POST'){
            throw new \Exception('Request method must be POST');
        }
        try{
           $this->service->uploadFile($_FILES['file']);
          $this->jsonSuccess(['file' => $_FILES['file']]);
        }catch (\Exception $e){
            $this->jsonError($e->getMessage());
        }
    }

}