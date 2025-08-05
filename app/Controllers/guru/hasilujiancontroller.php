<?php

namespace App\Controllers\Guru;

use App\Controllers\BaseController;
use App\Models\HasilUjianModel;
use App\Models\SiswaModel;
use App\Models\StatusUjianModel;
use App\Models\SekolahModel;

class HasilUjianController extends BaseController
{
    protected $hasilUjianModel;
    protected $statusUjianModel;
    protected $siswaModel;
    protected $sekolahModel;

    public function __construct()
    {
        $this->hasilUjianModel = new HasilUjianModel();
        $this->statusUjianModel = new StatusUjianModel();
        $this->siswaModel = new SiswaModel();
        $this->sekolahModel = new SekolahModel();
    }

    public function index()
    {
        $kelasDipilih    = $this->request->getGet('kelas');
        $sekolahDipilih  = $this->request->getGet('sekolah');
        $siswaDipilih    = $this->request->getGet('siswa');

        // Dropdown filter
        $daftarKelas     = $this->siswaModel->select('kelas')->distinct()->orderBy('kelas')->findAll();
        $daftarSekolah   = $this->sekolahModel->findAll();
        $daftarSiswa     = $this->siswaModel->select('id, nama_lengkap')->orderBy('nama_lengkap')->findAll();

        // Data hasil ujian berdasarkan filter
        if (!empty($siswaDipilih) && $siswaDipilih !== 'all') {
            $hasilUjian = $this->hasilUjianModel->getBySiswa($siswaDipilih);
        } elseif (!empty($kelasDipilih) && $kelasDipilih !== 'all') {
            $hasilUjian = $this->hasilUjianModel->getByKelas($kelasDipilih);
        } elseif (!empty($sekolahDipilih) && $sekolahDipilih !== 'all') {
            $hasilUjian = $this->hasilUjianModel->getBySekolah($sekolahDipilih);
        } else {
            $hasilUjian = $this->hasilUjianModel->getHasilUjianLengkap();
        }

        return view('guru/hasilujian/index', [
            'hasilUjian'     => $hasilUjian,
            'daftarKelas'    => $daftarKelas,
            'daftarSekolah'  => $daftarSekolah,
            'daftarSiswa'    => $daftarSiswa,
            'kelasDipilih'   => $kelasDipilih,
            'sekolahDipilih' => $sekolahDipilih,
            'siswaDipilih'   => $siswaDipilih
        ]);
    }

    public function detail($id_status_ujian)
    {
        $data = $this->hasilUjianModel->getByStatusUjian($id_status_ujian);

        return view('guru/hasilujian/detail', [
            'data' => $data,
            'id_status_ujian' => $id_status_ujian
        ]);
    }
}
