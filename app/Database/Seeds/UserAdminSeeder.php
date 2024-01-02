<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserAdminSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'username' => 'admin',
            'email'    => 'admin@delta.com.br',
            'password' => password_hash('123456', PASSWORD_DEFAULT),
        ];

        $this->db->table('users')->insert($data);
    }
}
