<?php

namespace App\Models;

use CodeIgniter\Model;

class SiswaModel extends Model
{
    protected $table = 'siswa';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nama_lengkap', 'nis', 'username', 'password', 'jenis_kelamin',
        'kelas', 'alamat', 'kontak', 'email', 'status_akun','user_id', 'sekolah_id'
    ];
    protected $useTimestamps = true;
}
