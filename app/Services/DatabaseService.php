<?php

namespace App\Services;

use CodeIgniter\Database\Exceptions\DatabaseException;
use Config\Database;

class DatabaseService
{
    public function checkConnection()
    {
        try {
            $db = Database::connect();
            $db->query('SELECT 1');
            return true;
        } catch (DatabaseException $e) {
            if (strpos($e->getMessage(), 'Access denied for user') !== false) {
                log_message('error', 'Erro de conexão com o banco de dados - Acesso negado: ' . $e->getMessage());
                return 'access_denied';
            }
            log_message('error', 'Erro de conexão com o banco de dados: ' . $e->getMessage());
            return 'connection_error';
        }
    }
}