<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'tb_user';
    protected $primaryKey = 'iduser';
    protected $allowedFields = ['nama', 'id_kartu_rfid', 'role', 'status', 'email', 'password', 'gender', 'id_jadwal_shift'];
    protected $useTimestamps = false;

    public function verifyPassword($username, $password)
    {
        $user = $this->where('nama', $username)->first();
        if ($user && $user['password'] === md5($password)) {
            return $user;
        }
        return false;
    }
}
