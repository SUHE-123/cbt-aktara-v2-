<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalUjianModel extends Model
{
    protected $table      = 'jadwal_ujian';
    protected $primaryKey = 'id_jadwal';

    protected $allowedFields = [
        'id_mapel', 'id_bank', 'id_jenis_ujian', 'tanggal_mulai',
        'tanggal_tenggat', 'durasi', 'durasi_minimal',
        'acak_soal', 'token', 'status', 'id_sekolah'
    ];

    protected $useTimestamps = false;

    public function getWithRelasi()
    {
        return $this->select('jadwal_ujian.*, 
                              mata_pelajaran.nama_mapel, 
                              bank_soal.bank_code,
                              jenis_ujian.jenis_ujian,
                              sekolah.nama_sekolah')
                    ->join('mata_pelajaran', 'mata_pelajaran.id = jadwal_ujian.id_mapel', 'left')
                    ->join('bank_soal', 'bank_soal.id_bank = jadwal_ujian.id_bank', 'left')
                    ->join('jenis_ujian', 'jenis_ujian.id_jenis_ujian = jadwal_ujian.id_jenis_ujian', 'left')
                    ->join('sekolah', 'sekolah.id = jadwal_ujian.id_sekolah', 'left');
    }
    
    public function getSemuaJadwalAktif()
    {
        return $this->select('jadwal_ujian.*, 
                              mata_pelajaran.nama_mapel, 
                              bank_soal.bank_code,
                              jenis_ujian.jenis_ujian')
                    ->join('mata_pelajaran', 'mata_pelajaran.id = jadwal_ujian.id_mapel', 'left')
                    ->join('bank_soal', 'bank_soal.id_bank = jadwal_ujian.id_bank', 'left')
                    ->join('jenis_ujian', 'jenis_ujian.id_jenis_ujian = jadwal_ujian.id_jenis_ujian', 'left')
                    ->where('jadwal_ujian.status', 1)
                    ->orderBy('tanggal_mulai', 'DESC')
                    ->findAll();
    }
}
