<?php

namespace App\Filters;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\API\ResponseTrait;
use App\Services\DatabaseService;
use CodeIgniter\Config\Services;


class DatabaseCheckFilter implements FilterInterface
{
    use ResponseTrait;
    
    public function before(RequestInterface $request, $arguments = null)
    {
        $dbService = new DatabaseService();
        $checkConnection = $dbService->checkConnection();

        if ($checkConnection !== true) {
            $errorMessage = ($checkConnection === 'access_denied') ? 
                'Acesso ao banco de dados negado.' : 
                'Erro ao conectar ao banco de dados.';
            $statusCode = ($checkConnection === 'access_denied') ? 403 : 500;
            return Services::response()->setStatusCode($statusCode)->setJSON([
                "status" => $statusCode,
                "error" => $statusCode,
                "messages" => [
                    "error" => $errorMessage
                ]
            ]);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) 
    {

    }
}