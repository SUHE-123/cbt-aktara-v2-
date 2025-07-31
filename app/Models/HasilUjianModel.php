<?php

namespace App\Models;

use CodeIgniter\Model;

class HasilUjianModel extends Model
{
    protected $table = 'hasil_ujian';
    protected $primaryKey = 'id_hasil';
    protected $allowedFields = ['id_status_ujian', 'id_analisa', 'id_soal'];

    public function getHasilUjianLengkap()
    {
        return $this->select('
                hasil_ujian.*,
                status_ujian.id_jadwal,
                status_ujian.id_peserta,
                analisa_soal.jawaban_siswa,
                soal.soal,
                soal.jawaban as kunci_jawaban,
                siswa.nama_lengkap,
                siswa.kelas,
                sekolah.nama_sekolah
            ')
            ->join('status_ujian', 'status_ujian.id_status_ujian = hasil_ujian.id_status_ujian')
            ->join('analisa_soal', 'analisa_soal.id_analisa = hasil_ujian.id_analisa')
            ->join('soal', 'soal.id_soal = hasil_ujian.id_soal')
            ->join('siswa', 'siswa.id = status_ujian.id_peserta')
            ->join('sekolah', 'sekolah.id = siswa.sekolah_id')
            ->orderBy('siswa.kelas')
            ->orderBy('siswa.nama_lengkap')
            ->findAll();
    }

    public function getByStatusUjian($id_status_ujian)
    {
        return $this->where('hasil_ujian.id_status_ujian', $id_status_ujian)
            ->join('analisa_soal', 'analisa_soal.id_analisa = hasil_ujian.id_analisa')
            ->join('soal', 'soal.id_soal = hasil_ujian.id_soal')
            ->findAll();
    }

    public function getByKelas($kelas)
    {
        return $this->select('
                hasil_ujian.*, siswa.nama_lengkap, siswa.kelas,
                sekolah.nama_sekolah,
                soal.soal, soal.jawaban as kunci_jawaban,
                analisa_soal.jawaban_siswa
            ')
            ->join('status_ujian', 'status_ujian.id_status_ujian = hasil_ujian.id_status_ujian')
            ->join('siswa', 'siswa.id = status_ujian.id_peserta')
            ->join('sekolah', 'sekolah.id = siswa.sekolah_id')
            ->join('soal', 'soal.id_soal = hasil_ujian.id_soal')
            ->join('analisa_soal', 'analisa_soal.id_analisa = hasil_ujian.id_analisa')
            ->where('siswa.kelas', $kelas)
            ->findAll();
    }

    public function getBySekolah($id_sekolah)
    {
        return $this->select('
                hasil_ujian.*, siswa.nama_lengkap, siswa.kelas,
                sekolah.nama_sekolah,
                soal.soal, soal.jawaban as kunci_jawaban,
                analisa_soal.jawaban_siswa
            ')
            ->join('status_ujian', 'status_ujian.id_status_ujian = hasil_ujian.id_status_ujian')
            ->join('siswa', 'siswa.id = status_ujian.id_peserta')
            ->join('sekolah', 'sekolah.id = siswa.sekolah_id')
            ->join('soal', 'soal.id_soal = hasil_ujian.id_soal')
            ->join('analisa_soal', 'analisa_soal.id_analisa = hasil_ujian.id_analisa')
            ->where('sekolah.id', $id_sekolah)
            ->findAll();
    }

    public function getBySiswa($id_siswa)
    {
        return $this->select('
                hasil_ujian.*, siswa.nama_lengkap, siswa.kelas,
                sekolah.nama_sekolah,
                soal.soal, soal.jawaban as kunci_jawaban,
                analisa_soal.jawaban_siswa
            ')
            ->join('status_ujian', 'status_ujian.id_status_ujian = hasil_ujian.id_status_ujian')
            ->join('siswa', 'siswa.id = status_ujian.id_peserta')
            ->join('sekolah', 'sekolah.id = siswa.sekolah_id')
            ->join('soal', 'soal.id_soal = hasil_ujian.id_soal')
            ->join('analisa_soal', 'analisa_soal.id_analisa = hasil_ujian.id_analisa')
            ->where('siswa.id', $id_siswa)
            ->findAll();
    }

    public function getDetailHasilUjian($id_jadwal, $id_siswa)
    {
        return $this->db->table('analisa_soal')
            ->select('
                siswa.nama_lengkap,
                siswa.kelas,
                nomor_peserta.nomor_peserta,
                mata_pelajaran.nama_mapel,
                jenis_ujian.jenis_ujian,
                jadwal_ujian.tanggal_mulai,
                soal.soal,
                soal.opsi_a, soal.opsi_b, soal.opsi_c, soal.opsi_d, soal.opsi_e,
                soal.jawaban AS kunci_jawaban,
                analisa_soal.jawaban_siswa,
                soal.bobot
            ')
            ->join('nomor_peserta', 'analisa_soal.id_nomor = nomor_peserta.id_peserta')
            ->join('siswa', 'nomor_peserta.id_siswa = siswa.id')
            ->join('jadwal_ujian', 'analisa_soal.id_jadwal = jadwal_ujian.id_jadwal')
            ->join('mata_pelajaran', 'jadwal_ujian.id_mapel = mata_pelajaran.id')
            ->join('jenis_ujian', 'jadwal_ujian.id_jenis_ujian = jenis_ujian.id_jenis_ujian')
            ->join('soal', 'analisa_soal.id_soal = soal.id_soal')
            ->where('analisa_soal.id_jadwal', $id_jadwal)
            ->where('nomor_peserta.id_siswa', $id_siswa)
            ->orderBy('soal.id_soal', 'ASC')
            ->get()
            ->getResultArray();
    }
}
