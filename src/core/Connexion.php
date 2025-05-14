<?php

namespace Nar\MinidriverPhp\core;
use Dotenv;
use PDO;
use PDOException;

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
            $host = $_ENV['MYSQL_ROOT_PASSWORD'];
            $charset = 'utf8';

            $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

            try {
                self::$pdo = new PDO($dsn, $user, $pass);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Error de conexión: " . $e->getMessage());
            }
        }

        return self::$pdo;
    }

}