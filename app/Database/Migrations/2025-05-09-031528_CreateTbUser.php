<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTbUser extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'iduser' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => 60,
            ],
            'role' => [
                'type'       => 'ENUM',
                'constraint' => ['admin', 'karyawan'],
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['aktif', 'tidak aktif'],
            ],
            'password' => [
                'type'       => 'CHAR',
                'constraint' => 32,
            ],
            'gender' => [
                'type'       => 'ENUM',
                'constraint' => ['laki-laki', 'perempuan'],
            ],
        ]);

        $this->forge->addKey('iduser', true); // primary key
        $this->forge->createTable('tb_user');
    }

    public function down()
    {
        $this->forge->dropTable('tb_user');
    }
}
  