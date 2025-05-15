<?php

namespace Nar\MinidriverPhp\services;

use Nar\MinidriverPhp\dtos\FileRequestDto;
use Nar\MinidriverPhp\models\FileS3;

class FilesService
{

    private $model;

    public function __construct()
    {
        $this->model = new FileS3();


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

      $result =  $this->model->uploadFile($file);
        $dto = new FileRequestDto();
        $dto->setName($file['name']);
        $dto->setType($file['type']);
        $dto->setPath($result['ObjectURL']);
        $dto->setStorageType('s3');
        $dto->setUserId($userId);


        $this->model->save($dto);
        return $result;

    }

    public function downloadFile($key, $savePath){
        $this->model->downloadFile($key,$savePath);
    }

    public function deleteFile($key){
        $this->model->deleteFile($key);
    }

}