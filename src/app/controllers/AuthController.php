<?php

namespace Nar\MinidriverPhp\app\controllers;

use Nar\MinidriverPhp\core\BaseController;
use Nar\MinidriverPhp\dtos\RegisterRequestDto;
use Nar\MinidriverPhp\services\AuthService;

class AuthController extends BaseController
{

    private  $authService;

    public function __construct()
    {
        $this->authService = new AuthService();
    }

    public function register()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        $fields =['name', 'email', 'password'];
        $missing = $this->validateFields($data, $fields);
        if(!empty($missing)){
            $this->jsonError([
                'error' => 'Faltan los siguientes campos: ' . implode(', ', $missing)
            ], 400);
            return;
        }
        try{
            $dto = new RegisterRequestDto();
            $dto->setEmail($data['email']);
            $dto->setPassword($data['password']);
            $dto->setName($data['name']);
            $result = $this->authService->register($dto);
            $this->jsonResponse($result,200);
        } catch (\Exception $exception){
            $this->jsonError(['error'=> $exception->getMessage()],401);
        }
    }

    public function validateFields(array $data, array $fields)
    {
        $missing = [];

        foreach ($fields as $field) {
            if (empty($data[$field])) {
                $missing[] = $field;
            }
        }

        return $missing;
    }

    public function oauth()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            throw new \Exception('Método no permitido');
        }

        try {
            if (!isset($_GET['code'])) {
                throw new \Exception('No se recibió el código de autorización');
            }

            $code = $_GET['code'];
            $authService = new AuthService();
            $user = $authService->loginGoogle($code);

            $this->jsonSuccess(['user' => $user]);
        } catch (\Exception $e) {
            $this->jsonError($e->getMessage());
        }
    }

    public function logear()
    {
        require_once __DIR__ . '/../../views/auth/login.php';
    }


}