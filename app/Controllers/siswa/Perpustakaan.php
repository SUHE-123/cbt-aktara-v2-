<?php

namespace App\Controllers\Siswa;

use App\Controllers\BaseController;
use App\Models\KoleksiBukuModel;
use App\Models\JenisBukuModel;

class Perpustakaan extends BaseController
{
    protected $bukuModel;
    protected $jenisModel;

    public function __construct()
    {
        $this->bukuModel = new KoleksiBukuModel();
        $this->jenisModel = new JenisBukuModel();
    }

    // Menampilkan daftar buku dengan filter (Data Buku)
    public function index()
    {
        $jenisFilter = $this->request->getGet('jenis');
        $judulFilter = $this->request->getGet('judul');

        $data['judul']         = $judulFilter;
        $data['jenis']         = $jenisFilter;
        $data['jenis_buku']    = $this->jenisModel->findAll();
        $data['koleksi_buku']  = $this->bukuModel->getFiltered($jenisFilter, $judulFilter);

        return view('siswa/perpustakaan/index', $data);
    }

    // Menampilkan detail & baca buku (Baca Buku PDF tanpa download)
    public function baca($id_buku)
    {
        $buku = $this->bukuModel->getWithJenis()->where('id_buku', $id_buku)->first();

        if (!$buku || $buku['status'] !== 'tampil') {
            return redirect()->to('/siswa/perpustakaan')->with('error', 'Buku tidak ditemukan atau tidak tersedia.');
        }

        return view('siswa/perpustakaan/baca', ['buku' => $buku]);
    }
}
