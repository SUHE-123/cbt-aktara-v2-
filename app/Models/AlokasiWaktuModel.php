<?php

namespace App\Models;

use CodeIgniter\Model;

class AlokasiWaktuModel extends Model
{
    protected $table = 'alokasi_waktu_ujian';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id_jadwal',
        'id_sesi'
    ];

    protected $useTimestamps = false;

    public function getWithRelations()
    {
        return $this->select('
                alokasi_waktu_ujian.*,
                jadwal_ujian.tanggal_mulai,
                jadwal_ujian.tanggal_tenggat,
                sesi_ujian.sesi,
                sesi_ujian.waktu_mulai,
                sesi_ujian.waktu_selesai,
                mata_pelajaran.nama_mapel,
                jenis_ujian.jenis_ujian
            ')
            ->join('jadwal_ujian', 'jadwal_ujian.id_jadwal = alokasi_waktu_ujian.id_jadwal')
            ->join('sesi_ujian', 'sesi_ujian.id_sesi = alokasi_waktu_ujian.id_sesi')
            ->join('mata_pelajaran', 'mata_pelajaran.id = jadwal_ujian.id_mapel', 'left')
            ->join('jenis_ujian', 'jenis_ujian.id_jenis_ujian = jadwal_ujian.id_jenis_ujian', 'left')
            ->orderBy('jadwal_ujian.tanggal_mulai', 'DESC')
            ->findAll();
    }
}
