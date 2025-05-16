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
<<<<<<< HEAD
            'iduser' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
=======
>>>>>>> b265b755a65f585b5ed6e3087633f37ee5c2a3da
            'tanggal' => [
                'type' => 'DATE',
            ],
            'jam_masuk' => [
                'type' => 'TIME',
<<<<<<< HEAD
            ],
            'jam_keluar' => [
                'type' => 'TIME',
                'null' => true,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['hadir', 'terlambat', 'izin', 'sakit', 'alpha'],
                'default'    => 'hadir',
=======
                'null' => true,
            ],
            'jam_pulang' => [
                'type' => 'TIME',
                'null' => true,
            ],
            'persentase' => [
                'type' => 'DECIMAL',
                'constraint' => '5,2',
                'null' => true,
                'default' => 0.00,
            ],
            'keterangan' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'dibuat_pada' => [
                'type' => 'DATETIME',
            ],
            'diupdate_pada' => [
                'type' => 'DATETIME',
            ],
            'tb_user_iduser' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'tb_jadwal_shift_id_jadwal_shift' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
>>>>>>> b265b755a65f585b5ed6e3087633f37ee5c2a3da
            ],
        ]);

        $this->forge->addKey('id_presensi', true);
<<<<<<< HEAD
        $this->forge->addForeignKey('iduser', 'tb_user', 'iduser', 'CASCADE', 'CASCADE');
=======

        // Add foreign key constraints
        $this->forge->addForeignKey('tb_user_iduser', 'tb_user', 'iduser', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('tb_jadwal_shift_id_jadwal_shift', 'tb_jadwal_shift', 'id_jadwal_shift', 'CASCADE', 'CASCADE');

>>>>>>> b265b755a65f585b5ed6e3087633f37ee5c2a3da
        $this->forge->createTable('tb_presensi');
    }

    public function down()
    {
        $this->forge->dropTable('tb_presensi');
    }
}
