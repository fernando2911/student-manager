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
}