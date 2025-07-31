<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SesiUjianModel;

class sesiujian extends BaseController
{
    protected $sesiModel;

    public function __construct()
    {
        $this->sesiModel = new SesiUjianModel();
    }

    public function index()
    {
        $data['sesi'] = $this->sesiModel->findAll();
        return view('admin/sesiujian/index', $data);
    }

    public function create()
    {
        return view('admin/sesiujian/create');
    }

    public function store()
    {
        $this->sesiModel->insert([
            'sesi'          => $this->request->getPost('sesi'),
            'kode'          => $this->request->getPost('kode'),
            'waktu_mulai'   => $this->request->getPost('waktu_mulai'),
            'waktu_selesai' => $this->request->getPost('waktu_selesai'),
        ]);
        

        return redirect()->to('/admin/sesiujian')->with('success', 'Sesi ujian berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data['sesi'] = $this->sesiModel->find($id);
        return view('admin/sesiujian/edit', $data);
    }

    public function update($id)
    {
        $this->sesiModel->update($id,[
            'sesi'          => $this->request->getPost('sesi'),
            'kode'          => $this->request->getPost('kode'),
            'waktu_mulai'   => $this->request->getPost('waktu_mulai'),
            'waktu_selesai' => $this->request->getPost('waktu_selesai'),
        ]);
        
        return redirect()->to('/admin/sesiujian')->with('success', 'Sesi ujian berhasil diperbarui.');
    }

    public function delete($id)
    {
        $this->sesiModel->delete($id);
        return redirect()->to('/admin/sesiujian')->with('success', 'Sesi ujian berhasil dihapus.');
    }
}
