<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\GuruModel;
use App\Models\SekolahModel;
use App\Models\UserModel;

class guru extends BaseController
{
    protected $guruModel;
    protected $userModel;
    protected $sekolahModel;

    public function __construct()
    {
        $this->guruModel = new GuruModel();
        $this->userModel = new UserModel();
        $this->sekolahModel = new SekolahModel();
    }

    public function index()
    {
        $data['guru'] = $this->guruModel
        ->select('guru.*, users.username as user_username, sekolah.nama_sekolah')
        ->join('users', 'users.id = guru.user_id', 'left')
        ->join('sekolah', 'sekolah.id = guru.sekolah_id', 'left')
        ->findAll();

        return view('admin/guru/index', $data);
    }

    public function create()
    {
        $data['sekolah'] = (new SekolahModel())->findAll();
        $data['users'] = $this->userModel->where('role', 'guru')->findAll();
        return view('admin/guru/create', $data);
    }

    public function store()
    {
        $this->guruModel->insert([
            'user_id'        => $this->request->getPost('user_id'),
            'nama_lengkap'    => $this->request->getPost('nama_lengkap'),
            'nip'             => $this->request->getPost('nip'),
            'jenis_kelamin'   => $this->request->getPost('jenis_kelamin'),
            'mata_pelajaran'  => $this->request->getPost('mata_pelajaran'),
            'alamat'          => $this->request->getPost('alamat'),
            'kontak'          => $this->request->getPost('kontak'),
            'email'           => $this->request->getPost('email'),
            'status_akun'     => $this->request->getPost('status_akun') ?? 'aktif',
            'sekolah_id'      => $this->request->getPost('sekolah_id')
        ]);

        return redirect()->to('/admin/guru')->with('success', 'Data guru berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data['guru'] = $this->guruModel->find($id);
        $data['sekolah'] = (new SekolahModel())->findAll();
        $data['users'] = $this->userModel->where('role', 'guru')->findAll();

        return view('admin/guru/edit', $data);
    }

    public function update($id)
    {
        $data = [
            'user_id'        => $this->request->getPost('user_id'),
            'nama_lengkap'    => $this->request->getPost('nama_lengkap'),
            'nip'             => $this->request->getPost('nip'),
            'jenis_kelamin'   => $this->request->getPost('jenis_kelamin'),
            'mata_pelajaran'  => $this->request->getPost('mata_pelajaran'),
            'alamat'          => $this->request->getPost('alamat'),
            'kontak'          => $this->request->getPost('kontak'),
            'email'           => $this->request->getPost('email'),
            'status_akun'     => $this->request->getPost('status_akun'),
            'sekolah_id'      => $this->request->getPost('sekolah_id')
        ];

        // Opsional update password jika tidak kosong
        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        $this->guruModel->update($id, $data);

        return redirect()->to('/admin/guru')->with('success', 'Data guru berhasil diperbarui.');
    }

    public function delete($id)
    {
        $this->guruModel->delete($id);
        return redirect()->to('/admin/guru')->with('success', 'Data guru berhasil dihapus.');
    }
}
