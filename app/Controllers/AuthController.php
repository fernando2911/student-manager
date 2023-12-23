<?php
namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use Firebase\JWT\JWT;
use App\Models\UserModel;

class AuthController extends ResourceController
{
    public function login()
    {
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        
        $model = new UserModel();
        $user = $model->where('email', $email)->first();
        
        if ($user && password_verify($password, $user['password'])) {
            $key = $_ENV['JWT_SECRET'];
            $payload = [
                'iat' => time(),
                'exp' => time() + 3600,
                'sub' => $user['id'],
            ];

            $token = JWT::encode($payload, $key, 'HS256');

            $response = [
                'status' => 200,
                'error' => null,
                'messages' => [
                    'success' => 'Credenciais Válidas'
                ],
                'token' => $token
            ];
            return $this->respond($response, 200);
        }

        return $this->failUnauthorized('Credenciais Inválidas');
    }
}
