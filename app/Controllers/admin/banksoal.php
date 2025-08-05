<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BankSoalModel;
use App\Models\MapelModel;
use App\Models\SoalModel;

class BankSoal extends BaseController
{
    protected $bankSoalModel;
    protected $mapelModel;
    protected $soalModel;

    public function __construct()
    {
        $this->bankSoalModel = new BankSoalModel();
        $this->mapelModel    = new MapelModel();
        $this->soalModel     = new SoalModel();
    }

    public function index()
    {
        $data['bank'] = $this->bankSoalModel
            ->select('bank_soal.*, mata_pelajaran.nama_mapel')
            ->join('mata_pelajaran', 'mata_pelajaran.id = bank_soal.id_mapel', 'left')
            ->findAll();

        return view('admin/banksoal/index', $data);
    }

    public function create()
    {
        $data['mapel'] = $this->mapelModel->findAll();
        return view('admin/banksoal/create', $data);
    }

    public function store()
    {
        // Simpan data bank soal
        $bankData = [
            'bank_code'    => $this->request->getPost('bank_code'),
            'id_mapel'     => $this->request->getPost('id_mapel'),
            'jumlah_soal'  => $this->request->getPost('jumlah_soal'),
        ];

        $this->bankSoalModel->insert($bankData);
        $id_bank = $this->bankSoalModel->getInsertID();

        // Tangkap data soal
        $soalInputs = $this->request->getPost('soal');
        $soalList = [];

        foreach ($soalInputs as $index => $input) {
            $soalData = [
                'id_bank'  => $id_bank,
                'soal'     => $input['soal'] ?? null,
                'opsi_a'   => $input['opsi_a'] ?? null,
                'opsi_b'   => $input['opsi_b'] ?? null,
                'opsi_c'   => $input['opsi_c'] ?? null,
                'opsi_d'   => $input['opsi_d'] ?? null,
                'file_e'   => $input['file_e'] ?? null, // Opsi E opsional
                'jawaban'  => $input['jawaban'] ?? null,
                'bobot'    => $input['bobot'] ?? 1,
            ];

            // Upload file soal utama (file_soal)
            $fileSoal = $this->request->getFile("soal.$index.file_soal");
            if ($fileSoal && $fileSoal->isValid() && !$fileSoal->hasMoved()) {
                $newName = $fileSoal->getRandomName();
                $fileSoal->move('uploads/soal', $newName);
                $soalData['file_soal'] = $newName;
            }

            // Upload file_a - file_e
            foreach (['file_a', 'file_b', 'file_c', 'file_d', 'file_e'] as $fileKey) {
                $file = $this->request->getFile("soal.$index.$fileKey");
                if ($file && $file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $file->move('uploads/soal', $newName);
                    $soalData[$fileKey] = $newName;
                }
            }

            $soalList[] = $soalData;
        }

        if (!empty($soalList)) {
            $this->soalModel->insertBatch($soalList);
        }

        return redirect()->to('/admin/banksoal')->with('success', 'Bank soal dan data soal berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data['bank']  = $this->bankSoalModel->find($id);
        $data['mapel'] = $this->mapelModel->findAll();
        $data['soal']  = $this->soalModel->where('id_bank', $id)->findAll();
        return view('admin/banksoal/edit', $data);
    }

    public function update($id)
    {
        // Update data bank soal
        $this->bankSoalModel->update($id, [
            'bank_code'    => $this->request->getPost('bank_code'),
            'id_mapel'     => $this->request->getPost('id_mapel'),
            'jumlah_soal'  => $this->request->getPost('jumlah_soal'),
        ]);

        // Update data soal
        $soalInputs = $this->request->getPost('soal');

        if ($soalInputs) {
            foreach ($soalInputs as $id_soal => $input) {
                $updateData = [
                    'soal'     => $input['soal'] ?? null,
                    'opsi_a'   => $input['opsi_a'] ?? null,
                    'opsi_b'   => $input['opsi_b'] ?? null,
                    'opsi_c'   => $input['opsi_c'] ?? null,
                    'opsi_d'   => $input['opsi_d'] ?? null,
                    'file_e'   => $input['file_e'] ?? null, // Opsi E opsional
                    'jawaban'  => $input['jawaban'] ?? null,
                    'bobot'    => $input['bobot'] ?? 1,
                ];

                // File soal utama
                $fileSoal = $this->request->getFile("soal.$id_soal.file_soal");
                if ($fileSoal && $fileSoal->isValid() && !$fileSoal->hasMoved()) {
                    $newName = $fileSoal->getRandomName();
                    $fileSoal->move('uploads/soal', $newName);
                    $updateData['file_soal'] = $newName;
                }

                // File opsi a - e
                foreach (['file_a', 'file_b', 'file_c', 'file_d', 'file_e'] as $fileKey) {
                    $file = $this->request->getFile("soal.$id_soal.$fileKey");
                    if ($file && $file->isValid() && !$file->hasMoved()) {
                        $newName = $file->getRandomName();
                        $file->move('uploads/soal', $newName);
                        $updateData[$fileKey] = $newName;
                    }
                }

                $this->soalModel->update($id_soal, $updateData);
            }
        }

        return redirect()->to('/admin/banksoal')->with('success', 'Data bank soal dan soal berhasil diperbarui.');
    }

    public function delete($id)
    {
        $this->soalModel->where('id_bank', $id)->delete();
        $this->bankSoalModel->delete($id);

        return redirect()->to('/admin/banksoal')->with('success', 'Bank soal dan soal terkait berhasil dihapus.');
    }
}
