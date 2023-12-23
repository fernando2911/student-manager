<?php
namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Exception;
use CodeIgniter\Config\Services;

class JwtFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        try {
            $key = getenv('JWT_SECRET');
            $authHeader = $request->getHeaderLine('Authorization');
            $arr = explode(' ', $authHeader);

            if (isset($arr[1])) {
                $token = $arr[1];
                JWT::decode($token, new Key($key, 'HS256'));
            } else {
                return Services::response()->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED)->setJSON([
                    "status" => 401,
                    "error" => 401,
                    "messages" => [
                        "error" => "Token não Fornecido"
                    ]
                ]);
            }
        } catch (Exception $e) {
            return Services::response()->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED)->setJSON([
                "status" => 401,
                "error" => 401,
                "messages" => [
                    "error" => "Token Inválido"
                ]
            ]);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        
    }
}
