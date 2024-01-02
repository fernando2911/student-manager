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
        $request = \Config\Services::request();

        $model = new StudentModel();

        $data = [
            'name' => $request->getPost('name'),
            'email' => $request->getPost('email'),
            'phone' => $request->getPost('phone'),
            'address' => $request->getPost('address'),
        ];

        $studentId = $model->insert($data);

        $file = $this->request->getFile('photo');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $studentId . '.' . $file->getExtension();
            $file->move(ROOTPATH . 'public/uploads/students', $newName);
            $userData['photo'] = $newName;
            $this->model->update($studentId, ['photo' => $newName]);
        }

        if (!$studentId) {
            return $this->fail($this->model->errors(), 400);
        }

        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'Estudante criado com sucesso'
            ],
            'studentId' => $studentId
        ];
        
        return $this->respond($response);
    }

    public function update($id = null)
    {
        helper(['form', 'url']);

        $model = new StudentModel();

        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'address' => $this->request->getPost('address'),
        ];

        $model->update($id, $data);

        $file = $this->request->getFile('photo');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $id . '.' . $file->getExtension();
            $file->move(ROOTPATH . 'public/uploads/students', $newName);
            $model->update($id, ['photo' => $newName]);
        }

        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Estudante atualizado com sucesso'
            ]
        ];

        return $this->respond($response);
    }

    public function delete($id = null)
    {
        $model = new StudentModel();

        $student = $model->find($id);
        if (!$student) {
            return $this->failNotFound('Estudante não encontrado com o ID: ' . $id);
        }

        if ($model->delete($id)) {
            return $this->respondDeleted(['message' => 'Estudante excluído com sucesso']);
        } else {
            return $this->failServerError('Erro ao excluir o estudante');
        }
    }
}