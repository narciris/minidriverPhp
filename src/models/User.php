<?php

namespace Nar\MinidriverPhp\models;

use Nar\MinidriverPhp\core\Model;
use Nar\MinidriverPhp\dtos\RegisterRequestDto;
use Nar\MinidriverPhp\dtos\UserResponseDto;
use PDO;
use PDOException;

class User extends Model
{

    protected  $model = 'users';


    public function findByEmail(string $email): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->model} WHERE email = :email");
        $stmt->bindValue(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user ?: null;
    }


    public function findUserById($id)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM {$this->model} WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$user) {
                throw new \Exception("Usuario con ID {$id} no encontrado", 404);
            }
            return $user;

        } catch (PDOException $e) {
            throw new \Exception("Error en la base de datos: " . $e->getMessage(), 500);
        }
    }



}