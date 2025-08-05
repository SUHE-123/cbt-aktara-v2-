<?php

namespace App\Controllers\Guru;

use App\Controllers\BaseController;
use App\Models\JadwalUjianModel;
use App\Models\MapelModel;
use App\Models\BankSoalModel;
use App\Models\JenisUjianModel;
use App\Models\SekolahModel;

class JadwalUjian extends BaseController
{
    protected $jadwalModel;
    protected $mapelModel;
    protected $bankSoalModel;
    protected $jenisUjianModel;
    protected $sekolahModel;

    public function __construct()
    {
        $this->jadwalModel     = new JadwalUjianModel();
        $this->mapelModel      = new MapelModel();
        $this->bankSoalModel   = new BankSoalModel();
        $this->jenisUjianModel = new JenisUjianModel();
        $this->sekolahModel    = new SekolahModel();
    }

    public function index()
    {
        $data['jadwal'] = $this->jadwalModel->getWithRelasi()->findAll();
        return view('guru/jadwalujian/index', $data);
    }

    public function create()
    {
        $data['mapel']      = $this->mapelModel->findAll();
        $data['bank']       = $this->bankSoalModel->findAll();
        $data['jenis']      = $this->jenisUjianModel->findAll();
        $data['sekolah']    = $this->sekolahModel->findAll();

        return view('guru/jadwalujian/create', $data);
    }

    public function store()
    {
        $this->jadwalModel->insert([
            'id_mapel'        => $this->request->getPost('id_mapel'),
            'id_bank'         => $this->request->getPost('id_bank'),
            'id_jenis_ujian'  => $this->request->getPost('id_jenis_ujian'),
            'tanggal_mulai'   => $this->request->getPost('tanggal_mulai'),
            'tanggal_tenggat' => $this->request->getPost('tanggal_tenggat'),
            'durasi'          => $this->request->getPost('durasi'),
            'durasi_minimal'  => $this->request->getPost('durasi_minimal'),
            'acak_soal'       => $this->request->getPost('acak_soal') === '1' ? 1 : 0,
            'token'           => $this->request->getPost('token') === '1' ? 1 : 0,
            'status'          => $this->request->getPost('status') === '1' ? 1 : 0,
            'id_sekolah'      => $this->request->getPost('id_sekolah'),
        ]);

        return redirect()->to('/guru/jadwalujian')->with('success', 'Jadwal ujian berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data['jadwal']     = $this->jadwalModel->find($id);
        $data['mapel']      = $this->mapelModel->findAll();
        $data['bank']       = $this->bankSoalModel->findAll();
        $data['jenis']      = $this->jenisUjianModel->findAll();
        $data['sekolah']    = $this->sekolahModel->findAll();

        return view('guru/jadwalujian/edit', $data);
    }

    public function update($id)
    {
        $this->jadwalModel->update($id, [
            'id_mapel'        => $this->request->getPost('id_mapel'),
            'id_bank'         => $this->request->getPost('id_bank'),
            'id_jenis_ujian'  => $this->request->getPost('id_jenis_ujian'),
            'tanggal_mulai'   => $this->request->getPost('tanggal_mulai'),
            'tanggal_tenggat' => $this->request->getPost('tanggal_tenggat'),
            'durasi'          => $this->request->getPost('durasi'),
            'durasi_minimal'  => $this->request->getPost('durasi_minimal'),
            'acak_soal'       => $this->request->getPost('acak_soal') === '1' ? 1 : 0,
            'token'           => $this->request->getPost('token') === '1' ? 1 : 0,
            'status'          => $this->request->getPost('status') === '1' ? 1 : 0,
            'id_sekolah'      => $this->request->getPost('id_sekolah'),
        ]);

        return redirect()->to('/guru/jadwalujian')->with('success', 'Jadwal ujian berhasil diperbarui.');
    }

    public function delete($id)
    {
        $this->jadwalModel->delete($id);
        return redirect()->to('/guru/jadwalujian')->with('success', 'Jadwal ujian berhasil dihapus.');
    }
}
