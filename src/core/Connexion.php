<?php

namespace Nar\MinidriverPhp\core;
use Dotenv;

class Connexion
{
    public static $pdo;

    public function __construct()
    {

    }

    public static function getConnexion()
    {
        if (!self::$pdo) {
            $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
            $dotenv->load();

            $dbname = $_ENV['MYSQL_DATABASE'];
            $user = $_ENV['MYSQL_USER'];
            $pass = $_ENV['MYSQL_PASSWORD'];
            $host = $_ENV['MYSQL_HOST'];
            $charset = 'utf8';

            $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

            try {
                self::$pdo = new \Nar\MinidriverPhp\app\core\PDO($dsn, $user, $pass);
                self::$pdo->setAttribute(\Nar\MinidriverPhp\app\core\PDO::ATTR_ERRMODE, \Nar\MinidriverPhp\app\core\PDO::ERRMODE_EXCEPTION);
            } catch (\Nar\MinidriverPhp\app\core\PDOException $e) {
                die("Error de conexión: " . $e->getMessage());
            }
        }

        return self::$pdo;
    }

}