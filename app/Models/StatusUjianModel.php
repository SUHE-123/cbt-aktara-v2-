<?php

namespace App\Models;

use CodeIgniter\Model;

class StatusUjianModel extends Model
{
    protected $table = 'status_ujian';
    protected $primaryKey = 'id_status';

    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'id_peserta',
        'id_jadwal',
        'status',         // contoh: belum mulai, sedang ujian, selesai
        'waktu_mulai',
        'waktu_selesai',
        'skor',
        'jumlah_benar',
        'jumlah_salah',
        'jumlah_kosong'
    ];

    protected $useTimestamps = false;
}
