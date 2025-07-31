<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\GuruModel;
use App\Models\SiswaModel;

class users extends BaseController
{
    protected $userModel;
    protected $guruModel;
    protected $siswaModel;

    public function __construct()
    {
        $this->userModel  = new UserModel();
        $this->guruModel  = new GuruModel();
        $this->siswaModel = new SiswaModel();
    }

    public function index()
    {
        $data['users'] = $this->userModel->getWithRelasi()->findAll();
        return view('admin/users/index', $data);
    }

    public function create()
    {
        $data = [
            'guru'  => $this->guruModel->findAll(),
            'siswa' => $this->siswaModel->findAll()
        ];
        return view('admin/users/create', $data);
    }

    public function store()
{
    $userModel = new UserModel();

    $foto = $this->request->getFile('foto');
    $fotoName = null;

    if ($foto && $foto->isValid() && !$foto->hasMoved()) {
        $fotoName = $foto->getRandomName();
        $foto->move('uploads/foto', $fotoName);
    }

    $userModel->save([
        'nama_lengkap' => $this->request->getPost('nama_lengkap'),
        'username'     => $this->request->getPost('username'),
        'password'     => hash('sha256', $this->request->getPost('password')),
        'email'        => $this->request->getPost('email'),
        'no_hp'        => $this->request->getPost('no_hp'),
        'role'         => $this->request->getPost('role'),
        'foto'         => $fotoName
    ]);

    return redirect()->to('/admin/users')->with('success', 'User berhasil ditambahkan.');
}

    public function edit($id)
    {
        $data = [
            'user'  => $this->userModel->find($id),
            'guru'  => $this->guruModel->findAll(),
            'siswa' => $this->siswaModel->findAll()
        ];
        return view('admin/users/edit', $data);
    }

    public function update($id)
{
    $userModel = new UserModel();
    $user = $userModel->find($id);

    $data = [
        'nama_lengkap' => $this->request->getPost('nama_lengkap'),
        'username'     => $this->request->getPost('username'),
        'email'        => $this->request->getPost('email'),
        'no_hp'        => $this->request->getPost('no_hp'),
        'role'         => $this->request->getPost('role')
    ];

    $password = $this->request->getPost('password');
    if (!empty($password)) {
        $data['password'] = hash('sha256', $password);
    }

    $foto = $this->request->getFile('foto');
    if ($foto && $foto->isValid() && !$foto->hasMoved()) {
        $fotoName = $foto->getRandomName();
        $foto->move('uploads/foto', $fotoName);

        // Hapus foto lama jika ada
        if (!empty($user['foto']) && file_exists('uploads/foto/' . $user['foto'])) {
            unlink('uploads/foto/' . $user['foto']);
        }

        $data['foto'] = $fotoName;
    }

    $userModel->update($id, $data);

    return redirect()->to('/admin/users')->with('success', 'User berhasil diperbarui.');
}


    public function delete($id)
    {
        $this->userModel->delete($id);
        return redirect()->to('/admin/users')->with('success', 'User berhasil dihapus');
    }
}
