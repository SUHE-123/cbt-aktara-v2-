<?php

namespace App\Controllers\Siswa;

use App\Controllers\BaseController;
use App\Models\JadwalUjianModel;
use App\Models\KoleksiBukuModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $siswaId = session()->get('siswa_id');

        // ✅ Tidak perlu cek sekolah_id
        $jadwalModel = new JadwalUjianModel();
        $jadwalUjian = $jadwalModel->getSemuaJadwalAktif(); // ✅ Ambil semua jadwal tanpa filter sekolah

        $bukuModel = new KoleksiBukuModel();
        $bukuTerbaru = $bukuModel
            ->orderBy('created_at', 'DESC')
            ->limit(5)
            ->findAll();

        $data = [
            'judul'         => 'Dashboard Siswa',
            'jadwal_ujian'  => $jadwalUjian,
            'buku_terbaru'  => $bukuTerbaru
        ];

        return view('siswa/dashboard', $data);
    }
}
