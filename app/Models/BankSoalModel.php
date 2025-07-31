<?php

namespace App\Models;

use CodeIgniter\Model;

class BankSoalModel extends Model
{
    protected $table            = 'bank_soal';
    protected $primaryKey       = 'id_bank';
    protected $allowedFields    = ['bank_code', 'id_mapel', 'jumlah_soal'];
    protected $useTimestamps    = false;

    // Optional: relasi dengan tabel mapel (jika ingin digunakan nanti)
    public function getWithMapel()
    {
        return $this->select('bank_soal.*, mata_pelajaran.nama_mapel')
                    ->join('mata_pelajaran', 'mata_pelajaran.id = bank_soal.id_mapel', 'left');
    }
}
