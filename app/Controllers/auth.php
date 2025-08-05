<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    // Halaman login
    public function login()
    {
        return view('auth/login');
    }

    // Proses login
    public function loginProcess()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        $user = $userModel->where('username', $username)->first();

        if ($user && hash('sha256', $password) === $user['password']) {

            // Set data umum ke session
            $sessionData = [
                'id'           => $user['id'],
                'username'     => $user['username'],
                'role'         => $user['role'],
                'nama_lengkap' => $user['nama_lengkap'],
                'foto'         => $user['foto'] ?? 'suhe formal.jpg',
                'logged_in'    => true
            ];

            // Set session role & redirect sesuai hak akses
            switch ($user['role']) {
                case 'admin':
                    $sessionData['is_admin_logged_in'] = true;
                    session()->set($sessionData);
                    return redirect()->to('/admin/dashboard');

                case 'guru':
                    $sessionData['is_guru_logged_in'] = true;
                    session()->set($sessionData);
                    return redirect()->to('/guru/dashboard');

                case 'siswa':
                    $sessionData['is_siswa_logged_in'] = true;
                    $sessionData['siswa_id'] = $user['id']; // ✅ Tambahkan siswa_id agar bisa dipakai di fitur siswa
                    session()->set($sessionData);
                    return redirect()->to('/siswa/dashboard');

                default:
                    return redirect()->back()->with('error', 'Role tidak dikenali.');
            }
        }

        // Gagal login
        return redirect()->back()->with('error', 'Username atau Password salah');
    }

    // Logout
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
