<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Empresas extends Migration {

    public function up() {
        // Empresas
        $this->forge->addField([
            'id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'nombre' => ['type' => 'varchar', 'constraint' => 500, 'null' => false],
            'direccion' => ['type' => 'varchar', 'constraint' => 30, 'null' => true],
            'rfc' => ['type' => 'varchar', 'constraint' => 14, 'null' => false],
            'telefono' => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'correoElectronico' => ['type' => 'varchar', 'constraint' => 256, 'null' => true],
            'diasEntrega' => ['type' => 'varchar', 'constraint' => 8, 'null' => true],
            'caja' => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'logo' => ['type' => 'varchar', 'constraint' => 1024, 'null' => true],
            'certificado' => ['type' => 'varchar', 'constraint' => 1024, 'null' => true],
            'archivoKey' => ['type' => 'varchar', 'constraint' => 68, 'null' => true],
            'contraCertificado' => ['type' => 'varchar', 'constraint' => 68, 'null' => true],
            'regimenFiscal' => ['type' => 'varchar', 'constraint' => 68, 'null' => true],
            'razonSocial' => ['type' => 'varchar', 'constraint' => 68, 'null' => true],
            'codigoPostal' => ['type' => 'varchar', 'constraint' => 68, 'null' => true],
            'CURP' => ['type' => 'varchar', 'constraint' => 68, 'null' => true],
            'id_usuario' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'null' => true], // Nueva columna
            'created_at' => ['type' => 'datetime', 'null' => true],
            'updated_at' => ['type' => 'datetime', 'null' => true],
            'deleted_at' => ['type' => 'datetime', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_usuario', 'users', 'id', 'CASCADE', 'CASCADE'); // Agregar la clave externa

        $this->forge->createTable('empresas', true);
    }

    public function down() {
        $this->forge->dropTable('empresas', true);
    }

}
