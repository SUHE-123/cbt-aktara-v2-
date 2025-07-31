<?php

namespace App\Models;

use CodeIgniter\Model;

class KoleksiBukuModel extends Model
{
    /**
     * Nama tabel dan primary key
     */
    protected $table      = 'koleksi_buku';
    protected $primaryKey = 'id_buku';

    /**
     * Field yang boleh diisi
     */
    protected $allowedFields = [
        'id_jenis_buku',  // FK ke tabel jenis_buku
        'judul',
        'deskripsi',
        'pengarang',
        'penerbit',
        'tahun_terbit',
        'file_pdf',
        'cover',
        'status',         // tampil | tidak tampil
    ];

    /**
     * Konfigurasi tambahan
     */
    protected $useTimestamps = true;
    protected $returnType    = 'array';

    /**
     * Ambil semua koleksi buku beserta jenis bukunya
     */
    public function getWithJenis()
    {
        return $this->select('koleksi_buku.*, jenis_buku.nama_jenis_buku')
                    ->join('jenis_buku', 'jenis_buku.id = koleksi_buku.id_jenis_buku', 'left');
    }

    /**
     * Ambil koleksi buku dengan filter jenis dan judul (abjad)
     *
     * @param int|null $jenis
     * @param string|null $judul
     * @return array
     */
    public function getFiltered($jenis = null, $judul = null)
    {
        $builder = $this->select('koleksi_buku.*, jenis_buku.nama_jenis_buku')
                        ->join('jenis_buku', 'jenis_buku.id = koleksi_buku.id_jenis_buku', 'left')
                        ->where('koleksi_buku.status', 'tampil');

        if (!empty($jenis)) {
            $builder->where('koleksi_buku.id_jenis_buku', $jenis);
        }

        if (!empty($judul)) {
            $builder->like('koleksi_buku.judul', $judul, 'after'); // judul dimulai dari huruf
        }

        return $builder->orderBy('koleksi_buku.judul', 'ASC')->findAll();
    }
}
