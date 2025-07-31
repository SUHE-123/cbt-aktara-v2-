<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\JenisBukuModel;

class jenisbuku extends BaseController
{
    protected $jenisBukuModel;

    public function __construct()
    {
        $this->jenisBukuModel = new JenisBukuModel();
    }

    // Tampilkan daftar jenis buku
    public function index()
    {
        $data['jenis_buku'] = $this->jenisBukuModel->findAll();
        return view('admin/jenisbuku/index', $data);
    }

    // Form tambah jenis buku
    public function create()
    {
        
        return view('admin/jenisbuku/create');
    }

    // Simpan data jenis buku
    public function store()
    {
        $this->jenisBukuModel->insert([
            'nama_jenis_buku' => $this->request->getPost('nama_jenis_buku'),
        ]);

        return redirect()->to('/admin/jenisbuku')->with('success', 'Jenis buku berhasil ditambahkan.');
    }

    // Form edit
    public function edit($id)
    {
        $data['jenisbuku'] = $this->jenisBukuModel->find($id);
        return view('admin/jenisbuku/edit', $data);
    }

    // Update data
    public function update($id)
    {
        $this->jenisBukuModel->update($id, [
            'nama_jenis_buku' => $this->request->getPost('nama_jenis_buku'),
        ]);

        return redirect()->to('/admin/jenisbuku')->with('success', 'Jenis buku berhasil diperbarui.');
    }

    // Hapus jenis buku
    public function delete($id)
    {
        $this->jenisBukuModel->delete($id);
        return redirect()->to('/admin/jenisbuku')->with('success', 'Jenis buku berhasil dihapus.');
    }
}
