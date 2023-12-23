<?php namespace App\Controllers;

use App\Models\StudentModel;
use CodeIgniter\RESTful\ResourceController;

class StudentController extends ResourceController
{

    protected $modelName = 'App\Models\StudentModel';
    protected $format    = 'json';

    public function index() 
    {
        $model = new StudentModel();

        $students = $model->findAll();

        return $this->respond($students);
    }

    public function create()
    {
        $json = $this->request->getJSON();

        $model = new StudentModel();

        $data = [
            'name'    => $json->name,
            'email'   => $json->email,
            'phone'   => $json->phone,
            'address' => $json->address,
            // Implementar upload de fotos
        ];

        $model->insert($data);

        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'Estudante criado com sucesso'
            ]
        ];
        
        return $this->respond($response);
    }
}