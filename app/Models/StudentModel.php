<?php namespace App\Models;

use CodeIgniter\Model;

class StudentModel extends Model
{
    protected $table = 'students';
    protected $allowedFields = ['name', 'email', 'phone', 'address', 'photo'];
    protected $useTimestamps = true;
}