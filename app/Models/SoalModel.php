<?php

namespace App\Models;

use CodeIgniter\Model;

class SoalModel extends Model
{
    protected $table = 'soal';
    protected $primaryKey = 'id_soal';

    protected $allowedFields = [
        'id_bank',
        'soal',
        'opsi_a', 'opsi_b', 'opsi_c', 'opsi_d', 'opsi_e',
        'jawaban',
        'file_soal', 'file_a', 'file_b', 'file_c', 'file_d', 'file_e',
        'bobot'
    ];    
}
