<?php

namespace App\Controllers\Guru;

use App\Controllers\BaseController;
use App\Models\MapelModel;
use App\Models\GuruModel;

class mapel extends BaseController
{
    protected $mapelModel;
    protected $guruModel;

    public function __construct()
    {
        $this->mapelModel = new MapelModel();
        $this->guruModel = new GuruModel();
    }

    // Tampilkan semua mata pelajaran
    public function index()
    {
        $data['mapel'] = $this->mapelModel
        ->select('mata_pelajaran.*, guru.nama_lengkap as nama_guru')
        ->join('guru', 'guru.id = mata_pelajaran.guru_id', 'left')
        ->findAll();
        return view('guru/mapel/index', $data);
    }

    // Form tambah mata pelajaran
    public function create()
    {
        $data['guru'] = $this->guruModel->findAll();

        return view('guru/mapel/create', $data);
    }

    // Proses simpan mata pelajaran
    public function store()
    {
        $this->mapelModel->insert([
            'nama_mapel'  => $this->request->getPost('nama_mapel'),
            'kode_mapel'  => $this->request->getPost('kode_mapel'),
            'jenjang'     => $this->request->getPost('jenjang'),
            'jurusan'     => $this->request->getPost('jurusan'),
            'status'      => $this->request->getPost('status'),
            'guru_id'     => $this->request->getPost('guru_id'),
        ]);

        return redirect()->to('/guru/mapel')->with('success', 'Mata pelajaran berhasil ditambahkan.');
    }

    // Form edit
    public function edit($id)
    {
        $data['mapel'] = $this->mapelModel->find($id);
        $data['guru'] = $this->guruModel->findAll();
        return view('guru/mapel/edit', $data);
    }

    // Proses update
    public function update($id)
    {
        $this->mapelModel->update($id, [
            'nama_mapel'  => $this->request->getPost('nama_mapel'),
            'kode_mapel'  => $this->request->getPost('kode_mapel'),
            'jenjang'     => $this->request->getPost('jenjang'),
            'jurusan'     => $this->request->getPost('jurusan'),
            'status'      => $this->request->getPost('status'),
            'guru_id'     => $this->request->getPost('guru_id'),
        ]);

        return redirect()->to('/guru/mapel')->with('success', 'Mata pelajaran berhasil diperbarui.');
    }

    // Proses hapus
    public function delete($id)
    {
        $this->mapelModel->delete($id);
        return redirect()->to('/guru/mapel')->with('success', 'Mata pelajaran berhasil dihapus.');
    }
}
