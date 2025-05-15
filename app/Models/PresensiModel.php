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
        'persentase_kehadiran',
        'dibuat_pada',
        'diupdate_pada',
        'keterangan',
        'tb_user_iduser',
        'tb_jadwal_shift_id_jadwal_shift'
    ];
    protected $useTimestamps = false;

    public function getPresensiWithUser()
    {
        return $this->select('tb_presensi.*, tb_user.nama')
            ->join('tb_user', 'tb_user.iduser = tb_presensi.tb_user_iduser')
            ->findAll();
    }
}
