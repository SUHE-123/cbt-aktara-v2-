<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AlokasiWaktuModel;
use App\Models\JadwalUjianModel;
use App\Models\SesiUjianModel;

class AlokasiWaktuController extends BaseController
{
    protected $alokasiModel;
    protected $jadwalModel;
    protected $sesiModel;

    public function __construct()
    {
        $this->alokasiModel = new AlokasiWaktuModel();
        $this->jadwalModel = new JadwalUjianModel();
        $this->sesiModel = new SesiUjianModel();
    }

    public function index()
    {
        $data = [
            'alokasi' => $this->alokasiModel->getWithRelations(),
        ];
        return view('admin/alokasiwaktu/index', $data);
    }

    public function create()
    {
        $data = [
            'jadwal' => $this->jadwalModel->findAll(),
            'sesi' => $this->sesiModel->findAll(),
        ];
        return view('admin/alokasiwaktu/create', $data);
    }

    public function store()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'id_jadwal' => 'required|integer',
            'id_sesi'   => 'required|integer',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $this->alokasiModel->insert([
            'id_jadwal' => $this->request->getPost('id_jadwal'),
            'id_sesi'   => $this->request->getPost('id_sesi'),
        ]);

        return redirect()->to('/admin/alokasiwaktu')->with('success', 'Alokasi waktu berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $alokasi = $this->alokasiModel->find($id);

        if (!$alokasi) {
            return redirect()->to('/admin/alokasiwaktu')->with('error', 'Data tidak ditemukan.');
        }

        $data = [
            'alokasi' => $alokasi,
            'jadwal' => $this->jadwalModel->findAll(),
            'sesi' => $this->sesiModel->findAll(),
        ];

        return view('admin/alokasiwaktu/edit', $data);
    }

    public function update($id)
    {
        $validation = \Config\Services::validation();

        $rules = [
            'id_jadwal' => 'required|integer',
            'id_sesi'   => 'required|integer',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $this->alokasiModel->update($id, [
            'id_jadwal' => $this->request->getPost('id_jadwal'),
            'id_sesi'   => $this->request->getPost('id_sesi'),
        ]);

        return redirect()->to('/admin/alokasiwaktu')->with('success', 'Alokasi waktu berhasil diperbarui.');
    }

    public function delete($id)
    {
        $this->alokasiModel->delete($id);
        return redirect()->to('/admin/alokasiwaktu')->with('success', 'Alokasi waktu berhasil dihapus.');
    }
}
