<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthSiswa implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Cek apakah siswa sudah login
        if (!session()->get('is_siswa_logged_in')) {
            return redirect()->to('/login')->with('error', 'Silakan login sebagai siswa terlebih dahulu.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak ada tindakan setelah response
    }
}
