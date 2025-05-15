<?php
namespace Nar\MinidriverPhp\services;
use Google\Client as GoogleClient;
use Google\Service\Oauth2;
use config\GoogleOauth;
use Nar\MinidriverPhp\dtos\RegisterRequestDto;
use Nar\MinidriverPhp\dtos\UserResponseDto;
use Nar\MinidriverPhp\models\User;

class AuthService
{
   private $model;

   public function __construct()
   {
       $this->model = new User();
   }

    /** busca usuario por email
     * si no encuentra al usuario o la contraseña es incorrecta arroja una excepcion
     **/


    public function register(RegisterRequestDto  $request)
    {
        $email = $request->getEmail();
        if(!filter_Var($email, FILTER_VALIDATE_EMAIL)) {
            throw  new \Exception("Formato de email invalido");
        }
        $existingUser = $this->model->findByEmail($email);
        if($existingUser) {
            throw new \Exception("Usuario ya esta registrado");
        }
        $data = $request->toArray();
        $data['created_at'] = date('Y-m-d H:i:s');

       $userId = $this->model->save($data);
       if(!$userId) {
           throw new \Exception("No se pudo crear el usuario");
       }
       $user = $this->model->findById($userId);

       return new UserResponseDto($user["id"],$user['name'], $user["email"],$user["created_at"],$user['storage_preference']);
    }


    public function loginGoogle(string $code)
    {
        $config = new GoogleOauth();
       $result= $config->getGoogle();

       $client = new GoogleClient();
       $client->setClientId($result["client_id"]);
       $client->setClientSecret($result["client_secret"]);
       $client->setRedirectUri($result["redirect_uri"]);

       $token = $client->fetchAccessTokenWithAuthCode($code);


        if (isset($token['error'])) {
            throw new \Exception('Error al autenticar con Google: ' . json_encode($token));
        }

        $client->setAccessToken($token);
        $oauth = new Oauth2($client);
        $googleUser = $oauth->userinfo->get();

        $user = $this->model->findByEmail($googleUser["email"]);
        if(!$user) {
            $dto = new RegisterRequestDto();
            $dto->setEmail($googleUser["email"]);
            $dto->setName($googleUser["name"]);
            $dto->setGoogleId($googleUser["id"]);
            $dto->setPicture($googleUser["picture"]);
            $data = $dto->toArray();
            $data['created_at'] = date('Y-m-d H:i:s');

            $userId= $this->model->save($data);

            $user = $this->model->findById($userId);
        }


        $_SESSION['user'] = $user;
        return $user;

    }
}