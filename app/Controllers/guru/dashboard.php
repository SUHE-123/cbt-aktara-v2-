<?php

namespace App\Controllers\Guru;

use App\Controllers\BaseController;
use App\Models\SiswaModel;
use App\Models\MapelModel;
use App\Models\TokenModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $TokenModel = new TokenModel();
        $token = $TokenModel->find(1);

        // Jika guru tidak boleh melihat semua siswa, ini bisa disesuaikan nanti
        $data = [
            'jumlah_siswa'   => (new SiswaModel())->countAll(), // Opsional: batasi berdasarkan sekolah jika perlu
            'jumlah_mapel'   => (new MapelModel())->countAll(),
            'token_aktif'    => $token['token'] ?? '-'
        ];

        return view('guru/dashboard', $data);
    }
}
