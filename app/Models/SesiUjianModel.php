<?php

namespace App\Models;

use CodeIgniter\Model;

class SesiUjianModel extends Model
{
    protected $table = 'sesi_ujian';
    protected $primaryKey = 'id_sesi';
    protected $allowedFields = ['sesi', 'kode', 'waktu_mulai', 'waktu_selesai'];
}
