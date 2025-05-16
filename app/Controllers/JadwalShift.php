<?php

namespace App\Controllers;

use App\Models\JadwalShiftModel;
<<<<<<< HEAD
=======
use App\Models\UserModel;
>>>>>>> b265b755a65f585b5ed6e3087633f37ee5c2a3da

class JadwalShift extends BaseController
{
    protected $jadwalShiftModel;
<<<<<<< HEAD
=======
    protected $userModel;
    protected $db;
>>>>>>> b265b755a65f585b5ed6e3087633f37ee5c2a3da

    public function __construct()
    {
        $this->jadwalShiftModel = new JadwalShiftModel();
<<<<<<< HEAD
=======
        $this->userModel = new UserModel();
        $this->db = \Config\Database::connect();
>>>>>>> b265b755a65f585b5ed6e3087633f37ee5c2a3da
    }

    public function index()
    {
        $data['jadwal_shift'] = $this->jadwalShiftModel->findAll();
<<<<<<< HEAD
=======
        // Get users for each jadwal shift
        foreach ($data['jadwal_shift'] as &$shift) {
            $shift['users'] = $this->userModel->where('id_jadwal_shift', $shift['id_jadwal_shift'])->findAll();
        }
>>>>>>> b265b755a65f585b5ed6e3087633f37ee5c2a3da
        return view('jadwal_shift/index', $data);
    }

    public function create()
    {
<<<<<<< HEAD
        return view('jadwal_shift/create');
=======
        $data['users'] = $this->userModel->where('role', 'karyawan')->findAll();
        return view('jadwal_shift/create', $data);
>>>>>>> b265b755a65f585b5ed6e3087633f37ee5c2a3da
    }

    public function store()
    {
        $data = [
            'dari_tanggal' => $this->request->getPost('dari_tanggal'),
            'sampai_tanggal' => $this->request->getPost('sampai_tanggal'),
            'shift_mulai' => $this->request->getPost('shift_mulai'),
            'shift_selesai' => $this->request->getPost('shift_selesai'),
            'jenis_shift' => $this->request->getPost('jenis_shift'),
<<<<<<< HEAD
            'dibuat_pada' => date('Y-m-d H:i:s'),
            'diupdate_pada' => date('Y-m-d H:i:s')
        ];

        $this->jadwalShiftModel->insert($data);
=======
        ];

        $this->db->transStart();

        // Insert jadwal shift
        $id_jadwal_shift = $this->jadwalShiftModel->insert($data);

        // Update selected users
        $selected_users = $this->request->getPost('users');
        if ($selected_users) {
            $this->userModel->whereIn('iduser', $selected_users)
                ->set(['id_jadwal_shift' => $id_jadwal_shift])
                ->update();
        }

        $this->db->transComplete();

>>>>>>> b265b755a65f585b5ed6e3087633f37ee5c2a3da
        return redirect()->to('/jadwal-shift')->with('success', 'Jadwal shift berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data['jadwal_shift'] = $this->jadwalShiftModel->find($id);
<<<<<<< HEAD
=======
        // Get users assigned to this shift
        $data['assigned_users'] = $this->userModel->where('id_jadwal_shift', $id)->findAll();
        // Get users not assigned to any shift
        $data['available_users'] = $this->userModel->where('id_jadwal_shift IS NULL')->findAll();
>>>>>>> b265b755a65f585b5ed6e3087633f37ee5c2a3da
        return view('jadwal_shift/edit', $data);
    }

    public function update($id)
    {
        $data = [
            'dari_tanggal' => $this->request->getPost('dari_tanggal'),
            'sampai_tanggal' => $this->request->getPost('sampai_tanggal'),
            'shift_mulai' => $this->request->getPost('shift_mulai'),
            'shift_selesai' => $this->request->getPost('shift_selesai'),
            'jenis_shift' => $this->request->getPost('jenis_shift'),
<<<<<<< HEAD
            'diupdate_pada' => date('Y-m-d H:i:s')
        ];

        $this->jadwalShiftModel->update($id, $data);
=======
        ];

        $this->db->transStart();

        // Update jadwal shift
        $this->jadwalShiftModel->update($id, $data);

        // Reset all users from this shift
        $this->userModel->where('id_jadwal_shift', $id)
            ->set(['id_jadwal_shift' => null])
            ->update();

        // Update selected users
        $selected_users = $this->request->getPost('users');
        if ($selected_users) {
            $this->userModel->whereIn('iduser', $selected_users)
                ->set(['id_jadwal_shift' => $id])
                ->update();
        }

        $this->db->transComplete();

>>>>>>> b265b755a65f585b5ed6e3087633f37ee5c2a3da
        return redirect()->to('/jadwal-shift')->with('success', 'Jadwal shift berhasil diupdate');
    }

    public function delete($id)
    {
<<<<<<< HEAD
        $this->jadwalShiftModel->delete($id);
        return redirect()->to('/jadwal-shift')->with('success', 'Jadwal shift berhasil dihapus');
    }
} 
=======
        $this->db->transStart();

        // Reset users from this shift
        $this->userModel->where('id_jadwal_shift', $id)
            ->set(['id_jadwal_shift' => null])
            ->update();

        // Delete the shift
        $this->jadwalShiftModel->delete($id);

        $this->db->transComplete();

        return redirect()->to('/jadwal-shift')->with('success', 'Jadwal shift berhasil dihapus');
    }
}
>>>>>>> b265b755a65f585b5ed6e3087633f37ee5c2a3da
