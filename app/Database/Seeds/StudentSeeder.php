<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class StudentSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'Leslie Alexander',
                'email' => 'leslie.alexander@example.com',
                'phone' => '(43) 2871-9843',
                'address' => 'Avenida Ataíde Teive',
                'photo' => 'leslie-alexander.avif',
            ],
            [
                'name' => 'Michael Foster',
                'email' => 'michael.foster@example.com',
                'phone' => '(19) 3556-8111',
                'address' => 'Rua NC 18',
                'photo' => 'michael-foster.avif',
            ],
            [
                'name' => 'Dries Vincent',
                'email' => 'dries.vincent@example.com',
                'phone' => '(92) 3082-6212',
                'address' => 'Quadra Quadra 48',
                'photo' => 'dries-vincent.avif',
            ],
            [
                'name' => 'Lindsay Walton',
                'email' => 'lindsay.walton@example.com',
                'phone' => '(88) 2273-3683',
                'address' => 'Rua Itauna',
                'photo' => 'lindsay-walton.avif',
            ],
            [
                'name' => 'Courtney Henry',
                'email' => 'courtney.henry@example.com',
                'phone' => '(85) 3941-8030',
                'address' => 'Avenida General Osório',
                'photo' => 'courtney-henry.avif',
            ],
            [
                'name' => 'Tom Cook',
                'email' => 'tom.cook@example.com',
                'phone' => '(28) 3985-4028',
                'address' => 'Vale Quem Tem',
                'photo' => 'tom-cook.avif',
            ],
        ];
        

        foreach ($data as $studentData) {
            $this->db->table('students')->insert($studentData);
        }
    }
}
