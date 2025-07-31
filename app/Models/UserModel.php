<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'username', 'password', 'nama_lengkap', 'email', 'no_hp',
        'foto', 'role', 'guru_id', 'siswa_id'
    ];
    protected $useTimestamps    = true;

    // Optional: Get user with linked guru/siswa name
    public function getWithRelasi()
    {
        return $this->select('users.*, 
                              guru.nama_lengkap AS nama_guru, 
                              siswa.nama_lengkap AS nama_siswa')
                    ->join('guru', 'guru.id = users.guru_id', 'left')
                    ->join('siswa', 'siswa.id = users.siswa_id', 'left');
    }
}
