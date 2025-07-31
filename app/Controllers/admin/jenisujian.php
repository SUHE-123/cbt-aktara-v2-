<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\JenisUjianModel;

class jenisujian extends BaseController
{
    protected $jenisModel;

    public function __construct()
    {
        $this->jenisModel = new JenisUjianModel();
    }

    public function index()
    {
        $data['jenisujian'] = $this->jenisModel->findAll();
        return view('admin/jenisujian/index', $data);
    }

    public function create()
    {
        return view('admin/jenisujian/create');
    }

    public function store()
    {
        $rules = [
            'jenis_ujian' => 'required|string',
            'kode_ujian'  => 'required|string|is_unique[jenis_ujian.kode_ujian]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
        }

        $this->jenisModel->insert([
            'jenis_ujian' => $this->request->getPost('jenis_ujian'),
            'kode_ujian'  => $this->request->getPost('kode_ujian')
        ]);

        return redirect()->to('/admin/jenisujian')->with('success', 'Jenis ujian berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data['jenis'] = $this->jenisModel->find($id);
        return view('admin/jenisujian/edit', $data);
    }

    public function update($id)
    {
        $rules = [
            'jenis_ujian' => 'required|string',
            'kode_ujian'  => 'required|string',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
        }

        $this->jenisModel->update($id, [
            'jenis_ujian' => $this->request->getPost('jenis_ujian'),
            'kode_ujian'  => $this->request->getPost('kode_ujian')
        ]);

        return redirect()->to('/admin/jenisujian')->with('success', 'Jenis ujian berhasil diperbarui.');
    }

    public function delete($id)
    {
        $this->jenisModel->delete($id);
        return redirect()->to('/admin/jenisujian')->with('success', 'Jenis ujian berhasil dihapus.');
    }
}
