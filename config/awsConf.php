<?php

namespace config;

class awsConf
{

    public function getKeys()
    {
        return [
            'credentials' => [
                'key'    => getenv('AWS_ACCESS_KEY_ID') ?? '',
                'secret' => $_ENV['AWS_SECRET_ACCESS'] ?? '',
            ],
            'region' =>getenv('AWS_REGION') ?? 'us-east-1',
            'version' => 'latest',
            'bucket' => getenv('AWS_BUCKET') ?? ''
        ];

    }

}