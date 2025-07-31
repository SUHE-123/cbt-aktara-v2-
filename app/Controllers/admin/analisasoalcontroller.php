<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AnalisaSoalModel;
use App\Models\JadwalUjianModel;
use App\Models\BankSoalModel;

class AnalisaSoalController extends BaseController
{
    protected $analisaSoalModel;
    protected $jadwalUjianModel;
    protected $bankSoalModel;

    public function __construct()
    {
        $this->analisaSoalModel = new AnalisaSoalModel();
        $this->jadwalUjianModel = new JadwalUjianModel();
        $this->bankSoalModel = new BankSoalModel();
    }

    public function index()
    {
        // Ambil parameter filter dari URL (GET)
        $jadwalDipilih = $this->request->getGet('jadwal') ?? 'all';
        $bankDipilih = $this->request->getGet('bank') ?? 'all';

        // Ambil data untuk filter dropdown
        $daftarJadwal = $this->jadwalUjianModel->findAll();
        $daftarBank = $this->bankSoalModel->findAll();

        // Ambil data analisa berdasarkan filter
        $analisa = $this->analisaSoalModel->getAnalisaFiltered($jadwalDipilih, $bankDipilih);

        return view('admin/analisasoal/index', [
            'analisa' => $analisa,
            'daftarJadwal' => $daftarJadwal,
            'daftarBank' => $daftarBank,
            'jadwalDipilih' => $jadwalDipilih,
            'bankDipilih' => $bankDipilih
        ]);
    }
}
