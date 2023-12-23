<?php

namespace App\Filters;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\API\ResponseTrait;
use App\Services\DatabaseService;


class DatabaseCheckFilter implements FilterInterface
{
    use ResponseTrait;
    
    public function before(RequestInterface $request, $arguments = null)
    {
        $dbService = new DatabaseService();
        $checkConnection = $dbService->checkConnection();

        if ($checkConnection !== true) {
            $response = service('response');
            $response->setStatusCode(($checkConnection === 'access_denied') ? 403 : 500);

            return $response->setContentType('application/json')
                            ->setBody(json_encode(['error' => ($checkConnection === 'access_denied') 
                            ? 'Acesso ao banco de dados negado.' 
                            : 'Erro ao conectar ao banco de dados.']));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) 
    {

    }
}