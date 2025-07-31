<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisBukuModel extends Model
{
    protected $table      = 'jenis_buku';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_jenis_buku'];
    protected $useTimestamps = false;
}
