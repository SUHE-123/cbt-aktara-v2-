<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SiswaModel;
use App\Models\GuruModel;
use App\Models\SekolahModel;
use App\Models\MapelModel;
use App\Models\TokenModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $TokenModel = new TokenModel();
        $token = $TokenModel->find(1); 
        $data = [
            'jumlah_siswa'   => (new SiswaModel())->countAll(),
            'jumlah_guru'    => (new GuruModel())->countAll(),
            'jumlah_sekolah' => (new SekolahModel())->countAll(),
            'jumlah_mapel'   => (new MapelModel())->countAll(),
            'token_aktif' => $token['token'] ?? '-'
        ];

        return view('admin/dashboard', $data);
    }
    
}
