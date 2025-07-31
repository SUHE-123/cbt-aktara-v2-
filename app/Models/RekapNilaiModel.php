<?php

namespace App\Models;

use CodeIgniter\Model;

class RekapNilaiModel extends Model
{
    protected $table = 'hasil_ujian';

    public function getRekapNilai()
    {
        return $this->buildBaseQuery()->findAll();
    }

    public function getByKelas($kelas)
    {
        return $this->buildBaseQuery(['siswa.kelas' => $kelas])->findAll();
    }

    public function getBySekolah($id_sekolah)
    {
        return $this->buildBaseQuery(['siswa.sekolah_id' => $id_sekolah])->findAll();
    }

    public function getByMapel($id_mapel)
    {
        return $this->buildBaseQuery(['jadwal_ujian.id_mapel' => $id_mapel])->findAll();
    }

    public function getByUjian($id_jadwal)
    {
        return $this->buildBaseQuery(['jadwal_ujian.id_jadwal' => $id_jadwal])->findAll();
    }

    public function getFilteredRekap($filters = [])
    {
        return $this->buildBaseQuery($filters)->findAll();
    }

    protected function buildBaseQuery($where = [])
    {
        $builder = $this->select('
                status_ujian.id_status_ujian,
                status_ujian.id_peserta,
                siswa.nama_lengkap,
                siswa.kelas,
                sekolah.nama_sekolah,
                mata_pelajaran.nama_mapel,
                jadwal_ujian.id_jenis_ujian,
                COUNT(hasil_ujian.id_hasil) AS total_soal,
                SUM(CASE 
                        WHEN soal.jawaban = analisa_soal.jawaban_siswa 
                        THEN 1 ELSE 0 
                    END) AS jumlah_benar,
                ROUND(SUM(CASE 
                        WHEN soal.jawaban = analisa_soal.jawaban_siswa 
                        THEN 1 ELSE 0 
                    END) / COUNT(hasil_ujian.id_hasil) * 100, 2) AS nilai
            ')
            ->join('status_ujian', 'status_ujian.id_status_ujian = hasil_ujian.id_status_ujian')
            ->join('nomor_peserta', 'nomor_peserta.id_peserta = status_ujian.id_peserta')
            ->join('siswa', 'siswa.id = nomor_peserta.id_siswa')
            ->join('sekolah', 'sekolah.id = siswa.sekolah_id')
            ->join('jadwal_ujian', 'jadwal_ujian.id_jadwal = status_ujian.id_jadwal')
            ->join('mata_pelajaran', 'mata_pelajaran.id = jadwal_ujian.id_mapel')
            ->join('analisa_soal', 'analisa_soal.id_analisa = hasil_ujian.id_analisa')
            ->join('soal', 'soal.id_soal = hasil_ujian.id_soal')
            ->groupBy('status_ujian.id_status_ujian')
            ->orderBy('siswa.kelas');

        if (!empty($where)) {
            $builder->where($where);
        }

        return $builder;
    }

    public function getFilters()
    {
        return [
            'kelas' => $this->db->table('siswa')->select('kelas')->distinct()->orderBy('kelas')->get()->getResultArray(),
            'sekolah' => $this->db->table('sekolah')->select('id, nama_sekolah')->orderBy('nama_sekolah')->get()->getResultArray(),
            'mata_pejaran' => $this->db->table('mata_pelajaran')->select('id_mapel, nama_mapel')->orderBy('nama_mapel')->get()->getResultArray(),
            'ujian' => $this->db->table('jadwal_ujian')->select('id_jadwal, id_jenis_jadwal')->orderBy('id_jenis_Jadwal')->get()->getResultArray(),
        ];
    }
}
