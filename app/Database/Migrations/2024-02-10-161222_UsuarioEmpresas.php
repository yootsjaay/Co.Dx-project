<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UsuarioEmpresas extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'empresa_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            // Agrega otras columnas si es necesario
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('empresa_id', 'empresas', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('usuario_empresas', true);
    }

    public function down()
    {
        $this->forge->dropTable('usuario_empresas', true);
    }
}
