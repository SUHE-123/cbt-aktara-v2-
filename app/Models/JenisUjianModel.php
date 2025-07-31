<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisUjianModel extends Model
{
    protected $table            = 'jenis_ujian';
    protected $primaryKey       = 'id_jenis_ujian';
    protected $allowedFields    = ['jenis_ujian', 'kode_ujian'];
    protected $useTimestamps    = false;
}
