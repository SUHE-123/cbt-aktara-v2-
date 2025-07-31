<?php

namespace App\Controllers\Siswa;

use App\Controllers\BaseController;
use App\Models\JadwalUjianModel;

class KonfirmasiUjian extends BaseController
{
    protected $jadwalUjianModel;

    public function __construct()
    {
        $this->jadwalUjianModel = new JadwalUjianModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Konfirmasi Ujian',
            'jadwal_ujian' => $this->jadwalUjianModel->getSemuaJadwalAktif(), // ✅ tidak filter sekolah
        ];

        return view('siswa/ujian/konfirmasi/index', $data);
    }

            public function konfirmasi()
        {
            $id_jadwal    = $this->request->getPost('id_jadwal');
            $input_token  = trim($this->request->getPost('token_ujian'));

            $jadwal = $this->jadwalUjianModel->find($id_jadwal);
            if (!$jadwal) {
                return redirect()->back()->with('error', 'Jadwal ujian tidak ditemukan.');
            }

            // Jika ujian pakai token
            if ($jadwal['token'] == 1) {
                $tokenModel = new \App\Models\TokenModel();
                $tokenAktif = $tokenModel->orderBy('waktu_dibuat', 'DESC')->first();

                if (!$tokenAktif || $tokenAktif['token'] !== $input_token) {
                    return redirect()->back()->with('error', 'Token ujian tidak valid.');
                }
            }

            // Simpan status konfirmasi
            session()->set('ujian_terkonfirmasi_' . $id_jadwal, true);

            return redirect()->to(base_url('siswa/ujian/pelaksanaan/' . $id_jadwal));
        }

}
