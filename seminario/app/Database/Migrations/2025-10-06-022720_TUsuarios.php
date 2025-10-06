<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TUsuarios extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'apellidos' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false
            ],
            'nombres' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false
            ],
            'nomusuario' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => false
            ],
            'claveacceso' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false
            ],
            'avatar' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'default' => 'default.jpg'
            ],
            'nivelacceso' => [
                'type' => 'ENUM',
                'constraint' => ['ADMIN', 'USER'],
                'default' => 'USER'
            ],
            'create_at' => [
                'type' => 'DATETIME',
                'null' => false
            ],
            'update_at' => [
                'type' => 'DATETIME',
                'null' => true
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('nomusuario');
        $this->forge->createTable('usuarios');
    }

    public function down()
    {
        $this->forge->dropTable('usuarios');
    }
}