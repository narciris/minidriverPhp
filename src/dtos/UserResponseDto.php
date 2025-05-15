<?php

namespace Nar\MinidriverPhp\dtos;

class UserResponseDto
{
    public $id;
    public $name;
    public $email;
    public $createAt;
    public $storagePreference;


    public function __construct($id, $name, $email, $createAt, $storagePreference){
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->createAt = $createAt;
        $this->storagePreference = $storagePreference;
    }

    public function toArray()
    {
        return  [
            "id" => $this->id,
            "name" => $this->name,
            "email" => $this->email,
            "create_at" => $this->createAt,
            "storage_preference" => $this->storagePreference
        ];
    }

}