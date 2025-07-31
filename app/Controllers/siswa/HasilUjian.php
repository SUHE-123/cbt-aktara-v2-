<?php

namespace App\Controllers\Siswa;

use App\Controllers\BaseController;
use App\Models\HasilUjianModel;
use App\Models\NomorPesertaModel;
use App\Models\JadwalUjianModel;
use App\Models\MapelModel;
use App\Models\JenisUjianModel;


class HasilUjian extends BaseController
{
    protected $hasilModel;
    protected $pesertaModel;
    protected $jadwalModel;
    protected $mapelModel;
    protected $jenisUjianModel;

    public function __construct()
    {
        $this->hasilModel       = new HasilUjianModel();
        $this->pesertaModel     = new NomorPesertaModel();
        $this->jadwalModel      = new JadwalUjianModel();
        $this->mapelModel       = new MapelModel();
        $this->jenisUjianModel  = new JenisUjianModel();
    }

    public function index()
    {
        $id_siswa = session('siswa_id');

        if (!$id_siswa) {
            return redirect()->to('siswa/dashboard')->with('error', 'Akses ditolak.');
        }

        $peserta = $this->pesertaModel->where('id_siswa', $id_siswa)->first();

        if (!$peserta) {
            return redirect()->to('siswa/dashboard')->with('error', 'Nomor peserta tidak ditemukan.');
        }

        $id_mapel = $this->request->getGet('id_mapel');
        $id_jenis = $this->request->getGet('id_jenis_ujian');

        $hasil = $this->hasilModel
            ->select('hasil_ujian.*, siswa.nama_lengkap, siswa.kelas,
                      sekolah.nama_sekolah, soal.soal, soal.jawaban as kunci_jawaban,
                      analisa_soal.jawaban_siswa, jadwal_ujian.id_mapel, jadwal_ujian.id_jenis_ujian')
            ->join('status_ujian', 'status_ujian.id_status_ujian = hasil_ujian.id_status_ujian')
            ->join('jadwal_ujian', 'jadwal_ujian.id_jadwal = status_ujian.id_jadwal')
            ->join('siswa', 'siswa.id = status_ujian.id_peserta')
            ->join('sekolah', 'sekolah.id = siswa.sekolah_id')
            ->join('soal', 'soal.id_soal = hasil_ujian.id_soal')
            ->join('analisa_soal', 'analisa_soal.id_analisa = hasil_ujian.id_analisa')
            ->where('siswa.id', $id_siswa);

        if ($id_mapel) {
            $hasil->where('jadwal_ujian.id_mapel', $id_mapel);
        }

        if ($id_jenis) {
            $hasil->where('jadwal_ujian.id_jenis_ujian', $id_jenis);
        }

        $data = [
            'title'          => 'Hasil Ujian',
            'hasil_ujian'    => $hasil->findAll(),
            'mapel_options'  => $this->mapelModel->findAll(),
            'jenis_options'  => $this->jenisUjianModel->findAll(),
            'filter_mapel'   => $id_mapel,
            'filter_jenis'   => $id_jenis
        ];

        return view('siswa/ujian/hasil/index', $data);
    }
}
