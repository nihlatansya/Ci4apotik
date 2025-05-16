<?php

namespace App\Models;

use CodeIgniter\Model;

class PresensiModel extends Model
{
    protected $table = 'tb_presensi';
    protected $primaryKey = 'id_presensi';
    protected $allowedFields = [
        'tanggal',
        'jam_masuk',
        'jam_pulang',
<<<<<<< HEAD
        'persentase_kehadiran',
        'dibuat_pada',
        'diupdate_pada',
        'keterangan',
=======
        'keterangan',
        'dibuat_pada',
        'diupdate_pada',
>>>>>>> b265b755a65f585b5ed6e3087633f37ee5c2a3da
        'tb_user_iduser',
        'tb_jadwal_shift_id_jadwal_shift'
    ];
    protected $useTimestamps = false;

    public function getPresensiWithUser()
    {
<<<<<<< HEAD
        return $this->select('tb_presensi.*, tb_user.nama')
            ->join('tb_user', 'tb_user.iduser = tb_presensi.tb_user_iduser')
=======
        return $this->select('tb_presensi.*, tb_user.nama, tb_jadwal_shift.jenis_shift')
            ->join('tb_user', 'tb_user.iduser = tb_presensi.tb_user_iduser')
            ->join('tb_jadwal_shift', 'tb_jadwal_shift.id_jadwal_shift = tb_presensi.tb_jadwal_shift_id_jadwal_shift')
>>>>>>> b265b755a65f585b5ed6e3087633f37ee5c2a3da
            ->findAll();
    }
}
