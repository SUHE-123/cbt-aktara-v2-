<?php

namespace App\Controllers\Guru;

use App\Controllers\BaseController;
use App\Models\KoleksiBukuModel;
use App\Models\JenisBukuModel;

class koleksibuku extends BaseController
{
    protected $bukuModel;
    protected $jenisModel;

    public function __construct()
    {
        $this->bukuModel = new KoleksiBukuModel();
        $this->jenisModel = new JenisBukuModel();
    }

    public function index()
    {
        $data['koleksi'] = $this->bukuModel
            ->select('koleksi_buku.*, jenis_buku.nama_jenis_buku')
            ->join('jenis_buku', 'jenis_buku.id = koleksi_buku.id_jenis_buku')
            ->findAll();
        return view('guru/koleksibuku/index', $data);
    }

    public function create()
    {
        $data['jenis'] = $this->jenisModel->findAll();
        return view('guru/koleksibuku/create', $data);
    }

        public function store()
    {
        /* ---------- VALIDASI ---------- */
        $rules = [
            'id_jenis_buku' => 'required|integer',
            'judul'         => 'required|string',
            'file_pdf'      => 'uploaded[file_pdf]|ext_in[file_pdf,pdf]|max_size[file_pdf,2097152]',   // 2 GB = 2 097 152 KB
            'cover'         => 'if_exist|ext_in[cover,jpg,jpeg,png]|max_size[cover,5120]'              // 5 MB cover
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
        }

        /* ---------- HANDLE FILE ---------- */
        $filePdf   = $this->request->getFile('file_pdf');
        $fileCover = $this->request->getFile('cover');

        $pdfName   = $filePdf->getRandomName();
        $coverName = $fileCover && $fileCover->isValid() && !$fileCover->hasMoved()
                    ? $fileCover->getRandomName()
                    : null;

        $filePdf->move('uploads/pdf',   $pdfName);
        if ($coverName) $fileCover->move('uploads/cover', $coverName);

        /* ---------- SIMPAN DB ---------- */
        $this->bukuModel->insert([
            'id_jenis_buku' => $this->request->getPost('id_jenis_buku'),
            'judul'         => $this->request->getPost('judul'),
            'deskripsi'     => $this->request->getPost('deskripsi'),
            'pengarang'     => $this->request->getPost('pengarang'),
            'penerbit'      => $this->request->getPost('penerbit'),
            'tahun_terbit'  => $this->request->getPost('tahun_terbit'),
            'file_pdf'      => $pdfName,
            'cover'         => $coverName,
            'status'        => $this->request->getPost('status'),
        ]);

        return redirect()->to('/guru/koleksibuku')
                        ->with('success', 'Koleksi buku berhasil ditambahkan.');
    }


    public function edit($id)
    {
        $data['buku'] = $this->bukuModel->find($id);
        $data['jenis'] = $this->jenisModel->findAll();
        return view('guru/koleksibuku/edit', $data);
    }

    public function update($id)
{
    $rules = [
        'id_jenis_buku' => 'required|integer',
        'judul'         => 'required|string',
        'file_pdf'      => 'if_exist|ext_in[file_pdf,pdf]|max_size[file_pdf,2097152]',
        'cover'         => 'if_exist|ext_in[cover,jpg,jpeg,png]|max_size[cover,5120]'
    ];

    if (!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
    }

    $buku       = $this->bukuModel->find($id);
    $filePdf    = $this->request->getFile('file_pdf');
    $fileCover  = $this->request->getFile('cover');

    // PDF
    if ($filePdf && $filePdf->isValid() && !$filePdf->hasMoved()) {
        $pdfName = $filePdf->getRandomName();
        $filePdf->move('uploads/pdf', $pdfName);
        // hapus file lama jika ada
        if (!empty($buku['file_pdf'])) @unlink('uploads/pdf/'.$buku['file_pdf']);
    } else {
        $pdfName = $buku['file_pdf'];
    }

    // Cover
    if ($fileCover && $fileCover->isValid() && !$fileCover->hasMoved()) {
        $coverName = $fileCover->getRandomName();
        $fileCover->move('uploads/cover', $coverName);
        if (!empty($buku['cover'])) @unlink('uploads/cover/'.$buku['cover']);
    } else {
        $coverName = $buku['cover'];
    }

    $this->bukuModel->update($id, [
        'id_jenis_buku' => $this->request->getPost('id_jenis_buku'),
        'judul'         => $this->request->getPost('judul'),
        'deskripsi'     => $this->request->getPost('deskripsi'),
        'pengarang'     => $this->request->getPost('pengarang'),
        'penerbit'      => $this->request->getPost('penerbit'),
        'tahun_terbit'  => $this->request->getPost('tahun_terbit'),
        'file_pdf'      => $pdfName,
        'cover'         => $coverName,
        'status'        => $this->request->getPost('status'),
    ]);

    return redirect()->to('/guru/koleksibuku')
                     ->with('success', 'Koleksi buku berhasil diperbarui.');
}
    public function delete($id)
    {
        $this->bukuModel->delete($id);
        return redirect()->to('/guru/koleksibuku')->with('success', 'Koleksi buku berhasil dihapus.');
    }
}
