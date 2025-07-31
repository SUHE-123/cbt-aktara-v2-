<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\NomorPesertaModel;
use App\Models\SiswaModel;
use App\Models\UserModel;
use App\Models\SekolahModel;
use Dompdf\Dompdf;

class KartuPesertaController extends BaseController
{
    public function index()
    {
        // Ambil filter dari query string
        $kelasDipilih   = $this->request->getGet('kelas');
        $sekolahDipilih = $this->request->getGet('sekolah');

        // Ambil daftar kelas (unik)
        $siswaModel = new SiswaModel();
        $daftarKelas = $siswaModel
            ->select('kelas')
            ->distinct()
            ->orderBy('kelas')
            ->findAll();

        // Ambil daftar sekolah
        $sekolahModel = new SekolahModel();
        $daftarSekolah = $sekolahModel
            ->select('id, nama_sekolah')
            ->orderBy('nama_sekolah')
            ->findAll();

        // Ambil data peserta ujian
        $pesertaModel = new NomorPesertaModel();
        $pesertaQuery = $pesertaModel
            ->select('
                nomor_peserta.nomor_peserta,
                siswa.nama_lengkap,
                siswa.kelas,
                users.username,
                users.foto,
                sekolah.nama_sekolah,
                sekolah.logo
            ')
            ->join('siswa', 'siswa.id = nomor_peserta.id_siswa')
            ->join('users', 'users.id = siswa.id', 'left')
            ->join('sekolah', 'sekolah.id = siswa.sekolah_id', 'left');

        if ($kelasDipilih && $kelasDipilih !== 'all') {
            $pesertaQuery->where('siswa.kelas', $kelasDipilih);
        }

        if ($sekolahDipilih && $sekolahDipilih !== 'all') {
            $pesertaQuery->where('sekolah.id', $sekolahDipilih);
        }

        $peserta = $pesertaQuery
            ->orderBy('siswa.kelas')
            ->orderBy('siswa.nama_lengkap')
            ->findAll();

        return view('admin/kartupeserta/index', [
            'kelasDipilih'     => $kelasDipilih,
            'sekolahDipilih'   => $sekolahDipilih,
            'daftarKelas'      => $daftarKelas,
            'daftarSekolah'    => $daftarSekolah,
            'peserta'          => $peserta
        ]);
    }

        

    public function pdf()
    {
        $kelasDipilih   = $this->request->getGet('kelas');
        $sekolahDipilih = $this->request->getGet('sekolah');

        // Ambil data peserta seperti di index()
        $pesertaModel = new NomorPesertaModel();
        $pesertaQuery = $pesertaModel
            ->select('
                nomor_peserta.nomor_peserta,
                siswa.nama_lengkap,
                siswa.kelas,
                users.username,
                users.foto,
                sekolah.nama_sekolah,
                sekolah.logo
            ')
            ->join('siswa', 'siswa.id = nomor_peserta.id_siswa')
            ->join('users', 'users.id_siswa = siswa.id', 'left')
            ->join('sekolah', 'sekolah.id = siswa.id_sekolah', 'left');

        if ($kelasDipilih && $kelasDipilih !== 'all') {
            $pesertaQuery->where('siswa.kelas', $kelasDipilih);
        }

        if ($sekolahDipilih && $sekolahDipilih !== 'all') {
            $pesertaQuery->where('sekolah.id', $sekolahDipilih);
        }

        $peserta = $pesertaQuery
            ->orderBy('siswa.kelas')
            ->orderBy('siswa.nama_lengkap')
            ->findAll();

        // Render view HTML ke string
        $html = view('admin/kartupeserta/pdf', [
            'peserta' => $peserta
        ]);

        // Load DOMPDF
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Download file
        $dompdf->stream("kartu-peserta.pdf", ["Attachment" => true]);
    }

}
