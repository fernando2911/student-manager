<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserAdminSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'username' => 'admin',
            'email'    => 'admin@example.com',
            'password' => password_hash('4)f;c&JE', PASSWORD_DEFAULT),
        ];

        $this->db->table('users')->insert($data);
    }
}
