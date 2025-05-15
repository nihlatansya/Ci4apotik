<?php

namespace App\Controllers;

use App\Models\PresensiModel;
use App\Models\UserModel;
use App\Models\JadwalShiftModel;

class Presensi extends BaseController
{
    protected $presensiModel;
    protected $userModel;
    protected $jadwalShiftModel;

    public function __construct()
    {
        $this->presensiModel = new PresensiModel();
        $this->userModel = new UserModel();
        $this->jadwalShiftModel = new JadwalShiftModel();
    }

    public function index()
    {
        $data['presensi'] = $this->presensiModel->getPresensiWithUser();
        return view('presensi/index', $data);
    }

    public function create()
    {
        $data['users'] = $this->userModel->findAll();
        return view('presensi/create', $data);
    }

    public function store()
    {
        $data = [
            'tanggal' => $this->request->getPost('tanggal'),
            'jam_masuk' => $this->request->getPost('jam_masuk'),
            'jam_pulang' => $this->request->getPost('jam_pulang'),
            'keterangan' => $this->request->getPost('keterangan'),
            'tb_user_iduser' => $this->request->getPost('user_id'),
            'tb_jadwal_shift_id_jadwal_shift' => $this->request->getPost('jadwal_shift_id'),
            'dibuat_pada' => date('Y-m-d H:i:s'),
            'diupdate_pada' => date('Y-m-d H:i:s')
        ];

        $this->presensiModel->insert($data);
        return redirect()->to('/presensi')->with('success', 'Data presensi berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data['presensi'] = $this->presensiModel->find($id);
        $data['users'] = $this->userModel->findAll();
        return view('presensi/edit', $data);
    }

    public function update($id)
    {
        $data = [
            'tanggal' => $this->request->getPost('tanggal'),
            'jam_masuk' => $this->request->getPost('jam_masuk'),
            'jam_pulang' => $this->request->getPost('jam_pulang'),
            'keterangan' => $this->request->getPost('keterangan'),
            'tb_user_iduser' => $this->request->getPost('user_id'),
            'tb_jadwal_shift_id_jadwal_shift' => $this->request->getPost('jadwal_shift_id'),
            'diupdate_pada' => date('Y-m-d H:i:s')
        ];

        $this->presensiModel->update($id, $data);
        return redirect()->to('/presensi')->with('success', 'Data presensi berhasil diupdate');
    }

    public function delete($id)
    {
        $this->presensiModel->delete($id);
        return redirect()->to('/presensi')->with('success', 'Data presensi berhasil dihapus');
    }

    public function exportCsv()
    {
        $presensi = $this->presensiModel->getPresensiWithUser();

        $filename = 'presensi_' . date('Y-m-d') . '.csv';
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        $output = fopen('php://output', 'w');

        // Add CSV headers
        fputcsv($output, ['ID', 'Tanggal', 'Jam Masuk', 'Jam Pulang', 'Keterangan', 'Nama Karyawan']);

        // Add data rows
        foreach ($presensi as $row) {
            fputcsv($output, [
                $row['id_presensi'],
                $row['tanggal'],
                $row['jam_masuk'],
                $row['jam_pulang'],
                $row['keterangan'],
                $row['nama']
            ]);
        }

        fclose($output);
        exit;
    }

    public function scanRfid()
    {
        $rfid = $this->request->getPost('rfid');
        $user = $this->userModel->where('id_kartu_rfid', $rfid)->first();
        
        if ($user) {
            // Get user's current shift
            $shift = $this->jadwalShiftModel->find($user['tb_jadwal_shift_id_jadwal_shift']);
            
            if ($shift) {
                $data = [
                    'tanggal' => date('Y-m-d'),
                    'jam_masuk' => date('H:i:s'),
                    'keterangan' => 'hadir',
                    'tb_user_iduser' => $user['iduser'],
                    'tb_jadwal_shift_id_jadwal_shift' => $user['tb_jadwal_shift_id_jadwal_shift'],
                    'dibuat_pada' => date('Y-m-d H:i:s'),
                    'diupdate_pada' => date('Y-m-d H:i:s')
                ];
                
                $this->presensiModel->insert($data);
                return $this->response->setJSON(['success' => true, 'message' => 'Presensi berhasil dicatat']);
            }
        }
        
        return $this->response->setJSON(['success' => false, 'message' => 'RFID tidak ditemukan']);
    }
}
