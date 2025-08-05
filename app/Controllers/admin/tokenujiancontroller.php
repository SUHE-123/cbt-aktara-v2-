<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TokenModel;

class TokenUjianController extends BaseController
{
    protected $tokenModel;

    public function __construct()
    {
        $this->tokenModel = new TokenModel();
    }

    public function index()
    {
        $token = $this->tokenModel->find(1); // ambil baris token tetap (id = 1)

        $data = [
            'token' => $token
        ];

        return view('admin/token/index', $data);
    }

    public function generate()
    {
        // Buat token acak (6 karakter A-Z)
        $newToken = strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 6));

        // Update ke baris id = 1
        $this->tokenModel->update(1, [
            'token' => $newToken
        ]);

        return redirect()->to('/admin/token')->with('success', 'Token berhasil digenerate ulang.');
    }
}
