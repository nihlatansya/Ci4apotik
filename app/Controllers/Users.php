<?php

namespace App\Controllers;

use App\Models\UserModel;

class Users extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $data['users'] = $this->userModel->findAll();
        return view('users/index', $data);
    }

    public function create()
    {
        return view('users/create');
    }

    public function store()
    {
        $rules = [
            'nama' => 'required|min_length[3]',
            'email' => 'required|valid_email|is_unique[tb_user.email]',
            'password' => 'required|min_length[6]',
            'role' => 'required|in_list[admin,karyawan]',
            'status' => 'required|in_list[aktif,tidak aktif]',
            'gender' => 'required|in_list[laki-laki,perempuan]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'password' => md5($this->request->getPost('password')),
            'role' => $this->request->getPost('role'),
            'status' => $this->request->getPost('status'),
            'gender' => $this->request->getPost('gender'),
            'id_kartu_rfid' => $this->request->getPost('id_kartu_rfid')
        ];

        $this->userModel->insert($data);
        return redirect()->to('/users')->with('success', 'Pengguna berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data['user'] = $this->userModel->find($id);
        if (!$data['user']) {
            return redirect()->to('/users')->with('error', 'Pengguna tidak ditemukan');
        }
        return view('users/edit', $data);
    }

    public function update($id)
    {
        $rules = [
            'nama' => 'required|min_length[3]',
            'email' => 'required|valid_email',
            'role' => 'required|in_list[admin,karyawan]',
            'status' => 'required|in_list[aktif,tidak aktif]',
            'gender' => 'required|in_list[laki-laki,perempuan]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'role' => $this->request->getPost('role'),
            'status' => $this->request->getPost('status'),
            'gender' => $this->request->getPost('gender'),
            'id_kartu_rfid' => $this->request->getPost('id_kartu_rfid')
        ];

        // Update password only if provided
        if ($password = $this->request->getPost('password')) {
            $data['password'] = md5($password);
        }

        $this->userModel->update($id, $data);
        return redirect()->to('/users')->with('success', 'Pengguna berhasil diperbarui');
    }

    public function delete($id)
    {
        // Prevent self-deletion
        if ($id == session()->get('iduser')) {
            return redirect()->to('/users')->with('error', 'Tidak dapat menghapus akun sendiri');
        }

        $this->userModel->delete($id);
        return redirect()->to('/users')->with('success', 'Pengguna berhasil dihapus');
    }
}
