<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTbUserTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'iduser' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'unique'     => true,
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'role' => [
                'type'       => 'ENUM',
                'constraint' => ['admin', 'karyawan'],
                'default'    => 'karyawan',
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['aktif', 'tidak aktif'],
                'default'    => 'aktif',
            ],
            'gender' => [
                'type'       => 'ENUM',
                'constraint' => ['laki-laki', 'perempuan'],
            ],
            'id_kartu_rfid' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true,
            ],
        ]);

        $this->forge->addKey('iduser', true);
        $this->forge->createTable('tb_user');
    }

    public function down()
    {
        $this->forge->dropTable('tb_user');
    }
} 