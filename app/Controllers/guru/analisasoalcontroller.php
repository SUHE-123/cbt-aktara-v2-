<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AnalisaSoalModel;
use App\Models\JadwalUjianModel;
use App\Models\NomorPesertaModel;
use App\Models\SiswaModel;
use App\Models\SoalModel;

class AnalisaSoalController extends BaseController
{
    protected $analisaModel;
    protected $jadwalModel;
    protected $pesertaModel;
    protected $siswaModel;
    protected $soalModel;

    public function __construct()
    {
        $this->analisaModel = new AnalisaSoalModel();
        $this->jadwalModel = new JadwalUjianModel();
        $this->pesertaModel = new NomorPesertaModel();
        $this->siswaModel = new SiswaModel();
        $this->soalModel = new SoalModel();
    }

    public function index()
    {
        $analisaList = $this->analisaModel->findAll();
        $data = [];

        foreach ($analisaList as $row) {
            $peserta = $this->pesertaModel->find($row['id_nomor']);
            $siswa = $this->siswaModel->find($peserta['id_siswa']);
            $soal = $this->soalModel->find($row['id_soal']);
            $jadwal = $this->jadwalModel->find($row['id_jadwal']);

            $data[] = [
                'nama_siswa'      => $siswa['nama_lengkap'] ?? '-',
                'nomor_peserta'   => $peserta['nomor_peserta'] ?? '-',
                'soal'            => $soal['soal'] ?? '-',
                'jawaban_siswa'   => $row['jawaban_siswa'],
                'jawaban_benar'   => $soal['jawaban'] ?? '-',
                'skor'            => $row['jawaban_siswa'] == ($soal['jawaban'] ?? null) ? 1 : 0,
                'nama_ujian'      => $jadwal['nama_ujian'] ?? '-',
            ];
        }

        return view('admin/analisasoal/index', ['analisa' => $data]);
    }
}
