<?php

namespace App\Controllers\Siswa;

use App\Controllers\BaseController;
use App\Models\JadwalUjianModel;
use App\Models\SoalModel;
use App\Models\NomorPesertaModel;
use App\Models\AnalisaSoalModel;

class PelaksanaanUjian extends BaseController
{
    protected $jadwalModel;
    protected $soalModel;
    protected $pesertaModel;
    protected $analisaModel;

    public function __construct()
    {
        $this->jadwalModel  = new JadwalUjianModel();
        $this->soalModel    = new SoalModel();
        $this->pesertaModel = new NomorPesertaModel();
        $this->analisaModel = new AnalisaSoalModel();
    }

    public function index($id_jadwal)
    {
        $id_siswa = session('siswa_id');

        // Ambil nomor peserta siswa
        $peserta = $this->pesertaModel->where('id_siswa', $id_siswa)->first();
        if (!$peserta) {
            return redirect()->to('siswa/dashboard')->with('error', 'Anda belum memiliki nomor peserta.');
        }

        // Cek jadwal
        $jadwal = $this->jadwalModel->find($id_jadwal);
        if (!$jadwal) {
            return redirect()->to('siswa/dashboard')->with('error', 'Jadwal ujian tidak ditemukan.');
        }

        // Ambil semua soal dari bank
        $soalList = $this->soalModel
            ->where('id_bank', $jadwal['id_bank'])
            ->orderBy('id_soal', 'ASC')
            ->findAll();

        // Cek apakah sudah ada entri analisa_soal
        $analisaList = $this->analisaModel
            ->where('id_jadwal', $id_jadwal)
            ->where('id_nomor', $peserta['id_peserta'])
            ->findAll();

        if (count($analisaList) < count($soalList)) {
            // Buat entri analisa jika belum ada
            foreach ($soalList as $soal) {
                $exists = $this->analisaModel
                    ->where('id_jadwal', $id_jadwal)
                    ->where('id_nomor', $peserta['id_peserta'])
                    ->where('id_soal', $soal['id_soal'])
                    ->first();

                if (!$exists) {
                    $this->analisaModel->insert([
                        'id_jadwal' => $id_jadwal,
                        'id_nomor'  => $peserta['id_peserta'],
                        'id_soal'   => $soal['id_soal'],
                        'jawaban_siswa' => null,
                    ]);
                }
            }
        }

        // Ambil ulang jawaban yang sudah tersimpan
        $jawabanMap = [];
        $jawabanData = $this->analisaModel
            ->where('id_jadwal', $id_jadwal)
            ->where('id_nomor', $peserta['id_peserta'])
            ->findAll();

        foreach ($jawabanData as $jawaban) {
            $jawabanMap[$jawaban['id_soal']] = $jawaban['jawaban_siswa'];
        }

        $data = [
            'judul'       => 'Pelaksanaan Ujian',
            'id_jadwal'   => $id_jadwal,
            'soalList'    => $soalList,
            'jawabanMap'  => $jawabanMap,
            'durasi'      => $jadwal['durasi'] ?? 30, // default 30 menit kalau null
        ];

        return view('siswa/ujian/pelaksanaan/index', $data);
    }

    public function simpanJawaban()
    {
        $id_jadwal = $this->request->getPost('id_jadwal');
        $jawaban   = $this->request->getPost('jawaban'); // format: [id_soal => 'A', ...]

        $id_siswa = session('siswa_id');
        $peserta = $this->pesertaModel->where('id_siswa', $id_siswa)->first();
        if (!$peserta) {
            return redirect()->back()->with('error', 'Peserta tidak ditemukan.');
        }

        foreach ($jawaban as $id_soal => $isi) {
            $this->analisaModel->where([
                    'id_jadwal' => $id_jadwal,
                    'id_nomor'  => $peserta['id_peserta'],
                    'id_soal'   => $id_soal
                ])
                ->set(['jawaban_siswa' => $isi])
                ->update();
        }

        return redirect()->to('siswa/dashboard')->with('success', 'Jawaban berhasil disimpan.');
    }
}
