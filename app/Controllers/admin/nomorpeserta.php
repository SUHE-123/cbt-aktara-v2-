<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\NomorPesertaModel;
use App\Models\SiswaModel;

class NomorPeserta extends BaseController
{
    protected $pesertaModel;
    protected $siswaModel;

    public function __construct()
    {
        $this->pesertaModel = new NomorPesertaModel();
        $this->siswaModel   = new SiswaModel();
    }

    public function index()
{
    $data['peserta'] = $this->pesertaModel
        ->select('nomor_peserta.*, siswa.nama_lengkap')
        ->join('siswa', 'siswa.id = nomor_peserta.id_siswa')
        ->findAll();

    return view('admin/nomorpeserta/index', $data);
}


    public function create()
    {
        $data['siswa'] = $this->siswaModel->findAll();
        return view('admin/nomorpeserta/create', $data);
    }

    public function store()
    {
        $this->pesertaModel->insert([
            'id_siswa'       => $this->request->getPost('id_siswa'),
            'nomor_peserta'  => $this->request->getPost('nomor_peserta')
        ]);

        return redirect()->to('/admin/nomorpeserta')->with('success', 'Nomor peserta berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data['peserta'] = $this->pesertaModel->find($id);
        $data['siswa']   = $this->siswaModel->findAll();
        return view('admin/nomorpeserta/edit', $data);
    }

    public function update($id)
    {
        $this->pesertaModel->update($id, [
            'id_siswa'       => $this->request->getPost('id_siswa'),
            'nomor_peserta'  => $this->request->getPost('nomor_peserta')
        ]);

        return redirect()->to('/admin/nomorpeserta')->with('success', 'Nomor peserta berhasil diperbarui.');
    }

    public function delete($id)
    {
        $this->pesertaModel->delete($id);
        return redirect()->to('/admin/nomorpeserta')->with('success', 'Nomor peserta berhasil dihapus.');
    }
}
