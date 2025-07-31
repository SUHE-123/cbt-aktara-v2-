<?php
namespace App\Models;

use CodeIgniter\Model;

class TokenModel extends Model
{
    protected $table = 'token_ujian';
    protected $primaryKey = 'id';
    protected $allowedFields = ['token', 'waktu_dibuat'];
    public $useTimestamps = false;
}
