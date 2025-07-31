<?php

namespace App\Models;

use CodeIgniter\Model;

class MapelModel extends Model
{
    protected $table      = 'mata_pelajaran';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'nama_mapel',
        'kode_mapel',
        'jenjang',
        'jurusan',
        'status',
        'guru_id'
    ];
}
