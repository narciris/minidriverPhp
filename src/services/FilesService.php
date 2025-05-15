<?php

namespace Nar\MinidriverPhp\services;

use Nar\MinidriverPhp\models\FileS3;
use Nar\MinidriverPhp\models\S3Model;

class AwsService
{

    private $model;
    private $filesModel;

    public function __construct()
    {
        $this->model = new S3Model();
        $this->filesModel = new FileS3();


    }


    public function uploadFile($file)
    {

        if (!isset($file) || $file['error'] !== 0) {
            throw new \Exception('Archivo inválido o error al subir');
        }

        $allowedTypes = ['application/pdf', 'image/jpeg', 'image/png', 'application/zip', 'application/vnd.ms-excel'];
        $maxSize = 10 * 1024 * 1024;


        if (!in_array($file['type'], $allowedTypes)) {
            throw new \Exception('Tipo de archivo no permitido');
        }

        if ($file['size'] > $maxSize) {
            throw new \Exception('Archivo demasiado grande');
        }

//        if (!isset($_SESSION['user'])) {
//            throw new \Exception('Usuario no autenticado');
//        }

        $user = $_SESSION['user'];
        $userId = $user['id'];

//        $key = $userId . '/' . basename($file['name']);
        $this->model->uploadFile($file);

    }

    public function downloadFile($key, $savePath){
        $this->model->downloadFile($key,$savePath);
    }

    public function deleteFile($key){
        $this->model->deleteFile($key);
    }

}