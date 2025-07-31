<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\StatusUjianModel;
use App\Models\SiswaModel;
use App\Models\NomorPesertaModel;
use App\Models\JadwalUjianModel;
use App\Models\MataPelajaranModel;
use App\Models\JenisUjianModel;
use App\Models\SekolahModel;

class statusujiancontroller extends BaseController
{
    public function index()
    {
        $statusUjianModel = new StatusUjianModel();

        // Ambil semua data status ujian lengkap dengan relasi
        $statusUjian = $statusUjianModel
            ->select('
                status_ujian.*,
                siswa.nama_lengkap,
                siswa.kelas,
                users.username,
                jadwal_ujian.tanggal_mulai,
                jadwal_ujian.tanggal_tenggat,
                mata_pelajaran.nama_mapel,
                jenis_ujian.jenis_ujian,
                sekolah.nama_sekolah
            ')
            ->join('nomor_peserta', 'nomor_peserta.id_peserta = status_ujian.id_peserta')
            ->join('siswa', 'siswa.id = nomor_peserta.id_siswa')
            ->join('users', 'users.id = siswa.user_id', 'left')
            ->join('jadwal_ujian', 'jadwal_ujian.id_jadwal = status_ujian.id_jadwal')
            ->join('mata_pelajaran', 'mata_pelajaran.id = jadwal_ujian.id_mapel')
            ->join('jenis_ujian', 'jenis_ujian.id_jenis_ujian = jadwal_ujian.id_jenis_ujian')
            ->join('sekolah', 'sekolah.id = siswa.sekolah_id')
            ->orderBy('siswa.kelas')
            ->orderBy('siswa.nama_lengkap')
            ->findAll();

        return view('admin/statusujian/index', [
            'statusUjian' => $statusUjian
        ]);
    }
}
