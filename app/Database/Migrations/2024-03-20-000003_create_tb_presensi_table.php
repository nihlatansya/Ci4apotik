<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTbPresensiTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_presensi' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'iduser' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'tanggal' => [
                'type' => 'DATE',
            ],
            'jam_masuk' => [
                'type' => 'TIME',
            ],
            'jam_keluar' => [
                'type' => 'TIME',
                'null' => true,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['hadir', 'terlambat', 'izin', 'sakit', 'alpha'],
                'default'    => 'hadir',
            ],
        ]);

        $this->forge->addKey('id_presensi', true);
        $this->forge->addForeignKey('iduser', 'tb_user', 'iduser', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tb_presensi');
    }

    public function down()
    {
        $this->forge->dropTable('tb_presensi');
    }
}
