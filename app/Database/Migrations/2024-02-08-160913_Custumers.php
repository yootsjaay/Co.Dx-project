<?php
    namespace App\Database\Migrations;
    use CodeIgniter\Database\Migration;
    class Custumers extends Migration
    {
    public function up()
    {
     // Custumers
    $this->forge->addField([
        'id'                    => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
        'firstname'             => ['type' => 'varchar', 'constraint' => 128, 'null' => true],
        'lastname'             => ['type' => 'varchar', 'constraint' => 128, 'null' => true],
        'taxID'             => ['type' => 'varchar', 'constraint' => 64, 'null' => true],
        'email'             => ['type' => 'varchar', 'constraint' => 128, 'null' => true],
        'direction'             => ['type' => 'varchar', 'constraint' => 1024, 'null' => true],
        'birthdate'             => ['type' => 'datetime' , 'null' => true],
        'created_at'       => ['type' => 'datetime', 'null' => true],
        'updated_at'       => ['type' => 'datetime', 'null' => true],
        'deleted_at'       => ['type' => 'datetime', 'null' => true],
    ]);
    $this->forge->addKey('id', true);
    $this->forge->createTable('custumers', true);
    }
    public function down(){
        $this->forge->dropTable('custumers', true);
        }
    }