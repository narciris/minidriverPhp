<?php

require __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

echo "AWS_ACCESS_KEY: " . ($_ENV['AWS_ACCESS_KEY_ID'] ?? 'no definido') . "\n";
echo "AWS_SECRET_ACCESS_KEY: " . ($_ENV['AWS_SECRET_ACCESS_KEY'] ?? 'no definido') . "\n";
echo "AWS_BUCKET: " . ($_ENV['AWS_BUCKET'] ?? 'no definido') . "\n";
