<?php

namespace Nar\MinidriverPhp\models;

use Aws\S3\S3Client;
use Nar\MinidriverPhp\core\Model;

class FileS3 extends Model
{
    protected $model = 'files';
    private $s3;
    private $bucket;

    private $config;

    public function __construct()

    {
        parent::__construct();
        $config =  require_once __DIR__ . '/../../config/awsConf.php';
        $this->bucket = $config['bucket'];
        $this->s3 = new S3Client([
            'region' => $config['region'],
            'version' => $config['version'],
            'credentials' => $config['credentials']

        ]);
    }


    public function uploadFile($filePath)
    {
        $key = uniqid() . '_' . basename($filePath['name']);
       $result = $this->s3->putObject([
            'Bucket' => $this->bucket,
            'Key' => $key,
            'SourceFile' => $filePath['tmp_name'],
            'ACL' => 'public-read'
        ]);

        return [
            'Key' => $key,
            'ObjectURL' => $result['ObjectURL']
        ];

    }

    public function downloadFile($key,$savePath)
    {
        $result = $this->s3->getObject([
            'Bucket' => $this->bucket,
            'key' =>$key,
            'saveAs' => $savePath
        ]);
    }

    public function deleteFile($key)
    {

        return $this->s3->deleteObject([
            'Bucket' => $this->bucket,
            'key' => $key
        ]);

    }






}