<?php

namespace App\Controllers\Siswa;

use App\Controllers\BaseController;
use App\Models\JadwalUjianModel;

class Home extends BaseController
{
    protected $jadwalUjianModel;

    public function __construct()
    {
        $this->jadwalUjianModel = new JadwalUjianModel();
    }

    public function index()
    {
        $id_sekolah = session()->get('id_sekolah'); // dari session siswa
        $tanggal_hari_ini = date('Y-m-d');

        // Ujian Hari Ini
        $ujian_hari_ini = $this->jadwalUjianModel->getWithRelasi()
            ->where('jadwal_ujian.tanggal_mulai', $tanggal_hari_ini)
            ->where('jadwal_ujian.id_sekolah', $id_sekolah)
            ->where('jadwal_ujian.status', 'aktif')
            ->orderBy('jadwal_ujian.tanggal_mulai', 'ASC')
            ->findAll();

        // Ujian Sebelumnya
        $ujian_sebelumnya = $this->jadwalUjianModel->getWithRelasi()
            ->where('jadwal_ujian.tanggal_mulai <', $tanggal_hari_ini)
            ->where('jadwal_ujian.id_sekolah', $id_sekolah)
            ->whereIn('jadwal_ujian.status', ['aktif', 'selesai'])
            ->orderBy('jadwal_ujian.tanggal_mulai', 'DESC')
            ->findAll();

        $data = [
            'title'            => 'Home Ujian',
            'ujian_hari_ini'   => $ujian_hari_ini,
            'ujian_sebelumnya' => $ujian_sebelumnya
        ];

        return view('siswa/ujian/index', $data);
    }
}
