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

        $allowedTypes =
            [
            'application/pdf',
            'image/jpeg',
            'image/png',
            'application/zip',
            'application/vnd.ms-excel'
            ];
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

    public function deleteFile($key, int $id){
        $fileS3 =$this->model->deleteFile($key);
        if(!$fileS3){
            throw new \Exception("Error al eliminar archivo");
        }
        //buscar por id la file
        $file = $this->model->findById($id);
        if(!$file){
            throw new \Exception("Archivo no encontrado");
        }
        $this->model->delete($id);
        return $file;
    }


    public function uploadLocal(string $directory)
    {
        if (!isset($_FILES['file']['name']) || !isset($_FILES['file']['tmp_name'])) {
            throw new \Exception("Archivo inválido", 400);
        }


        $fileExtension = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
        $directory = $this->getDirectoryByExtension($fileExtension);

        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        $fileName = time() . '_' . basename($_FILES['file']['name']);
        $filePath = $directory . '/' . $fileName;



        if (move_uploaded_file($_FILES['file']['tmp_name'], $filePath)) {
            return $filePath;
        }

        throw new \Exception("Error al subir el archivo", 500);

    }


    private $directories =  [
        'images' => 'uploads/images/',
        'pdf' => 'uploads/pdf/',
        'excel' => 'uploads/excel/',
        'others' => 'uploads/others/',

    ];


    private function getDirectoryByExtension($extension)
    {
       if(in_array($extension,['jpg','jpeg','png','gif','bdm','svg'])){
          return $this->directories['images'];
       }elseif ($extension === 'pdf'){
           return $this->directories['pdf'];
       } elseif (in_array($extension, ['xls', 'xlsx', 'csv'])){
           return $this->directories['excel'];
       } else{
           return $this->directories['others'];
       }

    }

    public function deleteLocal($file,$id)
    {

    }



}