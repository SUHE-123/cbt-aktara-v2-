<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SiswaModel;
use App\Models\SekolahModel;
use App\Models\UserModel;

class siswa extends BaseController
{
    protected $siswaModel;
    protected $userModel;
    protected $sekolahModel;

    public function __construct()
    {
        $this->siswaModel = new SiswaModel();
        $this->userModel = new UserModel();
        $this->sekolahModel = new SekolahModel();
    }

    public function index()
    {
        $data['siswa'] = $this->siswaModel
        ->select('siswa.*, users.username, users.nama_lengkap as user_nama, sekolah.nama_sekolah')
        ->join('users', 'users.id = siswa.user_id', 'left')
        ->join('sekolah', 'sekolah.id = siswa.sekolah_id', 'left')
        ->findAll();
        return view('admin/siswa/index', $data);
    }

    public function create()
    {
        $data['users'] = $this->userModel->where('role', 'siswa')->findAll();
        $data['sekolah'] = (new SekolahModel())->findAll();
        return view('admin/siswa/create', $data);
    }

    public function store()
    {
        $this->siswaModel->save([
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'nis' => $this->request->getPost('nis'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'kelas' => $this->request->getPost('kelas'),
            'alamat' => $this->request->getPost('alamat'),
            'kontak' => $this->request->getPost('kontak'),
            'email' => $this->request->getPost('email'),
            'status_akun' => $this->request->getPost('status_akun'),
            'sekolah_id' => $this->request->getPost('sekolah_id'),
            'user_id' => $this->request->getPost('user_id')
        ]);

        return redirect()->to('/admin/siswa')->with('success', 'Siswa berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data['siswa'] = $this->siswaModel->find($id);
        $data['sekolah'] = (new SekolahModel())->findAll();
        $data['users'] = $this->userModel->where('role', 'siswa')->findAll();
        return view('admin/siswa/edit', $data);
    }

    public function update($id)
    {
        $data = [
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'nis' => $this->request->getPost('nis'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'kelas' => $this->request->getPost('kelas'),
            'alamat' => $this->request->getPost('alamat'),
            'kontak' => $this->request->getPost('kontak'),
            'email' => $this->request->getPost('email'),
            'status_akun' => $this->request->getPost('status_akun'),
            'sekolah_id' => $this->request->getPost('sekolah_id'),
            'user_id' => $this->request->getPost('user_id')
        ];

        // Jika password diisi, update juga
        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        $this->siswaModel->update($id, $data);
        return redirect()->to('/admin/siswa')->with('success', 'Data siswa berhasil diubah.');
    }

    public function delete($id)
    {
        $this->siswaModel->delete($id);
        return redirect()->to('/admin/siswa')->with('success', 'Siswa berhasil dihapus.');
    }
}
