<?php

namespace App\Controllers;

use App\Models\JadwalShiftModel;

class JadwalShift extends BaseController
{
    protected $jadwalShiftModel;

    public function __construct()
    {
        $this->jadwalShiftModel = new JadwalShiftModel();
    }

    public function index()
    {
        $data['jadwal_shift'] = $this->jadwalShiftModel->findAll();
        return view('jadwal_shift/index', $data);
    }

    public function create()
    {
        return view('jadwal_shift/create');
    }

    public function store()
    {
        $data = [
            'dari_tanggal' => $this->request->getPost('dari_tanggal'),
            'sampai_tanggal' => $this->request->getPost('sampai_tanggal'),
            'shift_mulai' => $this->request->getPost('shift_mulai'),
            'shift_selesai' => $this->request->getPost('shift_selesai'),
            'jenis_shift' => $this->request->getPost('jenis_shift'),
            'dibuat_pada' => date('Y-m-d H:i:s'),
            'diupdate_pada' => date('Y-m-d H:i:s')
        ];

        $this->jadwalShiftModel->insert($data);
        return redirect()->to('/jadwal-shift')->with('success', 'Jadwal shift berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data['jadwal_shift'] = $this->jadwalShiftModel->find($id);
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
            'diupdate_pada' => date('Y-m-d H:i:s')
        ];

        $this->jadwalShiftModel->update($id, $data);
        return redirect()->to('/jadwal-shift')->with('success', 'Jadwal shift berhasil diupdate');
    }

    public function delete($id)
    {
        $this->jadwalShiftModel->delete($id);
        return redirect()->to('/jadwal-shift')->with('success', 'Jadwal shift berhasil dihapus');
    }
} 