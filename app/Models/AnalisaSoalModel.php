<?php

namespace App\Models;

use CodeIgniter\Model;

class AnalisaSoalModel extends Model
{
    protected $table            = 'analisa_soal';
    protected $primaryKey       = 'id_analisa';
    protected $allowedFields    = ['id_jadwal', 'id_nomor', 'id_soal', 'jawaban_siswa'];

    public function getAnalisaFiltered($id_jadwal = null, $id_bank = null)
    {
        $builder = $this->select('
                    analisa_soal.*,
                    nomor_peserta.nomor_peserta,
                    siswa.nama_lengkap,
                    siswa.kelas,
                    soal.soal,
                    soal.jawaban AS kunci_jawaban,
                    soal.bobot,
                    bank_soal.bank_code,
                    jadwal_ujian.id_jenis_ujian
                ')
                ->join('nomor_peserta', 'nomor_peserta.id_peserta = analisa_soal.id_nomor')
                ->join('siswa', 'siswa.id = nomor_peserta.id_siswa')
                ->join('soal', 'soal.id_soal = analisa_soal.id_soal')
                ->join('bank_soal', 'bank_soal.id_bank = soal.id_bank')
                ->join('jadwal_ujian', 'jadwal_ujian.id_jadwal = analisa_soal.id_jadwal');

        if (!empty($id_jadwal) && $id_jadwal !== 'all') {
            $builder->where('analisa_soal.id_jadwal', $id_jadwal);
        }

        if (!empty($id_bank) && $id_bank !== 'all') {
            $builder->where('soal.id_bank', $id_bank);
        }

        return $builder->orderBy('analisa_soal.id_analisa', 'ASC')->findAll();
    }
}
