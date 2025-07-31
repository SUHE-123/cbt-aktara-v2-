<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\RekapNilaiModel;
use App\Models\SiswaModel;
use App\Models\SekolahModel;
use App\Models\MapelModel;
use App\Models\JadwalUjianModel;
use Dompdf\Dompdf;
use Dompdf\Options;

class rekapnilaicontroller extends BaseController
{
    protected $rekapNilaiModel;
    protected $siswaModel;
    protected $sekolahModel;
    protected $mapelModel;
    protected $jadwalUjianModel;

    public function __construct()
    {
        $this->rekapNilaiModel = new RekapNilaiModel();
        $this->siswaModel = new SiswaModel();
        $this->sekolahModel = new SekolahModel();
        $this->mapelModel = new MapelModel();
        $this->jadwalUjianModel = new JadwalUjianModel();
    }

    public function index()
    {
        // Ambil filter dari query string
        $kelas = $this->request->getGet('kelas');
        $sekolah = $this->request->getGet('sekolah');
        $mapel = $this->request->getGet('mapel');
        $ujian = $this->request->getGet('ujian');

        // Ambil semua data rekap (default)
        $rekap = $this->rekapNilaiModel->getRekapNilai();

        // Terapkan filter
        if ($kelas && $kelas !== 'all') {
            $rekap = $this->rekapNilaiModel->getByKelas($kelas);
        }

        if ($sekolah && $sekolah !== 'all') {
            $rekap = $this->rekapNilaiModel->getBySekolah($sekolah);
        }

        if ($mapel && $mapel !== 'all') {
            $rekap = $this->rekapNilaiModel->getByMapel($mapel);
        }

        if ($ujian && $ujian !== 'all') {
            $rekap = $this->rekapNilaiModel->getByUjian($ujian);
        }

        // Data untuk dropdown filter
        $kelasList = $this->siswaModel->select('kelas')->distinct()->orderBy('kelas')->findAll();
        $sekolahList = $this->sekolahModel->findAll();
        $mapelList = $this->mapelModel->findAll();
        $ujianList = $this->jadwalUjianModel->findAll();

        return view('admin/rekapnilai/index', [
            'rekap'        => $rekap,
            'kelasList'    => $kelasList,
            'sekolahList'  => $sekolahList,
            'mapelList'    => $mapelList,
            'ujianList'    => $ujianList,
            'kelasDipilih'   => $kelas,
            'sekolahDipilih' => $sekolah,
            'mapelDipilih'   => $mapel,
            'ujianDipilih'   => $ujian,
        ]);
    }

        public function downloadPDF()
    {
        $rekapModel = new RekapNilaiModel();

        // Ambil semua rekap data
        $data['rekap'] = $rekapModel->getRekapNilai(); // Pastikan method ini sudah ada di model

        // Load view dan render jadi HTML
        $html = view('admin/rekapnilai/pdf', $data);

        // Set dompdf
        $options = new Options();
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        // Unduh
        $dompdf->stream('rekap_nilai.pdf', ['Attachment' => true]);
    }
}
