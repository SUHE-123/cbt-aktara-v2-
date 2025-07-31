<?php

namespace App\Models;

use CodeIgniter\Model;

class NomorPesertaModel extends Model
{
    protected $table            = 'nomor_peserta';
    protected $primaryKey       = 'id_peserta';
    protected $allowedFields    = ['id_siswa', 'nomor_peserta'];
    protected $useTimestamps    = false;

    // Fungsi untuk mendapatkan data dengan informasi siswa
    public function getWithSiswa()
    {
        return $this->select('nomor_peserta.*, siswa.nama_lengkap AS nama_siswa, siswa.nis')
                    ->join('siswa', 'siswa.id = nomor_peserta.id_siswa');
    }
}
