<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SUsuarios extends Seeder
{
    public function run()
    {
        $data = [
            [
                'apellidos' => 'Saravia Saravia',
                'nombres' => 'Adrian Leonel',
                'nomusuario' => 'Leo',
                'claveacceso' => password_hash('Leo25*', PASSWORD_DEFAULT),
                'avatar' => 'default.jpg',
                'nivelacceso' => 'ADMIN',
                'create_at' => date('Y-m-d H:i:s')
            ],
            [
                'apellidos' => 'Aivaras Aivaras',
                'nombres' => 'Naidra Lenoel',
                'nomusuario' => 'Nai',
                'claveacceso' => password_hash('Nai25*', PASSWORD_DEFAULT),
                'avatar' => 'default.jpg',
                'nivelacceso' => 'USER',
                'create_at' => date('Y-m-d H:i:s')
            ]
        ];

        $this->db->table('usuarios')->insertBatch($data);
    }
}